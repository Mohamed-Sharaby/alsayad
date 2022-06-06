<?php

use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RestaurantInvoiceController;
use Illuminate\Support\Facades\Route;


///////////////////////////// Vue Routes /////////////////////////////////////////////////


Route::group(['as' => 'restaurant.'], function () {

    Route::get('restaurant/products', [RestaurantInvoiceController::class,'get_products']);
    Route::post('restaurant/save-invoice', [RestaurantInvoiceController::class, 'save_invoice']);
});
