<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
use Illuminate\Validation\Rule;	

class AdminCouponEditComponent extends Component
{

    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;


    public function mount($coupon_id)
    {
        $coupon = Coupon::where('id',$coupon_id)->first();
        if($coupon)
        {
            $this->coupon_id  = $coupon->id;
            $this->code       = $coupon->code;
            $this->type       = $coupon->type;
            $this->value      = $coupon->value;
            $this->cart_value = $coupon->cart_value;
        }
        else
        {
            session()->flash('message','No coupon has been found!');
            return redirect()->to(route('admin.coupon'));
        }
        
    }

    public function updated($fields)
    {

        $this->validateOnly($fields,[
            'code'       => ['required', Rule::unique('coupons')->ignore($this->coupon_id)],
            'type'       => ['required'],
            'value'      => ['required','numeric'],
            'cart_value' => ['required','numeric'],
        ]);

    }

    public function updateCoupon()
    {

        $this->validate([
            'code'       => ['required', Rule::unique('coupons')->ignore($this->coupon_id)],
            'type'       => ['required'],
            'value'      => ['required','numeric'],
            'cart_value' => ['required','numeric'],
        ]);

        $coupon             = Coupon::find($this->coupon_id)->first();
        $coupon->code       = $this->code;
        $coupon->type       = $this->type;
        $coupon->value      = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();
        session()->flash('message',$this->code . ' coupon has been Updated Successfully!');

    }


    public function render()
    {
        return view('livewire.admin.admin-coupon-edit-component')->layout('layouts.dashboard');
    }


}
