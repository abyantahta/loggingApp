<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LogController::class, 'index']);
Route::post('/store',[LogController::class, 'store'])->name('store');
Route::get('/export', [LogController::class, 'export']);
