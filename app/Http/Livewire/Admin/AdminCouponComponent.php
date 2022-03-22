<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
use Illuminate\Pagination\Paginator;

class AdminCouponComponent extends Component
{


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


    public function deleteCoupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('del_message','Coupon has been deleted successfully');
        return redirect()->to(route('admin.coupon'));
    }


    public function render()
    {
        if(!empty($this->searchname))
        { 
            $coupons = Coupon::where('code','like','%' . $this->searchname . '%')->orderby('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
            $coupons->withPath(route('admin.coupon').'?searchname='.$this->searchname);
        }
        else
        {
            $coupons = Coupon::orderby('created_at','DESC')->paginate($this->PAGE_NUMBER_LIMIT);
        }

        return view('livewire.admin.admin-coupon-component',['coupons'=>$coupons])->layout('layouts.dashboard');
    }


}
