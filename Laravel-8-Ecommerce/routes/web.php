<?php

use Illuminate\Support\Facades\Route;



Route::get('/',\App\Http\Livewire\HomeComponent::class);

Route::get('/shop',\App\Http\Livewire\ShopComponent::class);

Route::get('/cart',\App\Http\Livewire\CartComponent::class);

Route::get('/checkout',\App\Http\Livewire\CheckoutComponent::class);

Route::get('/contact-us',\App\Http\Livewire\ ContactUsComponent::class);
Route::get('/about-us',\App\Http\Livewire\AboutUsComponent::class);

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//for customer or user
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get('user/dashboard',\App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});


//for Admin
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get('admin/dashboard',\App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');

});
