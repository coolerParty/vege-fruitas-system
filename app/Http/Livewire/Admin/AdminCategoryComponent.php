<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AdminCategoryComponent extends Component
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

    public function deleteCategory($category_id)
    {   
        $category = Category::find($category_id);
        $this->name = $category->name;
        $category->delete();
        session()->flash('message',$this->name.' has been deleted successfully');
        $this->name = null;
    }

    public function updateStatus($category_id,$status,$url)
    {
        $category = Category::where('id',$category_id)->first();
        $category->status = $status;
        $category->save();
        return redirect()->to($url);
    }

    public function render()
    {
        if(!empty($this->searchname))
        { 
            $categories = Category::where('name','like','%'. $this->searchname .'%')
            ->select('id','name','status','created_at')
            ->orderby('created_at','DESC')
            ->paginate($this->PAGE_NUMBER_LIMIT);
            $categories->withPath(route('admin.category').'?searchname='.$this->searchname);
        }
        else
        {
            $categories = Category::select('id','name','status','created_at')->orderby('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
        }
        
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.dashboard');
    }
}
