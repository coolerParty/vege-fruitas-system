<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $comment;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'    => ['required','string'],
            'email'   => ['required','string','email'],
            'comment' => ['required','string','max:255'],
        ]);   
    }

    public function sendMessage()
    {
        $this->validate([
            'name'    => ['required','string'],
            'email'   => ['required','string','email'],
            'comment' => ['required','string','max:255'],
        ]);

        $contact          = new Contact();
        $contact->name    = $this->name;
        $contact->email   = $this->email;
        $contact->comment = $this->comment;
        $contact->save();
        session()->flash('message','Thanks, Your message has been sent successfully!.');
    }

    public function render()
    {
        return view('livewire.contact-component')->layout('layouts.base');
    }
}
