<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CEOController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\NotificationController;

Route::apiResource('/collection', CollectionController::class);

Route::get('/user', [UserController::class, 'index']);
Route::post('/hidepopup', [UserController::class, 'hidepopup'])->middleware('auth:api');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::apiResource('/ceo', (CEOController::class))->middleware('auth:api');

Route::apiResource('/notification', (NotificationController::class))->middleware('auth:api');
Route::get('/notify', [NotificationController::class, 'notify'])->middleware('auth:api');