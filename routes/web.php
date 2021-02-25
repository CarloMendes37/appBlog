<?php


use Illuminate\Support\Facades\Route;

use App\http\Controllers\HomeController;
use App\http\Controllers\AdminController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('home');
//});
Route::get('/', [HomeController::class, 'home']);

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'submit_login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

//Categories
Route::get('/admin/category/{id}/delete', [CategoryController::class, 'destroy']);
Route::resource('/admin/category', CategoryController::class);

//Posts
Route::get('/admin/post/{id}/delete', [PostController::class, 'destroy']);
Route::resource('/admin/post', PostController::class);
