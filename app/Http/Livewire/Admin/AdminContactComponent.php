<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;

class AdminContactComponent extends Component
{
    public $PAGE_NUMBER_LIMIT = 10;

    public $searchname;

    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function mount()
    {
     $this->fill(request()->only('searchname'));
    }

    public function render()
    {
        if(!empty($this->searchname))
        { 
            $contacts = Contact::where('name','like','%'. $this->searchname .'%')
                ->select('name','email','comment','created_at')
                ->orderBy('created_at','DESC')
                ->paginate($this->PAGE_NUMBER_LIMIT);
            $contacts->withPath(route('admin.contact').'?searchname='.$this->searchname);
        }
        else
        {
            $contacts = Contact::select('name','email','comment','created_at')->orderBy('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
        }

        
        return view('livewire.admin.admin-contact-component',['contacts'=>$contacts])->layout('layouts.dashboard');
    }
}
