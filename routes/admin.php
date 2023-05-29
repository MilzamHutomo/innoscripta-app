<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->name('admin.')
    ->group(function () {

        Route::resource('user', UserController::class);
});

?>