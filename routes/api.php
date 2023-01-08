<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\BalanceController;
use App\Http\Controllers\api\ResetController;

Route::apiResource('event', EventController::class);
Route::apiResource('balance', BalanceController::class);
Route::post('reset', [ResetController::class, 'index']);
