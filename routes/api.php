<?php

use App\Http\Controllers\Forum\ForumController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/leliao')->group(function () {
    // index
    // Route::get('/home', [HomeController::class, 'index']);

    // 分類看板
    Route::get('/f/all', [ForumController::class, 'index']);
    Route::get('/f/{id}', [ForumController::class, 'show']);
});
