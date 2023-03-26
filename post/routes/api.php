<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::apiResource('post', PostController::class);

Route::get('post/{post}/comment',[CommentController::class,'show']);

Route::post('post/{post}/comment',[CommentController::class,'store']);
