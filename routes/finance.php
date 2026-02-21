<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Finance Routes |-------------------------------------------------------------------------- | Prefix: /finance | Name prefix: finance. |-------------------------------------------------------------------------- */

Route::prefix('finance')->name('finance.')->group(function () {

    // Sales Payments
    Route::resource('sales-payments', \App\Http\Controllers\Finance\SalesPaymentController::class);

    // Purchase Payments
    Route::resource('purchase-payments', \App\Http\Controllers\Finance\PurchasePaymentController::class);

    // Xendit Payments
    Route::get('xendit-payments', [\App\Http\Controllers\Finance\XenditPaymentController::class , 'index'])
        ->name('xendit-payments.index');
    Route::post('xendit-payments/{salesInvoice}/create', [\App\Http\Controllers\Finance\XenditPaymentController::class , 'create'])
        ->name('xendit-payments.create');
    Route::get('xendit-payments/{xenditPayment}', [\App\Http\Controllers\Finance\XenditPaymentController::class , 'show'])
        ->name('xendit-payments.show');
    Route::post('xendit-payments/{xenditPayment}/refresh', [\App\Http\Controllers\Finance\XenditPaymentController::class , 'refresh'])
        ->name('xendit-payments.refresh');
});
