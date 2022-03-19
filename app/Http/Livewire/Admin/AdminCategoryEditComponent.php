<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule; // for unique slug
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class AdminCategoryEditComponent extends Component
{
    use WithFileUploads;
    public $category_id;
    public $name;
    public $slug;
    public $type;
    public $image;
    public $newimage;
    public $status; 

    public function mount($category_id)
    {
        $category          = Category::where('id',$category_id)->first();
        if(empty($category))
        {
            session()->flash('message','Category not found!');
            return redirect()->to(route('admin.category'));
        }
        $this->category_id = $category->id;
        $this->name        = $category->name;
        $this->slug        = $category->slug;
        $this->type        = $category->type;
        $this->image       = $category->image;
        $this->status      = $category->status;
    }

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function removeImage()
    {
        $this->newimage = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'   => ['required',Rule::unique('categories')->ignore($this->category_id)],
            'slug'   => ['required'],
            'type'   => ['required','numeric'],
            'status' => ['required'],
        ]);
        if($this->newimage)
        {
            $this->validateOnly($fields,['newimage' => ['nullable','image','max:2054']]);
        }
    }

    public function updateCategory()
    {
        $this->validate([
            'name'   => ['required',Rule::unique('categories')->ignore($this->category_id)],
            'slug'   => ['required'],
            'type'   => ['required','numeric'],
            'status' => ['required'],
        ]);

        if($this->newimage)
        {
            $this->validate(['newimage' => ['nullable','image','max:2054']]);
        }
        
        $category         = Category::find($this->category_id);
        $category->name   = $this->name;
        $category->slug   = $this->slug;
        $category->type   = $this->type;
        $category->status = $this->status;

        if(!empty($this->newimage))
        {
            
            if (!empty($category->image) && file_exists('storage/category/medium'.'/'.$category->image))
            {
                unlink('storage/category/medium'.'/'.$category->image); // Deleting Image
            }

            $imagename         = 'ci'.Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $pathCategoryMedium = storage_path().'/app/public/category/medium/';
            $thumbnailImage = Image::make($this->newimage);

            $thumbnailImage->fit(270, 270);
            $thumbnailImage->save($pathCategoryMedium.$imagename);

            $category->image = $imagename;

        }

        $category->save();        
        Session()->flash('message',$category->name.' has been updated successfully!');
        return redirect(route('admin.category'));
    }

    public function render()
    {
        return view('livewire.admin.admin-category-edit-component')->layout('layouts.dashboard');
    }
}
