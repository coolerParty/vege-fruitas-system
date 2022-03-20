<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class SearchProductBarComponent extends Component
{
    public $search;

    public function mount()
    {
        $this->fill(request()->only('search'));        
    }
    
    public function render()
    {
        $categories = Category::select('id','name','slug')->where('status',1)->where('type',1)->orderby('name','ASC')->get();
        return view('livewire.search-product-bar-component',['categories'=>$categories]);
    }
}
