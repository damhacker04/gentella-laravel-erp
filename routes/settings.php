<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Settings Routes (Admin only) |-------------------------------------------------------------------------- | Prefix: /settings | Name prefix: settings. |-------------------------------------------------------------------------- */

Route::prefix('settings')->name('settings.')->middleware('role:Admin')->group(function () {

    // Users
    Route::resource('users', \App\Http\Controllers\Settings\UserController::class);

    // Roles & Permissions
    Route::resource('roles', \App\Http\Controllers\Settings\RoleController::class);
});
