<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    /** Home */
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');



});
