<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class AdminCategoryAddComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $type;
    public $image;
    public $status; 

    public function mount()
    {
        $this->type = null;
        $this->status = 0;

    }
    
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'   => ['required','unique:categories'],
            'slug'   => ['required'],
            'type'   => ['required','numeric'],
            'image'  => ['nullable','image','max:2054'],
            'status' => ['required'],
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name'   => ['required','unique:categories'],
            'slug'   => ['required'],
            'type'   => ['required','numeric'],
            'image'  => ['nullable','image','max:2054'],
            'status' => ['required'],
        ]);
        $category         = new Category();
        $category->name   = $this->name;
        $category->slug   = Str::slug($this->name);
        $category->type   = $this->type;
        $category->status = $this->status;

        if(!empty($this->image))
        {
            $imagename      = 'ci'.Carbon::now()->timestamp. '.' . $this->image->extension();            
            $pathCategoryMedium  = storage_path().'/app/public/category/medium/';
            $thumbnailImage = Image::make($this->image);
            $thumbnailImage->fit(270, 270);
            $thumbnailImage->save($pathCategoryMedium.$imagename);
            $category->image = $imagename;
        }

        $category->save();        
        session()->flash('message', $category->name.' has been created successfuly');
        return redirect(route('admin.category'));
    }

    public function render()
    {
        return view('livewire.admin.admin-category-add-component')->layout('layouts.dashboard');
    }
}
