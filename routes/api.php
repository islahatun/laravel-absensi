<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\api\IzinController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/checkIn', [AttendanceController::class, 'checkIn'])->middleware('auth:sanctum');
Route::post('/checkOut', [AttendanceController::class, 'checkOut'])->middleware('auth:sanctum');
Route::post('/isCheckedIn', [AttendanceController::class, 'isCheckedIn'])->middleware('auth:sanctum');
Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::post('/createIzin', [IzinController::class, 'createIzin'])->middleware('auth:sanctum');
