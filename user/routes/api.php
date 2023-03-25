<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:sanctum')
    ->prefix('user')
    ->group(function () {
        Route::apiResource('/',UserController::class);
        /* Permissions: */
        Route::get('/{user}/role',[UserController::class,'role']);

        Route::post('/{user}/role/{role}',[UserController::class,'storeRoleToUser']);
        Route::delete('/{user}/role/{role}',[UserController::class,'destroyRoleToUser']);
    });

Route::middleware('auth:sanctum')
    ->prefix('role')
    ->group(function () {
        Route::apiResource('/',RoleController::class);
        /* Permissions: */
        Route::get('/{role}/permission',[RoleController::class,'permission']);

        Route::post('/{role}/permission/{permission}',[RoleController::class,'storePermissionToRole']);
        Route::delete('/{role}/permission/{permission}',[RoleController::class,'destroyPermissionToRole']);
    });

Route::middleware('auth:sanctum') ->apiResource('permission',PermissionController::class);

Route::prefix('auth')->group(function (){

    Route::post('/login', [AuthController::class,'login']);

    Route::post('/check-token', [AuthController::class,'checkToken']);

});


