<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function () {

    // route user NOT logged
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login_submit', [AuthController::class, 'login_submit'])->name('login_submit');
    Route::get('create_account', [AuthController::class, 'create_account'])->name('create_account');
    Route::post('check_account', [AuthController::class, 'check_account'])->name('check_account');
});



Route::middleware([CheckIsLogged::class])->group(function (){

    // route user logged
    Route::get('/', [MainController::class, 'index'])->name('home');
    // create new note
    Route::get('new_note', [MainController::class, 'new_note'])->name('new_note');
    Route::post('new_note_submit', [MainController::class, 'new_note_submit'])->name('new_note_submit');
    // logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    // edit note
    Route::get('edit/{id}', [MainController::class, 'edit'])->name('edit');
    Route::post('edit_submit', [MainController::class, 'edit_submit'])->name('edit_submit');
    // delete note
    Route::get('delete/{id}', [MainController::class, 'delete'])->name('delete');
    Route::get('delete_confirm/{id}',[MainController::class, 'delete_confirm'])->name('delete_confirm');
});
