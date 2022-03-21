<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductDetailsComponent extends Component
{
    public $product_id;
    public $slug;
    public $qty;

    public function mount($product_id, $slug)
    {
        $this->product_id = $product_id;
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        if($this->qty > 1)
        {
        $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('id',$this->product_id)
            ->select(
                'id','name','slug','image','images','regular_price','sale_price','short_description',
                'description','information','weight','stock_status','category_id','created_at'
            )            
            ->first();

            if(empty($product))
            {
                abort(404);
            }

            if($product->slug != $this->slug)
            {
                abort(404);
            }

        $related_products = Product::where('id','<>',$product->id)
            ->where('category_id',$product->category_id)
            ->select('id','name','slug','regular_price','sale_price','image')
            ->orderby('created_at','DESC')
            ->take(4)
            ->get();

        return view('livewire.product-details-component',['product'=>$product,'related_products'=>$related_products])->layout('layouts.base');
    }
}
