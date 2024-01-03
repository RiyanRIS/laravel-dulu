<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;
  
Route::get('/', [AuthController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('users', [AuthController::class, 'users'])->middleware('auth:sanctum');

Route::resource('divisi', DivisiController::class)->except(['edit', 'create'])->middleware('auth:sanctum');
Route::resource('pegawai', PegawaiController::class)->except(['edit', 'create'])->middleware('auth:sanctum');
Route::resource('surat', SuratController::class)->except(['edit', 'create'])->middleware('auth:sanctum');
