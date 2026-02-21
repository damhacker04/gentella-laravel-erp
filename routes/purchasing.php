<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Purchasing Routes |-------------------------------------------------------------------------- | Prefix: /purchasing | Name prefix: purchasing. |-------------------------------------------------------------------------- */

Route::prefix('purchasing')->name('purchasing.')->group(function () {

    // Purchase Orders
    Route::resource('orders', \App\Http\Controllers\Purchasing\PurchaseOrderController::class);
    Route::post('orders/{order}/confirm', [\App\Http\Controllers\Purchasing\PurchaseOrderController::class , 'confirm'])
        ->name('orders.confirm');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Purchasing\PurchaseOrderController::class , 'cancel'])
        ->name('orders.cancel');

    // Goods Receipts
    Route::resource('goods-receipts', \App\Http\Controllers\Purchasing\GoodsReceiptController::class);

    // Purchase Invoices
    Route::resource('invoices', \App\Http\Controllers\Purchasing\PurchaseInvoiceController::class);
    Route::post('invoices/{invoice}/post', [\App\Http\Controllers\Purchasing\PurchaseInvoiceController::class , 'post'])
        ->name('invoices.post');
});
