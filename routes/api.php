<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Jadwals
Route::apiResource('/jadwals', App\Http\Controllers\Api\JadwalController::class);
Route::apiResource('/kelas', App\Http\Controllers\Api\KelasController::class);
Route::apiResource('/absensi', App\Http\Controllers\Api\AbsensiController::class);
