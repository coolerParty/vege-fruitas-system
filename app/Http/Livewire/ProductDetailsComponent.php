<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductDetailsComponent extends Component
{
    public $product_id;
    public $slug;

    public function mount($product_id, $slug)
    {
        $this->product_id = $product_id;
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::select(
                                'id','name','slug','image','images',
                                'regular_price','sale_price','short_description',
                                'description','information','weight','stock_status',
                                'category_id','created_at')
                            ->where('id',$this->product_id)->first();
        if(empty($product))
        {
            return redirect()->to(route('shop.index'));
        }
        $related_products = Product::select('id','name','slug','regular_price','sale_price','image')->orderby('created_at','DESC')->take(4)->get();
        return view('livewire.product-details-component',['product'=>$product,'related_products'=>$related_products])->layout('layouts.base');
    }
}
