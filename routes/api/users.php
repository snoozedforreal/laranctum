<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Main controller.
 */
$controller = UserController::class;

/*
|--------------------------------------------------------------------------
| Private routes
|--------------------------------------------------------------------------
|
| Here is where you can define private routes that can be used by specific
| users.
|
*/

Route::get('/', [$controller, 'index'])
    ->middleware(['auth:sanctum']);

Route::post('/', [$controller, 'store'])
    ->middleware(['auth:sanctum']);

Route::get('/{user}', [$controller, 'show'])
    ->middleware(['auth:sanctum']);

Route::put('/{user}', [$controller, 'update'])
    ->middleware(['auth:sanctum']);

Route::delete('/{user}', [$controller, 'destroy'])
    ->middleware(['auth:sanctum']);
