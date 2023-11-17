<?php

use App\Http\Controllers\KantorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes untuk menampilkan seluruh karyawan
Route::get('/employees', [KantorController::class, 'index']);

// Routes untuk menambahkan karyawan 
Route::post('/employees', [KantorController::class, 'strore']);

// Routes untuk mengedit data karyawan 
Route::put('/employees/{id}', [KantorController::class, 'update']);

// Routes untuk menampilkan data para karyawan secara spesifik
Route::get('/employees/{id}', [KantorController::class, 'show']);

// Routes untuk menghapus data karyawan 
Route::delete('/employees/{id}', [KantorController::class, 'destroy']);

// Routes untuk mencari nama Karyawan 
Route::get('/employees/search/{name}', [KantorController::class, 'search']);

// Routes untuk melihat karyawan yang masih bekerja
Route::get('/employees/status/active', [KantorController::class, 'active']);

// Routes untuk melihat karyawan yang sudah tidak bekerja
Route::get('/employees/status/inactive', [KantorController::class, 'Inactive']);

// Routes untuk melihat karyawan yang sudah di berhentikan oleh pihak kantor
Route::get('/employees/status/terminated', [KantorController::class, 'terminated']);