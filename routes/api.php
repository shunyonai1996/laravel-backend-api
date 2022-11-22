<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CEOController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\NotificationController;

Route::post('/collection', [App\Http\Controllers\API\CollectionController::class, 'store']);

Route::get('/user', [App\Http\Controllers\API\UserController::class, 'index']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

Route::apiResource('/ceo', (App\Http\Controllers\API\CEOController::class))->middleware('auth:api');
Route::apiResource('/notification', (App\Http\Controllers\API\NotificationController::class))->middleware('auth:api');