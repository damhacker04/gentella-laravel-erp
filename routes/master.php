<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Master Data Routes |-------------------------------------------------------------------------- | Prefix: /master | Name prefix: master. |-------------------------------------------------------------------------- */

Route::prefix('master')->name('master.')->group(function () {

    // Customers
    Route::resource('customers', \App\Http\Controllers\Master\CustomerController::class);

    // Suppliers
    Route::resource('suppliers', \App\Http\Controllers\Master\SupplierController::class);

    // Products
    Route::resource('products', \App\Http\Controllers\Master\ProductController::class);

    // Warehouses
    Route::resource('warehouses', \App\Http\Controllers\Master\WarehouseController::class);

    // Payment Terms
    Route::resource('payment-terms', \App\Http\Controllers\Master\PaymentTermController::class)
        ->except(['show']);
});
