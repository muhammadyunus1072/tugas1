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

Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::get('/book/datatable', [BookController::class, 'getBooks'])->name('book.datatable');
Route::get('/book/get', [BookController::class, 'getBook'])->name('book.get');
Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
Route::post('/book/update', [BookController::class, 'update'])->name('book.update');
Route::post('/book/destroy', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/group/add/index', [GroupController::class, 'index'])->name('group.add.index');
Route::get('/group/index', [GroupController::class, 'viewGroup'])->name('group.index');
Route::get('/group/datatable', [GroupController::class, 'getGroups'])->name('group.datatable');
Route::post('/group/get', [GroupController::class, 'getGroupBook'])->name('group.get');
Route::post('/group/store', [GroupController::class, 'store'])->name('group.store');
Route::post('/group/edit', [GroupController::class, 'editGroup'])->name('group.update');
Route::post('/coba', [GroupController::class, 'coba'])->name('coba');
