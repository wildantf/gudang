<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// HOME 
Route::get('/', [ItemController::class, 'index'])->name('home');

// ITEM RESOURCE 
Route::resource('items', ItemController::class)->middleware('auth')->except(['show','index','edit']);

// SISTEM Otentikasi
require __DIR__ . '/auth.php';
