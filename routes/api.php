<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;

Route::get('/', function(){
    return response()->json(
        array(
            'status' => true,
            'message' => 'Selamat Datang!',
            'data' => ''
        )
    );
});

Route::resource('divisi', DivisiController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('surat', SuratController::class);
