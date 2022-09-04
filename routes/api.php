<?php

use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\Forum\ForumController;
// use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Post\PostController;

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
    // 首頁，所有分類看板
    Route::get('/f/all', [ForumController::class, 'index']);
    // 單一類別內的所有文章，例如閒聊版內的所有文章
    Route::get('/f/{id}/posts', [ForumController::class, 'show']);

    // 首頁，不分類別的全部文章
    // Route::get('/posts', [PostController::class, 'index']);

    // 單一類別的某篇文章，例如工作版內的文章C
    Route::get('/f/{category_id}/post/{post_id}', [PostController::class, 'show']);

    // register
    Route::post('/user/register', [RegisterController::class, 'create']);
    // login
    Route::post('/user/login', [LoginController::class, 'login']);

    // Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('/add_post', [PostController::class, 'create']);

        // 回覆(留言)該文章
        Route::post('/f/{category_id}/post/r/{post_id}', [PostController::class, 'reply']);

        // Route::get('/user/{id}', [UserController::class, 'user']);

        Route::post('/logout', [LogoutController::class, 'logout']);
    });
});
