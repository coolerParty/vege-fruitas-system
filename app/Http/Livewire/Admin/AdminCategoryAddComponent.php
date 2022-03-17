<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminCategoryAddComponent extends Component
{
    public $name;
    public $slug;
    public $status; 

    public function mount()
    {
        $this->status = 0;
    }
    
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'   => ['required','unique:categories'],
            'slug'   => ['required'],
            'status' => ['required'],
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name'   => ['required','unique:categories'],
            'slug'   => ['required'],
            'status' => ['required'], 
        ]);
        $category         = new Category();
        $category->name   = $this->name;
        $category->slug   = Str::slug($this->name);
        $category->status = $this->status;
        $category->save();        
        session()->flash('message', $category->name.' has been created successfuly');
        return redirect(route('admin.category'));
    }

    public function render()
    {
        return view('livewire.admin.admin-category-add-component')->layout('layouts.dashboard');
    }
}
