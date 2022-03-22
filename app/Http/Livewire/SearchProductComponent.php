<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Cart;
use Illuminate\Support\Facades\Auth;

class SearchProductComponent extends Component
{


    public $PAGE_NUMBER_LIMIT = 9;
    public $search;


    public function boot()
    {
        Paginator::useBootstrap();
    }


    public function mount()
    {
        $this->fill(request()->only('search'));
    }


    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product'); 
        $this->emitTo('cart-count-component','refreshComponent'); // refresh cart count display top right menu
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
            session()->flash('cart_message','Product "'.$product_name . '" has been added to wishlist!'); 
        }
        
    }


    public function render()
    {

        if(Auth::check())
		{
			Cart::instance('cart')->store(Auth::user()->email); // save cart to database using user email;
			Cart::instance('wishlist')->store(Auth::user()->email); // save wishlist to database using user email;
		}
        
        $latest_products   = Product::select('id','name','slug','image','regular_price','created_at')->orderBy('created_at','DESC')->take(6)->get();
        $l_top_products    = $latest_products->take(3);
        $buttom_products   = $latest_products->sortBy('created_at')->take(3);
        $l_buttom_products = $buttom_products->sortByDesc('created_at');

        $sale_products = Product::select('id','name','slug','regular_price','sale_price','image','category_id')
            ->where('stock_status',1)
            ->where('sale_price','<>',0)
            ->orderBy('created_at','DESC')
            ->get();

        if(!empty($this->search))
        {
            $products = Product::where('name','like','%'.$this->search.'%')->select('id','name','slug','regular_price','image')->where('stock_status',1)->orderBy('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
            $products->withPath(route('product.search').'?search='.$this->search);
        }
        else
        {
            $products = Product::select('id','name','slug','regular_price','image')->where('stock_status',1)->orderBy('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
            
        }

        $categories = Category::select('id','name','slug')->where('status',1)->where('type',1)->orderby('name','ASC')->get();
        $witems = Cart::instance('wishlist')->content()->pluck('id');

        return view('livewire.search-product-component',
                        [
                            'products'          => $products,
                            'categories'        => $categories,
                            'l_top_products'    => $l_top_products,
                            'l_buttom_products' => $l_buttom_products,
                            'sale_products'     => $sale_products,
                            'witems'            => $witems,
                        ]
                    )->layout('layouts.base');

    }

    
}
