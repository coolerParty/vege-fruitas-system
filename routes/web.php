<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\SearchProductComponent;
use App\Http\Livewire\ProductDetailsComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\CheckoutComponent;

use App\Http\Livewire\user\UserChangePasswordComponent;

use App\Http\Livewire\admin\AdminDashboardComponent;
use App\Http\Livewire\admin\AdminChangePasswordComponent;
use App\Http\Livewire\admin\AdminUserListComponent;

use App\Http\Livewire\admin\AdminCategoryComponent;
use App\Http\Livewire\admin\AdminCategoryAddComponent;
use App\Http\Livewire\admin\AdminCategoryEditComponent;

use App\Http\Livewire\admin\AdminProductComponent;
use App\Http\Livewire\admin\AdminProductAddComponent;
use App\Http\Livewire\admin\AdminProductEditComponent;

use App\Http\Livewire\admin\AdminBlogComponent;
use App\Http\Livewire\admin\AdminBlogAddComponent;
use App\Http\Livewire\admin\AdminBlogEditComponent;

use App\Http\Livewire\admin\AdminContactComponent;

use App\Http\Livewire\admin\AdminCouponComponent;
use App\Http\Livewire\admin\AdminCouponAddComponent;
use App\Http\Livewire\admin\AdminCouponEditComponent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// // Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
// //     return view('dashboard');
// // })->name('dashboard');

// for guest
Route::get('/',HomeComponent::class)->name('home');
Route::get('/contact-us',ContactComponent::class)->name('contact.index');
Route::get('/shop',ShopComponent::class)->name('shop.index');
Route::get('/search-product',SearchProductComponent::class)->name('product.search');
Route::get('/product/{product_id}/{slug}',ProductDetailsComponent::class)->name('product.details');
Route::get('/cart',CartComponent::class)->name('cart.index');
Route::get('/wishlist',WishlistComponent::class)->name('wishlist.index');
Route::get('/checkout',CheckoutComponent::class)->name('checkout.index');

// For User
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');			
});

// For Admin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){

    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');	
    Route::get('/admin/change-password',AdminChangePasswordComponent::class)->name('admin.changepassword');	
    Route::get('/admin/user-list',AdminUserListComponent::class)->name('admin.userlist');	

    Route::get('/admin/category',AdminCategoryComponent::class)->name('admin.category');	
    Route::get('/admin/category/add',AdminCategoryAddComponent::class)->name('admin.categoryadd');	
    Route::get('/admin/category/edit/{category_id}',AdminCategoryEditComponent::class)->name('admin.categoryedit');	

    Route::get('/admin/product',AdminProductComponent::class)->name('admin.product');	
    Route::get('/admin/product/add',AdminProductAddComponent::class)->name('admin.productadd');	
    Route::get('/admin/product/edit/{product_id}',AdminProductEditComponent::class)->name('admin.productedit');	

    Route::get('/admin/blog',AdminBlogComponent::class)->name('admin.blog');	
    Route::get('/admin/blog/add',AdminBlogAddComponent::class)->name('admin.blogadd');	
    Route::get('/admin/blog/edit/{blog_id}',AdminBlogEditComponent::class)->name('admin.blogedit');	

    Route::get('/admin/contact',AdminContactComponent::class)->name('admin.contact');	

    Route::get('/admin/coupon',AdminCouponComponent::class)->name('admin.coupon');	
    Route::get('/admin/coupon/add',AdminCouponAddComponent::class)->name('admin.couponadd');	
    Route::get('/admin/coupon/edit/{coupon_id}',AdminCouponEditComponent::class)->name('admin.couponedit');	

});
