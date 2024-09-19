<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\API\AuthController;

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

Route::post('/addKelas',[KelasController::class,'addKelas']);
Route::get('/getKelas',[KelasController::class,'getKelas']);
Route::put('/updateKelas/{id_kelas}',[KelasController::class,'updateKelas']);
Route::delete('/deleteKelas/{id_kelas}',[KelasController::class,'deleteKelas']);

Route::post('/addSiswa',[SiswaController::class,'addSiswa']);
Route::get('/getSiswa',[SiswaController::class,'getSiswa']);
Route::put('/updateSiswa/{id_siswa}',[SiswaController::class,'updateSiswa']);
Route::delete('/deleteSiswa/{id_siswa}',[SiswaController::class,'deleteSiswa']);

Route::post('/addBuku',[BukuController::class,'addBuku']);
Route::get('/getBuku',[BukuController::class,'getBuku']);
Route::put('/updateBuku/{id_buku}',[BukuController::class,'updateBuku']);
Route::delete('/deleteBuku/{id_buku}',[BukuController::class,'deleteBuku']);

Route::post('/rentBuku',[TransaksiController::class,'rentBuku']);
Route::post('/addItem/{id}',[TransaksiController::class,'addItem']);
Route::post('/returnBuku',[TransaksiController::class,'returnBuku']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});