<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthGateway;
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

Route::get('/health', function () {
    return json_encode([
        "PodName" => gethostname(),
        "ip" => $_SERVER['REMOTE_ADDR'],
        "role" => env('APP_NAME'),
        "status" => "UP"
    ]);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware(AuthGateway::class)
    ->prefix('post')
    ->group(function () {
        Route::get('/',[PostController::class , 'index']);
        Route::get('/{id}',[PostController::class , 'show']);
        Route::post('/',[PostController::class , 'store']);
    });

Route::middleware(AuthGateway::class)
    ->prefix('user')
    ->group(function () {
        Route::get('/',[UserController::class , 'index']);
        Route::get('/{id}',[UserController::class , 'show']);
        Route::post('/',[UserController::class , 'store']);
    });
