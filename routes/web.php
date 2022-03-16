<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\HomeComponent;

use App\Http\Livewire\admin\AdminDashboardComponent;

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

// For Admin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');			
});
