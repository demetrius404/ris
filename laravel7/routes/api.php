<?php

use App\Http\Controllers\Operations as OperationsController;
use App\Http\Controllers\Reports as ReportsController;

use Illuminate\Support\Facades\Route;

Route::post('/api/socks/income', [OperationsController::class, 'income']);
Route::post('/api/socks/outcome', [OperationsController::class, 'outcome']);
Route::get('/api/socks', [ReportsController::class, 'balance']);
