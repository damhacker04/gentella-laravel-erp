<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Finance Routes |-------------------------------------------------------------------------- | Prefix: /finance | Name prefix: finance. |-------------------------------------------------------------------------- */

Route::prefix('finance')->name('finance.')->group(function () {

    // Sales Payments
    Route::resource('sales-payments', \App\Http\Controllers\Finance\SalesPaymentController::class);

    // Purchase Payments
    Route::resource('purchase-payments', \App\Http\Controllers\Finance\PurchasePaymentController::class);
});
