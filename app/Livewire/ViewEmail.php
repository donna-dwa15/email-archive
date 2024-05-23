<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Email;

class ViewEmail extends Component
{
    public $showRawHTML = false;
    public $showRenderedHTML = false;
    public $showTextOnly = false;
    public $email;
    
    public function mount($id)
    {
        $this->email = Email::findOrFail($id);
        
        // Double check any of these exist before trying to set a view
        // A given email doesn't have to have HTML or Text body.
        if( isset($this->email->html_body) ){
            
            $this->showRawHTML = true;
            
        } elseif ( isset($this->email->text_body) ){
            
            $this->showTextOnly = true;
            
        }
    }
    
    /*
     * Toggle viewing of the Email Message Body to Text only
     */
    public function viewText()
    {     
       $this->showRawHTML = false;
       $this->showRenderedHTML = false;
       $this->showTextOnly = true; 
    }
    
    /*
     * Toggle viewing of the Email Message Body to Raw HTML Text
     */
    public function viewRawHTML()
    {
       $this->showTextOnly = false;
       $this->showRenderedHTML = false;
       $this->showRawHTML = true; 
    }
    
    /*
     * Toggle viewing of the Email Message Body to Rendered HTML
     */
    public function viewRenderedHTML()
    {
       $this->showTextOnly = false;
       $this->showRawHTML = false;      
       $this->showRenderedHTML = true;
       
    }

    public function render()
    {
        return view('livewire.view-email')->extends('components.layout', 
                ['header' => 'Email Viewer']
            );
    }
}
