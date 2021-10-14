<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LogController;


Route::group(['prefix' => 'v1'], function(){
    
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    
});