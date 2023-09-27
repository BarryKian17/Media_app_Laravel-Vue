<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['admin_auth'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('auth#home');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('update',[ProfileController::class,'infoUpdate'])->name('admin#update');
    Route::get('change/password',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('passwordUpdate',[ProfileController::class,'passwordUpdate'])->name('admin#passwordUpdate');
    Route::get('delete/{id}',[ProfileController::class,'delete'])->name('admin#delete');



    //admin List
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');

     //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('categoryCreate',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('categoryDelete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::get('categoryUpdatePage/{id}',[CategoryController::class,'categoryUpdatePage'])->name('admin#categoryUpdatePage');
    Route::post('categoryUpdate',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('postCreate',[PostController::class,'postCreate'])->name('admin#postCreate');
    Route::get('postDelete/{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::get('postEdit/{id}',[PostController::class,'postEdit'])->name('admin#postEdit');
    Route::post('postUpdate',[PostController::class,'postUpdate'])->name('admin#postUpdate');




    //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trend/detail/{id}',[TrendPostController::class,'detail'])->name('admin#trendDetail');

});
