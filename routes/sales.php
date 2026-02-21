<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Sales Routes |-------------------------------------------------------------------------- | Prefix: /sales | Name prefix: sales. |-------------------------------------------------------------------------- */

Route::prefix('sales')->name('sales.')->group(function () {

    // Sales Orders
    Route::resource('orders', \App\Http\Controllers\Sales\SalesOrderController::class);
    Route::post('orders/{order}/confirm', [\App\Http\Controllers\Sales\SalesOrderController::class , 'confirm'])
        ->name('orders.confirm');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Sales\SalesOrderController::class , 'cancel'])
        ->name('orders.cancel');
    Route::patch('orders/{order}/mark-as-paid', [\App\Http\Controllers\Sales\SalesOrderController::class , 'markAsPaid'])
        ->name('orders.mark-as-paid');

    // Delivery Orders
    Route::resource('delivery-orders', \App\Http\Controllers\Sales\DeliveryOrderController::class);

    // Sales Invoices
    Route::resource('invoices', \App\Http\Controllers\Sales\SalesInvoiceController::class);
    Route::match (['post', 'patch'], 'invoices/{invoice}/post', [\App\Http\Controllers\Sales\SalesInvoiceController::class , 'post'])
        ->name('invoices.post');
    Route::match (['post', 'patch'], 'invoices/{invoice}/void', [\App\Http\Controllers\Sales\SalesInvoiceController::class , 'void'])
        ->name('invoices.void');
});
