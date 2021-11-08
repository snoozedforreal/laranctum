<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Path to api groups.
 */
const GROUP_PATH = __DIR__ . '/api';

/*
|--------------------------------------------------------------------------
| Groups
|--------------------------------------------------------------------------
|
| Here is where you can include API groups. API groups are defined in the
| api folder.
|
*/

/**
 * @group auth
 */
Route::prefix('auth')->group(GROUP_PATH . '/auth.php');
