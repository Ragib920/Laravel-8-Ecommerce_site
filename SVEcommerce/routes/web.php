<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    Route::get('category',[CategoryController::class,'CategoryView']);
    Route::get('category/manage_category',[CategoryController::class,'ManageCategoryView']);
    Route::post('category/manage_category_process',[CategoryController::class,'ManageCategoryProcess'])->name('category.ManageCategoryProcess');
    Route::get('category/deleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
    Route::get('category/manage_category/{id}',[CategoryController::class,'ManageCategoryView']);



});
