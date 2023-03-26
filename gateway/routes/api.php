<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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

/*
|--------------------------------------------------------------------------
| Auth:
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});



/*
|--------------------------------------------------------------------------
| Post Service:
|--------------------------------------------------------------------------
*/
Route::middleware(AuthGateway::class)
    ->apiResource('post', PostController::class);

Route::middleware(AuthGateway::class)
    ->prefix('post')
    ->group(function () {
        /* Comments: */
        Route::get('{id}/comment', [CommentController::class, 'show']);
        Route::post('{id}/comment', [CommentController::class, 'store']);
    });


/*
|--------------------------------------------------------------------------
| User Service:
|--------------------------------------------------------------------------
*/
Route::middleware(AuthGateway::class)
    ->apiResource('user', UserController::class);

Route::middleware(AuthGateway::class)
    ->prefix('user')
    ->group(function () {
        /* Permissions: */
        Route::get('/{user_id}/role', [UserController::class, 'role']);
        Route::post('/{user_id}/role/{role_id}', [UserController::class, 'storeRoleToUser']);
        Route::delete('/{user_id}/role/{role_id}', [UserController::class, 'destroyRoleToUser']);
    });

Route::middleware(AuthGateway::class)
    ->apiResource('role', RoleController::class);

Route::middleware(AuthGateway::class)
    ->prefix('role')
    ->group(function () {
        /* Permissions: */
        Route::get('/{role_id}/permission', [RoleController::class, 'permission']);

        Route::post('/{role_id}/permission/{permission_id}', [RoleController::class, 'storePermissionToRole']);
        Route::delete('/{role_id}/permission/{permission_id}', [RoleController::class, 'destroyPermissionToRole']);
    });

Route::middleware(AuthGateway::class)->apiResource('permission', PermissionController::class);
