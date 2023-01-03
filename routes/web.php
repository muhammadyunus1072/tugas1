<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GroupController;

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

Route::get('/', [BookController::class, 'index']);
Route::get('/getBooks', [BookController::class, 'getBooks']);
Route::get('/getBook', [BookController::class, 'getBook']);
Route::get('/viewAddGroup', [GroupController::class, 'index']);
Route::post('/addGroup', [GroupController::class, 'store']);
Route::post('/editGroup', [GroupController::class, 'editGroup']);
Route::get('/viewGroup', [GroupController::class, 'viewGroup']);
Route::post('/getBooks', [BookController::class, 'getBooks']);
Route::post('/getGroups', [GroupController::class, 'getGroups']);
Route::post('/getGroupBook', [GroupController::class, 'getGroupBook']);
Route::post('/coba', [GroupController::class, 'coba']);

Route::post('/addBook', [BookController::class, 'store']);
Route::post('/editBook', [BookController::class, 'update']);
Route::post('/deleteBook', [BookController::class, 'destroy']);
