<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Pagination\Paginator;

class AdminProductComponent extends Component
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

    public function deleteProduct($product_id)
    {   
        $product = Product::find($product_id);
        $this->name = $product->name;
        if(!empty($product->image))
        {
            if (file_exists('storage/product/small'.'/'.$product->image))
            {
                unlink('storage/product/small'.'/'.$product->image);
            }
             
            if (file_exists('storage/product/medium'.'/'.$product->image))
            {
                unlink('storage/product/medium'.'/'.$product->image);
            }

            if (file_exists('storage/product/large'.'/'.$product->image))
            {
                unlink('storage/product/large'.'/'.$product->image);
            }
        }

        if($product->images)
        {
            $images = explode(",",$product->images);
            foreach($images as $image)
            {
                if (!empty($image))
                {
                    if (file_exists('storage/product/large'.'/'.$image))  
                    {
                        unlink('storage/product/large'.'/'.$image);
                    }
                    if (file_exists('storage/product/medium'.'/'.$image))  
                    {
                        unlink('storage/product/medium'.'/'.$image);
                    }
                    if (file_exists('storage/product/small'.'/'.$image))  
                    {
                        unlink('storage/product/small'.'/'.$image);
                    }
                }
            }
        }
        
        $product->delete();
        session()->flash('message',$this->name.' has been deleted successfully');
        $this->name = null;
    }

    public function updateFeatured($product_id,$status,$url)
    {
        $product = Product::where('id',$product_id)->first();
        $product->featured = $status;
        $product->save();
        return redirect()->to($url);
    }

    public function updateStatus($product_id,$status,$url)
    {
        $product = Product::where('id',$product_id)->first();
        $product->stock_status = $status;
        $product->save();
        return redirect()->to($url);
    }

    
    public function render()
    {
        if(!empty($this->searchname))
        { 
            $products = Product::where('name','like','%'. $this->searchname .'%')
            ->select('id','name','stock_status','featured','quantity','image','category_id','created_at')
            ->orderby('created_at','DESC')
            ->paginate($this->PAGE_NUMBER_LIMIT);
            $products->withPath(route('admin.product').'?searchname='.$this->searchname);
        }
        else
        {
            $products = Product::select('id','name','stock_status','featured','quantity','image','category_id','created_at')
            ->orderby('created_at','DESC')
            ->paginate($this->PAGE_NUMBER_LIMIT);
        }

        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.dashboard');
    }
}
