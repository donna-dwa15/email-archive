<?php

namespace App\Livewire;

use App\Jobs\ProcessEmail;

use Livewire\Component;
use Livewire\WithFileUploads;

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
        
        ProcessEmail::dispatch($attributes['file']->temporaryUrl(), $attributes["tags"]);
        
        $this->reset();
        
        session()->flash('message', 'File uploaded successfully.');

    }
    
    public function render()
    {
        return view('livewire.upload-email')->extends('components.layout', ['header' => 'Email Uploader']);
    }
}
