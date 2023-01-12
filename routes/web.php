<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

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

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     return view('welcome');
// });

Route::get('/', [RecipeController::class, 'index'])->middleware(UserAuth::class);
Route::post('/store', [RecipeController::class, 'store'])->middleware(UserAuth::class);
Route::view('/create', 'create')->middleware(UserAuth::class);

Route::view('/register', 'register');
Route::view('/login', 'login');

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('logout', [UserController::class, 'logout']);