<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Blog;
use Illuminate\Pagination\Paginator;

class AdminBlogComponent extends Component
{
    public $name;
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

    public function deleteBlog($blog_id)
    {   
        $blog = Blog::find($blog_id);
        $this->name = $blog->name;
        if(!empty($blog->image))
        {
            if (file_exists('storage/blog/small'.'/'.$blog->image))
            {
                unlink('storage/blog/small'.'/'.$blog->image);
            }
             
            if (file_exists('storage/blog/medium'.'/'.$blog->image))
            {
                unlink('storage/blog/medium'.'/'.$blog->image);
            }

            if (file_exists('storage/blog/large'.'/'.$blog->image))
            {
                unlink('storage/blog/large'.'/'.$blog->image);
            }
        }
        $blog->delete();
        session()->flash('message',$this->name.' has been deleted successfully');
        $this->name = null;
    }

    public function updateStatus($blog_id,$status,$url)
    {
        $blog = Blog::where('id',$blog_id)->first();
        $blog->status = $status;
        $blog->save();
        return redirect()->to($url);
    }

    public function render()
    {
        if(!empty($this->searchname))
        { 
            $blogs = Blog::where('name','like','%'. $this->searchname .'%')
            ->select('id','name','status','image','category_id','user_id','created_at')
            ->orderby('created_at','DESC')
            ->paginate($this->PAGE_NUMBER_LIMIT);
            $blogs->withPath(route('admin.blog').'?searchname='.$this->searchname);
        }
        else
        {
            $blogs = Blog::select('id','name','status','image','category_id','user_id','created_at')
            ->orderby('created_at','DESC')
            ->paginate($this->PAGE_NUMBER_LIMIT);
        }

        return view('livewire.admin.admin-blog-component',['blogs'=>$blogs])->layout('layouts.dashboard');
    }
}
