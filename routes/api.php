<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('', 'create');
        Route::put('/{id}', 'update');
        Route::get('', 'findAll');
        Route::get('/{id}', 'findById');
        Route::delete('/{id}', 'delete');
    });
});
