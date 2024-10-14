<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login_submit', [AuthController::class, 'login_submit'])->name('login_submit');

Route::get('create_account', function () {
    return view('create_account');
})->name('create_account');

Route::post('check_account', [AuthController::class, 'check_account'])->name('check_account');
