<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('/categories', CategoriesController::class);
});
