<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class AdminProductEditComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $information;
    public $regular_price;
    public $sale_price;
    public $stock_status;
    public $featured;
    public $quantity;
    public $weight;
    public $image;
    public $newimage;
    public $images;
    public $newimages;
    public $category_id;

    public $product_id;


    public function mount($product_id)
    {
        $product                 = Product::find($product_id);
        if(empty($product))
        {
            abort(404);
        }
        $this->name              = $product->name;
        $this->slug              = $product->slug;
        $this->short_description = $product->short_description;
        $this->description       = $product->description;
        $this->information       = $product->information;
        $this->regular_price     = $product->regular_price;
        $this->sale_price        = $product->sale_price;
        $this->stock_status      = $product->stock_status;
        $this->featured          = $product->featured;
        $this->quantity          = $product->quantity;
        $this->weight            = $product->weight;
        $this->image             = $product->image;
        $this->images            = explode(",",$product->images);
        $this->category_id       = $product->category_id;
        $this->product_id        = $product->id;
        
    }


    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }


    public function removeCover()
    {
        $this->newimage = null;
    }


    public function removeImages()
    {
        $this->newimages = null;
    }


    public function updated($fields)
    {
        
        $this->validateOnly($fields,[
            'name'              => ['required','max:150', Rule::unique('products')->ignore($this->product_id)],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'information'       => ['required'],
            'regular_price'     => ['required','numeric'],
            'sale_price'        => ['numeric'],
            'stock_status'      => ['required'],
            'quantity'          => ['required','numeric'],
            'weight'            => ['required','numeric'],
            'category_id'       => ['required'],
        ]);

        if($this->newimage)
        {
            $this->validateOnly($fields,['newimage' => ['required','image','max:2054']]);
        }

        if($this->newimages)
        {
            $this->validateOnly($fields,['newimages.*' => ['image','max:2054']]);
        }

    }


    public function updateProduct()
    {

        $this->validate([
            'name'              => ['required','max:150', Rule::unique('products')->ignore($this->product_id)],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'information'       => ['required'],
            'regular_price'     => ['required','numeric'],
            'sale_price'        => ['numeric'],
            'stock_status'      => ['required'],
            'quantity'          => ['required','numeric'],
            'weight'            => ['required','numeric'],
            'category_id'       => ['required'],
       ]);

       if($this->newimage)
        {
            $this->validate(['newimage' => ['required','image','max:2054']]);
        }

        if($this->newimages)
        {
            $this->validate(['newimages.*' => ['image','max:2054']]);
        }

        $product                    = Product::find($this->product_id);
        $product->name              = $this->name;
        $product->slug              = Str::slug($this->name);
        $product->short_description = $this->short_description;
        $product->description       = $this->description;
        $product->information       = $this->information;
        $product->regular_price     = $this->regular_price;
        $product->sale_price        = $this->sale_price;
        $product->stock_status      = $this->stock_status;
        $product->featured          = $this->featured;
        $product->quantity          = $this->quantity;
        $product->weight            = $this->weight;
        $product->category_id       = $this->category_id;

        if(!empty($this->newimage))
        {
            
            if (!empty($product->image) && file_exists('storage/product/small'.'/'.$product->image))
            {
                unlink('storage/product/small'.'/'.$product->image); // Deleting Image
            }
            if (!empty($product->image) && file_exists('storage/product/medium'.'/'.$product->image))
            {
                unlink('storage/product/medium'.'/'.$product->image); // Deleting Image
            }
            if (!empty($product->image) && file_exists('storage/product/large'.'/'.$product->image))
            {
                unlink('storage/product/large'.'/'.$product->image); // Deleting Image
            }

            $imagename         = 'ci'.Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $pathProductSmall  = storage_path().'/app/public/product/small/';
            $pathProductMedium = storage_path().'/app/public/product/medium/';
            $pathProductLarge  = storage_path().'/app/public/product/large/';
            $thumbnailImage = Image::make($this->newimage);

            $thumbnailImage->fit(336, 348);
            $thumbnailImage->save($pathProductLarge.$imagename);
            $thumbnailImage->fit(270, 270);
            $thumbnailImage->save($pathProductMedium.$imagename);
            $thumbnailImage->fit(110, 110);
            $thumbnailImage->save($pathProductSmall.$imagename); 

            $product->image = $imagename;

        }

        if(!empty($this->newimages))
        {

            if($product->images)
            {
                $images = explode(",",$product->images);
                foreach($images as $image)
                {
                    if (!empty($image) && file_exists('storage/product/large'.'/'.$image))  
                    {
                        unlink('storage/product/large'.'/'.$image);
                    }
                }
            }

            $imagesname = '';
            foreach($this->newimages as $key=>$image)
            {
                $imgName   = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $imagePath = storage_path().'/app/public/product/large/';
                $productImage = Image::make($image);
                
                // resize the image to a width of 860 and constrain aspect ratio (auto height)
                $productImage->fit(336, 348);
                $productImage->save($imagePath.$imgName);

                if(empty($imagesname))
                {
                    $imagesname = $imgName;
                }
                else
                {
                    $imagesname = $imagesname . ',' . $imgName;
                }
                
            }
            $product->images = $imagesname;
            
        }

        $product->save();
        session()->flash('message','Product ' .$product->name . ' has been updated successfully!');
        return redirect()->to(route('admin.product'));
    }


    public function render()
    {
        $categories = Category::select('id','name')->orderby('name','ASC')->get();
        return view('livewire.admin.admin-product-edit-component',['categories'=>$categories])->layout('layouts.dashboard');
    }


}
