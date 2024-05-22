<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;

use App\Jobs\ProcessEmail;

use App\Models\Email;
use App\Models\Tag;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $emails = Email::latest()->with(['tags'])->get();
        
        return view('livewire.email-table', ['emails' => $emails, 
            'header_text' => "Archived Emails",
            'content_component' => 'email-table',
            'tags' => Tag::all()
            ]
                );
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * For use with the /upload API route in api.php
     */
    public function store(StoreEmailRequest $request)
    {
        // Array to store details to return back in response to the API call
        $response = [ 'success' => true,
            'message' => "File has been successfully uploaded",
            'status' => 201 
            ];
        
        // Validate all POST request details
        $validator = Validator::make(request()->all(), [
                    'file' => "required|mimes:eml",
                    'tags' => "nullable",
                ]);
        
        // Validation failed on POSTed form data
        if( $validator->fails( )){
            
            $errors = "";
            $delimiter = "";
            
            // Retrieve all error details
            foreach( $validator->errors()->all() as $error ){
                
                $errors .= $delimiter . $error;
                $delimiter = ", ";
            }
            
            // Set response details for the failed request
            $response["success"] = false;
            $response["message"] = $errors;
            $response["status"] = 400;
            
        } else {
        
            // Retrieve the validated POST data
            $attributes = $validator->validated();
            
            // If the optional tags aren't found, default to an empty string
            if( !isset( $attributes["tags"] ) ){

                $attributes["tags"] = "";

            }
            
            // Store the uploaded file and get the path
            $file_path = Storage::path($request->file->store('uploads'));
  
            try {
                
                // Pass the file + tags to be processed and saved to the DB
                ProcessEmail::dispatch($file_path, $attributes["tags"]);
            
                
            } catch (ValidationException $e) {
                
                // There was an error parsing out the file.
                // Set response details for the failed request.
                $response["success"] = false;
                $response["message"] = $e->getMessage();
                $response["status"] = 400;
                
            }
            
        }
        
        return response()->json( $response, $response["status"] );
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
        //
    }

    
}
