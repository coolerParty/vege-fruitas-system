<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{

    
    public  function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent'); // refresh cart count display top right menu
    }


    public  function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent'); // refresh cart count display top right menu
    }


    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent'); // refresh cart count display top right menu
        session()->flash('cart_message','Item has been removed!');
    }


    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component','refreshComponent'); // refresh cart count display top right menu
    }


    public function render()
    {

        if(Auth::check())
		{
			Cart::instance('cart')->store(Auth::user()->email); // save cart to database using user email;
            Cart::instance('wishlist')->store(Auth::user()->email); // save wishlist to database using user email;
		}

        return view('livewire.cart-component')->layout('layouts.base');

    }


}
