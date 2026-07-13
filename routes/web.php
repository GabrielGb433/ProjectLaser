<?php

use App\Http\Controllers\Site\GaleriaController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/fotos', GaleriaController::class)->name('fotos.index');
