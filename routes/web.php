<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KelompokController;

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

Route::get('/', [BukuController::class, 'index']);
Route::get('/getBook', [BukuController::class, 'getBook']);
Route::get('/kelompok', [KelompokController::class, 'index']);
Route::post('/tambahKelompok', [KelompokController::class, 'store']);

Route::post('/tambahBuku', [BukuController::class, 'store']);
Route::post('/ubahBuku', [BukuController::class, 'update']);
Route::post('/hapusBuku', [BukuController::class, 'destroy']);
