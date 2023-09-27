<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);


Route::get('category',function(){
    $category = Category::get();
     return response()->json([
       'category' => $category
     ]);
})->middleware('auth:sanctum');

//get Post api
Route::get('allPost',[PostController::class,'allPost']);

//get Category api
Route::get('allCategory',[CategoryController::class,'allCategory']);

//post search
Route::post('post/search',[PostController::class,'postSearch']);

//Category search
Route::post('category/search',[CategoryController::class,'categorySearch']);

//post Details
Route::post('post/details',[PostController::class,'postDetails']);

//Action Log
Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);

//Comment
Route::post('post/comment',[PostController::class,'comment']);
Route::post('post/getComment',[PostController::class,'getComment']);

