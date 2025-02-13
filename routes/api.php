<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register'])->name('Register');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
