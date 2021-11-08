<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Main controller.
 */
$controller = AuthController::class;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
|
| Here is where you can define public routes that can be used by anyone.
|
*/

Route::post('/', [$controller, 'attempt'])
    ->name('login');

/*
|--------------------------------------------------------------------------
| Private routes
|--------------------------------------------------------------------------
|
| Here is where you can define private routes that can be used by specific
| users.
|
*/

Route::get('/', [$controller, 'user'])
    ->middleware(['auth:sanctum']);
