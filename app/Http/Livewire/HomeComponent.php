<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use Cart;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product'); 
        session()->flash('cart_message','Product "'.$product_name . '" has been added to cart!');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        if(Cart::instance('wishlist')->content()->pluck('id')->contains($product_id))
        {
            foreach(Cart::instance('wishlist')->content() as $witem)
            {
                if($witem->id == $product_id)
                {
                    Cart::instance('wishlist')->remove($witem->rowId);
                    $this->emitTo('wishlist-count-component','refreshComponent'); // refresh wishlist count display top right menu
                    session()->flash('cart_message','Wishlist has been removed!');
                }
            }
        }
        else
        {
            Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
            $this->emitTo('wishlist-count-component','refreshComponent'); // refresh wishlist count display top right menu
            session()->flash('cart_message','Product "'.$product_name.'" has been added to wishlist!'); 
        }
        
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent'); // refresh wishlist count display top right menu
                
            }
        }
    }

    public function render()
    {
        if(Auth::check())
		{
			Cart::instance('cart')->restore(Auth::user()->email); // save cart to database using user email;
			Cart::instance('wishlist')->restore(Auth::user()->email); // save wishlist to database using user email;
		}
        
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
        $witems = Cart::instance('wishlist')->content()->pluck('id');
        return view('livewire.home-component',
                [
                    'categories'=>$categories,
                    'image_categories'=>$image_categories,
                    'featured_products'=>$featured_products,
                    'featured_cats'=>$featured_cats,
                    'blogs'=>$blogs,
                    'l_top_products'=>$l_top_products,
                    'l_buttom_products'=>$l_buttom_products,
                    'witems'=>$witems,
                ]
            )->layout('layouts.base');
    }
}
