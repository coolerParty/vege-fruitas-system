<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class AdminProductAddComponent extends Component
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
    public $images;
    public $category_id;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured     = 0;
        $this->sale_price   = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'              => ['required','max:150','unique:products'],
            'slug'              => ['required'],
            'short_description' => ['required','max:350'],
            'description'       => ['required'],
            'information'       => ['required'],
            'regular_price'     => ['required','numeric'],
            'sale_price'        => ['numeric'],
            'stock_status'      => ['required'],
            'featured'          => ['required'],
            'quantity'          => ['required','numeric'],
            'weight'            => ['required','numeric'],
            'image'             => ['required','image','max:2054'],
            'images.*'          => ['image','max:2054'],                       // 2MB Max
            'category_id'       => ['required'],
        ]);
    }

    public function addProduct()
    {
        $this->validate([
                'name'              => ['required','max:150','unique:products'],
                'slug'              => ['required'],
                'short_description' => ['required','max:350'],
                'description'       => ['required'],
                'information'       => ['required'],
                'regular_price'     => ['required','numeric'],
                'sale_price'        => ['numeric'],
                'stock_status'      => ['required'],
                'featured'          => ['required'],
                'quantity'          => ['required','numeric'],
                'weight'            => ['required','numeric'],
                'image'             => ['required','image','max:2054'],
                'images.*'          => ['image','max:2054'],                       // 2MB Max
                'category_id'       => ['required'],
        ]);

        $product                    = new Product();
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

        if(!empty($this->image))
        {
            $imagename      = 'ci'.Carbon::now()->timestamp. '.' . $this->image->extension();
            $pathProductSmall  = storage_path().'/app/public/product/small/';
            $pathProductMedium = storage_path().'/app/public/product/medium/';
            $pathProductLarge  = storage_path().'/app/public/product/large/';
            $thumbnailImage = Image::make($this->image);
            $thumbnailImage->fit(336, 348);
            $thumbnailImage->save($pathProductLarge.$imagename);
            $thumbnailImage->fit(270, 270);
            $thumbnailImage->save($pathProductMedium.$imagename);
            $thumbnailImage->fit(110, 110);
            $thumbnailImage->save($pathProductSmall.$imagename);
            $product->image = $imagename;
        }
        
        if(!empty($this->images))
        {
            $imagesname = '';
            foreach($this->images as $key=>$image)
            {                
                $imgName = Carbon::now()->timestamp. $key. '.' . $image->extension();
                // $image->storeAs('products',$imgName);
                $pathProductsSmall  = storage_path().'/app/public/product/small/';
                $pathProductsMedium = storage_path().'/app/public/product/medium/';
                $pathProductsLarge  = storage_path().'/app/public/product/large/';
                $postImage = Image::make($image);
                
                // resize the image to a width of 860 and constrain aspect ratio (auto height)
                $postImage->fit(336, 348);
                $postImage->save($pathProductsLarge.$imgName);
                $postImage->fit(270, 270);
                $postImage->save($pathProductsMedium.$imgName);
                $postImage->fit(110, 110);
                $postImage->save($pathProductsSmall.$imgName);
                
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
        session()->flash('message','Product '.$product->name.' has been created successfully!');
        return redirect()->to(route('admin.product'));
    //    110
    //    270
    //    336 x 348

    }

    public function removeCover()
    {
        $this->image = null;
    }

    public function removeImages()
    {
        $this->images = null;
    }

    public function render()
    {
        $categories = Category::select('id','name')->orderby('name','ASC')->where('status',1)->where('type',1)->get();
        return view('livewire.admin.admin-product-add-component',['categories'=>$categories])->layout('layouts.dashboard');
    }
}
