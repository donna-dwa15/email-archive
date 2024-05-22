<?php

namespace App\Jobs;

use App\Models\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

use Illuminate\Validation\ValidationException;

use ZBateson\MailMimeParser\Message;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $message;
    
    /**
     * Create a new job instance.
     */
    public function __construct(public string $file_url, public string $tags)
    {
        //
    }

    /**
     * 
     * This job will process an email (.eml) file:
     * 
     * 1. Parse out the details of the email
     * 2. Save an Email to the emails table as well as any 
     *      associated Tag(s)
     * 
     */
    public function handle(): void
    {

        logger('Processing file\n: ' . $this->file_url);
        $email_details = $this->parseEmail();
        
        if( !isset( $email_details['has_errors'] ) ){
                 
            $email = Email::create(Arr::except( $email_details, 'tags'));
        
            if( $email_details['tags'] ?? false ){
                foreach( explode(',', $email_details['tags']) as $tag){

                    $email->tag($tag);
                
                }
            }
        } else {
            
            throw ValidationException::withMessages(['file' => 'Invalid .eml formatted file']);

        }
        
    }
    
    /**
     * 
     *  Parse the content details of an email (.eml) file
     *  
     */
    private function parseEmail(): Array 
    {        
        // get the contents of the .eml file
        $content = file_get_contents($this->file_url);
        
        // no content to parse, return an error
        if( empty( $content ) ) {

            return [ 'has_errors' => true ];

        }
        
        /*
         *  Create a Message object from the content
         *  to easily access email message details
         * 
         */
        $this->message = Message::from($content, true);

        // Retrieve email addresses of recipient and sender
        $to = $this->message->getHeader('To');
        $from = $this->message->getHeader('From');
        $subject = $this->message->getSubject();

        // Something is wrong with the file if we can't find these headers
        if( !isset( $to ) || !isset( $from ) ){
         
            return [ 'has_errors' => true ];
            
        }
        
        $recipient = "";
        $delimiter = "";
        
        $sender = $from->getEmail();
        
        foreach( $to->getAddresses() as $address ){
            
            $recipient .= $delimiter . $address->getEmail();
            $delimiter = ", ";
        }
        
        // Get the email body content
        $text = $this->message->getTextContent();
        $html = $this->message->getHtmlContent();
        
        // Retrieve file attachment information, if any 
        $attachments = $this->getAttachments();
        
        return [ 'recipient' => $recipient,
                'sender' => $sender,
                'subject' => $subject,
                'text_body' => $text,
                'html_body' => $html,
                'attachments' => implode(',', $attachments),
                'tags' => $this->tags
            ];
    }
    
    /**
     * 
     * Extract and return any attachment file details from an Email Message
     * 
     */
    private function getAttachments(): Array
    {
        $parts = $this->message->getAllAttachmentParts();
        $attachments = array();
        
        foreach ($parts as $attachment) {
            
            $filename = $attachment->getFilename();
            $attachments[] = $filename;
            
        }
        
        return $attachments;
    }
}
