<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;

class HomeComponent extends Component
{
    public function render()
    {
        $featured_products = Product::select('id','name','slug','image','regular_price','category_id')
                            ->where('featured',1)->where('stock_status','instock')->orderby('created_at','DESC')->take(8)->get();
        $feat_cats         = $featured_products->pluck('category_id','category_id')->all();
        $featured_cats     = Category::select('id','name','slug')->wherein('id',$feat_cats)->get();

        $latest_products   = Product::select('id','name','slug','image','regular_price','created_at')->orderBy('created_at','DESC')->take(6)->get();
        $l_top_products    = $latest_products->take(3);
        $buttom_products   = $latest_products->sortBy('created_at')->take(3);
        $l_buttom_products = $buttom_products->sortByDesc('created_at');

        $blogs = Blog::select('id','name','slug','image','short_description','created_at')->orderby('created_at','DESC')->take(3)->get();

        $categories = Category::select('id','name','image','slug')->where('status',1)->where('type',1)->orderby('name','ASC')->get();
        $image_categories = $categories->take(6);
        return view('livewire.home-component',
                [
                    'categories'=>$categories,
                    'image_categories'=>$image_categories,
                    'featured_products'=>$featured_products,
                    'featured_cats'=>$featured_cats,
                    'blogs'=>$blogs,
                    'l_top_products'=>$l_top_products,
                    'l_buttom_products'=>$l_buttom_products,
                ]
            )->layout('layouts.base');
    }
}
