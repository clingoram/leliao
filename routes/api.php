<?php

use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LogoutController;

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
    // 分類看板
    Route::get('/f/all', [ForumController::class, 'index']);
    Route::get('/f/{id}', [ForumController::class, 'show']);

    // register
    // Route::post('auth/register', [RegisterController::class, 'create']);
    // // login
    // Route::post('auth/login', [LoginController::class, 'login']);

    // Route::get('auth/refresh', [UserController::class, 'refresh']);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [RegisterController::class, 'create']);
        // login
        Route::post('login', [LoginController::class, 'login']);
        Route::post('refresh', [UserController::class, 'refresh']);
    });

    Route::group(['middleware' => 'api'], function () {
        // http://leliao/api/lel/users
        Route::get('user', [UserController::class, 'checkUserIsset']);
        // logout
        Route::post('logout', [LogoutController::class, 'logout']);
    });
});
