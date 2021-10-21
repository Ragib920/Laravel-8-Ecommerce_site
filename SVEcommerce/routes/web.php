<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;



//Admin Authentication
Route::group(['prefix' => 'admin'], function () {
    Route::get('login',[AdminController::class,'LoginView']);
    Route::post('login',[AdminController::class,'LogIn'])->name('AdminPanel.login');
    Route::get('logout',[AdminController::class,'onLogout']);
//    Route::get('updatepassword',[AdminController::class,'updatepassword']);
});

//Admin Routes
Route::group(['prefix' => 'admin','middleware' => 'admin_auth'], function () {
    Route::get('dashboard',[AdminController::class,'DashboardView']);
    //    ==========category========
    Route::get('category',[CategoryController::class,'CategoryView']);
    Route::get('category/manage_category',[CategoryController::class,'ManageCategoryView']);
    Route::post('category/manage_category_process',[CategoryController::class,'ManageCategoryProcess'])->name('category.ManageCategoryProcess');
    Route::get('category/deleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
    Route::get('category/manage_category/{id}',[CategoryController::class,'ManageCategoryView']);
    //    update category status
    Route::get('category/status/{status}/{id}',[CategoryController::class,'status']);

    //    ==========coupon========
    Route::get('coupon',[CouponController::class,'CouponView']);
    Route::get('coupon/manage_coupon',[CouponController::class,'ManageCouponView']);
    Route::post('coupon/manage_coupon_process',[CouponController::class,'ManageCouponProcess'])->name('coupon.ManageCouponProcess');
    Route::get('coupon/deleteCoupon/{id}',[CouponController::class,'DeleteCoupon']);
    Route::get('coupon/manage_coupon/{id}',[CouponController::class,'ManageCouponView']);
    //    update coupon status
    Route::get('coupon/status/{status}/{id}',[CouponController::class,'status']);

    //    ==========size========
    Route::get('size',[SizeController::class,'SizeView']);
    Route::get('size/manage_size',[SizeController::class,'ManageSizeView']);
    Route::post('size/manage_size_process',[SizeController::class,'ManageSizeProcess'])->name('size.ManageSizeProcess');
    Route::get('size/deleteSize/{id}',[SizeController::class,'DeleteSize']);
    Route::get('size/manage_size/{id}',[SizeController::class,'ManageSizeView']);
    //    update size status
    Route::get('size/status/{status}/{id}',[SizeController::class,'status']);

    //    ==========color========
    Route::get('color',[ColorController::class,'ColorView']);
    Route::get('color/manage_color',[ColorController::class,'ManageColorView']);
    Route::post('color/manage_color_process',[ColorController::class,'ManageColorProcess'])->name('color.ManageColorProcess');
    Route::get('color/deleteColor/{id}',[ColorController::class,'DeleteColor']);
    Route::get('color/manage_color/{id}',[ColorController::class,'ManageColorView']);
    //    update color status
    Route::get('color/status/{status}/{id}',[ColorController::class,'status']);


});
