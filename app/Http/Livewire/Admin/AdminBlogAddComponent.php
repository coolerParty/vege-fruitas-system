<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class AdminBlogAddComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $status;
    public $image;
    public $user_id;
    public $category_id;

    public function mount()
    {
        $this->status = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'              => ['required','max:150','unique:products'],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'status'            => ['required'],
            'image'             => ['required','image','max:2054'],
            'category_id'       => ['required'],
        ]);
    }

    public function addBlog()
    {
        $this->validate([
            'name'              => ['required','max:150','unique:products'],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'status'            => ['required'],
            'image'             => ['required','image','max:2054'],
            'category_id'       => ['required'],
        ]);

        $blog                    = new Blog();
        $blog->name              = $this->name;
        $blog->slug              = Str::slug($this->name);
        $blog->short_description = $this->short_description;
        $blog->description       = $this->description;
        $blog->status            = $this->status;
        $blog->category_id       = $this->category_id;
        $blog->user_id           = Auth::user()->id;

        if(!empty($this->image))
        {
            $imagename      = 'ci'.Carbon::now()->timestamp. '.' . $this->image->extension();
            $pathBlogSmall  = storage_path().'/app/public/blog/small/';
            $pathBlogMedium  = storage_path().'/app/public/blog/medium/';
            $pathBlogLarge   = storage_path().'/app/public/blog/large/';
            $thumbnailImage = Image::make($this->image);
            $thumbnailImage->fit(413, 348);
            $thumbnailImage->save($pathBlogLarge.$imagename);
            $thumbnailImage->fit(370, 266);
            $thumbnailImage->save($pathBlogMedium.$imagename);
            $thumbnailImage->fit(70, 70);
            $thumbnailImage->save($pathBlogSmall.$imagename);
            $blog->image = $imagename;
        }

        $blog->save();
        session()->flash('message','Blog '.$blog->name.' has been created successfully!');
        return redirect()->to(route('admin.blog'));
    //    70
    //    370 x 266
    //    413 x 348

    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        $categories = Category::select('id','name')->orderby('name','ASC')->where('status',1)->where('type',2)->get();
        return view('livewire.admin.admin-blog-add-component',['categories'=>$categories])->layout('layouts.dashboard');
    }
}
