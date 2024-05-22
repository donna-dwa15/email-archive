<?php

namespace App\Livewire;

use App\Models\Email;

use Livewire\Component;

class Dashboard extends Component
{
    public $email_count;
    
    public function mount()
    {
        // email count to be displayed on the Dashboard
        $this->email_count = $this->getEmailCount();
        
    }
    
    public function render()
    {
     
        return view('livewire.dashboard')->extends('components.layout', 
                ['header' => 'Dashboard']
            );
    }
    
    /*
     * Get the current number of emails in the emails db table
     */
    private function getEmailCount(): int
    {
        return Email::count();
    }
}
