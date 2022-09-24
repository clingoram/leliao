<?php

use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\User\ManagementController;

use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Comment\CommentController;

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

    // modal 單一類別的某篇文章，例如工作版內的文章C
    Route::get('/f/{category_id}/post/{post_id}', [PostController::class, 'show']);

    // modal 取單一文章的留言
    Route::get('/f/{category_id}/post/c/{post_id}', [CommentController::class, 'show']);

    // 註冊，功能OK，但先暫時註解(相關檔案:router.js、UserMenu router)
    Route::post('/user/register', [RegisterController::class, 'create']);
    // 登入
    Route::post('/user/login', [LoginController::class, 'login']);

    // Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {

        // realtime chat
        // Route::get('/messages', []);

        // 新增文章
        Route::post('/add_post', [PostController::class, 'create']);

        // modal 回覆(留言)該文章
        Route::post('/f/{category_id}/post/r/{post_id}', [CommentController::class, 'createReply']);

        // modal 針對留言按like(愛心)
        Route::put('/f/{category_id}/post/r/{post_id}/l/{comment_id}', [CommentController::class, 'update']);

        // 帳號資訊頁面
        Route::get('/management/{id}/{name}', [ManagementController::class, 'checkRole']);
        // 取得該帳號所有留言
        Route::get('/allreplies/{id}/{name}', [PostController::class, 'getAllReplies']);

        // 登出(token未過期)
        Route::post('/logout', [LogoutController::class, 'logout']);
    });
    // 在token過期狀況下，刪除token
    // Route::post('/logout/d', [LogoutController::class, 'destroy']);
});
