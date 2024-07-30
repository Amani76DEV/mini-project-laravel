<?php

use App\Http\Controllers\UserControllerApi;
use Core\Router\Api\Route;

Route::get('create_user',[UserControllerApi::class, 'index']);