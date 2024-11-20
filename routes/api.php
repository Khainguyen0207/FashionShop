<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\SettupController;

Route::get('/users', [UserController::class, 'index']);