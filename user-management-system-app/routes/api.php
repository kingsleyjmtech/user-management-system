<?php

use App\Http\Controllers\OrganisationApiController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UserApiController::class, 'register']);
Route::post('/login', [UserApiController::class, 'login']);

// Protect routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserApiController::class, 'show']);
    Route::put('/user', [UserApiController::class, 'update']);

    Route::post('/organisations', [OrganisationApiController::class, 'store']);
});
