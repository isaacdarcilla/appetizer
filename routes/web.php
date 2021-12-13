<?php


use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::post('/store', [EventController::class, 'store'])->name('store');
});
