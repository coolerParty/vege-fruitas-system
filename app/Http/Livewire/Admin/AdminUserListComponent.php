<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class AdminUserListComponent extends Component
{
    public function render()
    {
        $users = User::select('id','name','email','created_at')->orderby('created_at','DESC')->get();
        return view('livewire.admin.admin-user-list-component',['users'=>$users])->layout('layouts.dashboard');
    }
}
