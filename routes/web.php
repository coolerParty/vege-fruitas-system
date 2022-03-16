<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\HomeComponent;

use App\Http\Livewire\user\UserChangePasswordComponent;

use App\Http\Livewire\admin\AdminDashboardComponent;
use App\Http\Livewire\admin\AdminChangePasswordComponent;

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

// For User
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');			
});

// For Admin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');	
    Route::get('/admin/change-password',AdminChangePasswordComponent::class)->name('admin.changepassword');		
});
