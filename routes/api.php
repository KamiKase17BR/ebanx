<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EventController;

Route::apiResource('event', EventController::class);
