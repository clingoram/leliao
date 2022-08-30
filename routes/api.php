<?php

use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\Forum\ForumController;
// use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Secret\SecretController;

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/lel')->group(function () {
    // Public routes
    // 分類看板
    Route::get('/f/all', [ForumController::class, 'index']);
    Route::get('/f/{id}', [ForumController::class, 'show']);

    // register
    Route::post('/user/register', [RegisterController::class, 'create']);
    // login
    Route::post('/user/login', [LoginController::class, 'login']);
    // Route::get('/secrets', [SecretController::class, 'index']);

    // Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/add_post', [PostController::class, 'create']);
        // Route::get('/user/{id}', [UserController::class, 'user']);
        Route::post('/logout', [LogoutController::class, 'logout']);
    });
});
