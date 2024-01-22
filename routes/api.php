<?php

use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\dash\ProductController as DashProductController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dash\api\CategoryController as ApiCategoryController;
use App\Http\Controllers\dash\api\CommentController as ApiCommentController;
use App\Http\Controllers\dash\api\ProductController as ApiProductController;
use App\Http\Controllers\dash\api\UserController;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::apiResource('categories',CategoryController::class)->middleware('apiuser');
Route::apiResource('products',ProductController::class)->middleware('apiuser');
Route::apiResource('comment',CommentController::class)->middleware('apiuser');
Route::apiResource('cart',CartController::class)->middleware('apiuser');

// -----------------------dashboard---------------------

Route::apiResource('dash/products',ApiProductController::class)->middleware('apiadmin');
Route::apiResource('dash/categories',ApiCategoryController::class)->middleware('apiadmin');
Route::apiResource('dash/users',UserController::class)->middleware('apiadmin');
Route::apiResource('dash/comments',ApiCommentController::class)->except('index')->middleware('apisuperadmin');
Route::apiResource('dash/comments',ApiCommentController::class)->only('index')->middleware('apiadmin');





