<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Blog;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminBlogEditComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $status;
    public $image;
    public $newimage;
    public $category_id;

    public $blog_id;

    public function mount($blog_id)
    {
        $blog                    = Blog::find($blog_id);
        if(empty($blog))
        {
            session()->flash('message','Blog not found!');
            return redirect()->to(route('admin.blog'));
        }
        $this->name              = $blog->name;
        $this->slug              = $blog->slug;
        $this->short_description = $blog->short_description;
        $this->description       = $blog->description;
        $this->status            = $blog->status;
        $this->image             = $blog->image;
        $this->category_id       = $blog->category_id;
        $this->blog_id           = $blog->id;
        
    }


    public function generateSlug()
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
            'name'              => ['required','max:150', Rule::unique('blogs')->ignore($this->blog_id)],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'status'            => ['required'],
            'category_id'       => ['required'],
        ]);

        if($this->newimage)
        {
            $this->validateOnly($fields,['newimage' => ['required','image','max:2054']]);
        }

    }

    public function updateBlog()
    {

        $this->validate([
            'name'              => ['required','max:150', Rule::unique('blogs')->ignore($this->blog_id)],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'status'            => ['required'],
            'category_id'       => ['required'],
       ]);

       if($this->newimage)
        {
            $this->validate(['newimage' => ['required','image','max:2054']]);
        }

        $blog                    = Blog::where('id',$this->blog_id)->first();
        $blog->name              = $this->name;
        $blog->slug              = Str::slug($this->name);
        $blog->short_description = $this->short_description;
        $blog->description       = $this->description;
        $blog->status            = $this->status;
        $blog->category_id       = $this->category_id;

        if(!empty($this->newimage))
        {
            
            if (!empty($blog->image) && file_exists('storage/blog/small'.'/'.$blog->image))
            {
                unlink('storage/blog/small'.'/'.$blog->image); // Deleting Image
            }
            if (!empty($blog->image) && file_exists('storage/blog/medium'.'/'.$blog->image))
            {
                unlink('storage/blog/medium'.'/'.$blog->image); // Deleting Image
            }
            if (!empty($blog->image) && file_exists('storage/blog/large'.'/'.$blog->image))
            {
                unlink('storage/blog/large'.'/'.$blog->image); // Deleting Image
            }

            $imagename         = 'ci'.Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $pathBlogSmall  = storage_path().'/app/public/blog/small/';
            $pathBlogMedium = storage_path().'/app/public/blog/medium/';
            $pathBlogLarge  = storage_path().'/app/public/blog/large/';
            $thumbnailImage = Image::make($this->newimage);

            $thumbnailImage->fit(413, 348);
            $thumbnailImage->save($pathBlogLarge.$imagename);
            $thumbnailImage->fit(370, 266);
            $thumbnailImage->save($pathBlogMedium.$imagename);
            $thumbnailImage->fit(70, 70);
            $thumbnailImage->save($pathBlogSmall.$imagename); 

            $blog->image = $imagename;

        }

        $blog->save();
        session()->flash('message','Blog ' .$blog->name . ' has been updated successfully!');
        return redirect()->to(route('admin.blog'));
    }

    public function render()
    {
        $categories = Category::select('id','name')->orderby('name','ASC')->where('status',1)->where('type',2)->get();
        return view('livewire.admin.admin-blog-edit-component',['categories'=>$categories])->layout('layouts.dashboard');
    }
}
