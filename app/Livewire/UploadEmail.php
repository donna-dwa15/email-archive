<?php

namespace App\Livewire;

use App\Jobs\ProcessEmail;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Validation\ValidationException;

class UploadEmail extends Component
{
    use WithFileUploads;
        
    #[Validate('required', message: 'Please provide a .eml file for upload')]
    #[Validate('mimes:eml)', message: 'Only .eml files are supported')] 
    public $file;
    public $tag;
    
    protected $rules = [
        'file' => "required|mimes:eml",
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
    }
    
    public function save()
    {
        
        $attributes = $this->validate();
        
        if( !isset( $this->tag) ){
            
            $this->tag = "";
            
        }
                
        $attributes["tags"] = $this->tag;
        
        
        try {
            
            ProcessEmail::dispatch($attributes['file']->temporaryUrl(), $attributes["tags"]);
            
            session()->flash('message', 'File uploaded successfully.');

        } catch (ValidationException $e) {

            session()->flash('error', 'Upload failed: ' . $e->getMessage());
            
        }
        
        $this->reset();

    }
    
    public function render()
    {
        return view('livewire.upload-email')->extends('components.layout', ['header' => 'Email Uploader']);
    }
}
