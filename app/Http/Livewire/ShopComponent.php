<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Cart;	

class ShopComponent extends Component
{
    public $PAGE_NUMBER_LIMIT = 9;

    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product'); 
        session()->flash('cart_message','"'.$product_name . '" has been added to cart!');
    }

    public function render()
    {
        $latest_products   = Product::select('id','name','slug','image','regular_price','created_at')->orderBy('created_at','DESC')->take(6)->get();
        $l_top_products    = $latest_products->take(3);
        $buttom_products   = $latest_products->sortBy('created_at')->take(3);
        $l_buttom_products = $buttom_products->sortByDesc('created_at');

        $sale_products = Product::select('id','name','slug','regular_price','sale_price','image','category_id')->where('stock_status',1)->where('sale_price','<>',0)->orderBy('created_at','DESC')->get();

        $products = Product::select('id','name','slug','regular_price','image')->where('stock_status',1)->orderBy('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
        $categories = Category::select('id','name','slug')->where('status',1)->where('type',1)->orderby('name','ASC')->get();
        return view('livewire.shop-component',
                [
                    'products'=>$products,
                    'categories'=>$categories,
                    'l_top_products'=>$l_top_products,
                    'l_buttom_products'=>$l_buttom_products,
                    'sale_products'=>$sale_products
                ]
            )->layout('layouts.base');
    }
}
