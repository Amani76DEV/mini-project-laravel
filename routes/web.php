<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Core\Router\Web\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/users/', [UserController::class, 'create']);
Route::post('/users/show', [UserController::class, 'show']);


