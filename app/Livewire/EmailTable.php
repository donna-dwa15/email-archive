<?php

namespace App\Livewire;

use App\Models\Email;

use Livewire\Component;
use Livewire\WithPagination;

class EmailTable extends Component
{
    use WithPagination;
    
    public function render()
    {

        return view('livewire.email-table', [
            'emails' => Email::with(['tags'])->paginate(10) ,          
        ])->extends('layouts.layout', ['header' => 'Archived Emails']);
        
    }
}
