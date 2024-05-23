<?php

namespace App\Livewire;

use App\Models\Email;

use Livewire\Component;
use Livewire\WithPagination;

class EmailTable extends Component
{
    use WithPagination;
    
    public $searchText = "";
    
    /*
     * Search functionality triggered by input submission on component
     */
    public function search()
    {
        // Reset any pagination currently done by the user before rendering
        $this->resetPage();
        $this->render( );
    }
    
    /*
     * Retrieve emails by searching on Tag name using specified searchText
     */
    private function searchEmailsByTag( )
    {
        $emails = Email::whereHas('tags', function($q){
            $q->where('name', 'LIKE', '%' . $this->searchText . '%');               
        });
        
        return $emails;
    }
    
    public function render( )
    {

        return view('livewire.email-table', 
            ['emails' => $this->searchEmailsByTag()->paginate(10),    
            ])->extends('components.layout', ['header' => 'Archived Emails']);
        
    }
}
