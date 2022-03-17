<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule; // for unique slug

class AdminCategoryEditComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    public $status; 

    public function mount($category_id)
    {
        $category          = Category::where('id',$category_id)->first();
        $this->category_id = $category->id;
        $this->name        = $category->name;
        $this->slug        = $category->slug;
        $this->status      = $category->status;
    }

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'   => ['required',Rule::unique('categories')->ignore($this->category_id)],
            'slug'   => ['required'],
            'status' => ['required'],
        ]);
    }

    public function updateCategory()
    {
        $this->validate([
            'name'   => ['required',Rule::unique('categories')->ignore($this->category_id)],
            'slug'   => ['required'],
            'status' => ['required'],
        ]);
        
        $category         = Category::find($this->category_id);
        $category->name   = $this->name;
        $category->slug   = $this->slug;
        $category->status = $this->status;
        $category->save();        
        Session()->flash('message',$category->name.' has been updated successfully!');
        return redirect(route('admin.category'));
    }

    public function render()
    {
        return view('livewire.admin.admin-category-edit-component')->layout('layouts.dashboard');
    }
}
