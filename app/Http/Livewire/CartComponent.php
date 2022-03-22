<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;
    
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
        session()->flash('cart_message','Cart Item has been all cleared!');
    }


    // Coupon Start
    public function applyCouponCode()
    {
        $coupon = Coupon::where('code',$this->couponCode)->where('cart_value','<=',Cart::instance('cart')->subtotal())->first();
        
        if(!$coupon)
        {
            session()->flash('coupon_message','Coupon code is invalid!');
            return;
        }
        session()->put('coupon',[
            'code'       => $coupon->code,
            'type'       => $coupon->type,
            'value'      => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    public function calculateDiscounts()
    {
        if(session()->has('coupon'))
        {
            if(session()->get('coupon')['type'] == 'fixed')
            {
                $this->discount = session()->get('coupon')['value'];
            }
            else
            {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value'])/100;
            }

            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount      = ($this->subtotalAfterDiscount * Cart::instance('cart')->tax())/100;
            $this->totalAfterDiscount    = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }
    // Coupon End
 

    public function render()
    {

        if(Auth::check())
		{
			Cart::instance('cart')->store(Auth::user()->email); // save cart to database using user email;
            Cart::instance('wishlist')->store(Auth::user()->email); // save wishlist to database using user email;
		}

        if(session()->has('coupon'))
        {
            if(cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else
            {
                $this->calculateDiscounts();
            }
        }

        return view('livewire.cart-component')->layout('layouts.base');

    }


}
