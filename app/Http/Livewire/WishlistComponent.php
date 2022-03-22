<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class WishlistComponent extends Component
{


    public function destroy($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emitTo('wishlist-count-component','refreshComponent'); // refresh cart count display top right menu
        session()->flash('cart_message','Item has been removed!');
    }


    public function destroyAll()
    {
        Cart::instance('wishlist')->destroy();
        $this->emitTo('wishlist-count-component','refreshComponent'); // refresh cart count display top right menu
    }


    public function render()
    {

        if(Auth::check())
		{
            Cart::instance('cart')->store(Auth::user()->email); // save cart to database using user email;
			Cart::instance('wishlist')->store(Auth::user()->email); // save wishlist to database using user email;
		}

        return view('livewire.wishlist-component')->layout('layouts.base');

    }

    
}
