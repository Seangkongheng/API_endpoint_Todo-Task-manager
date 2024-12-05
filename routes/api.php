<?php

use App\Http\Controllers\GenderController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskContrller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::Post('staff/store',[StaffController::class , "store"]);
Route::get('staff/index',[StaffController::class , "index"]);
Route::get('staff/show/{id}',[StaffController::class , "show"]);
Route::put('staff/update/{id}',[StaffController::class , "update"]);
Route::delete('staff/destroy/{id}',[StaffController::class , "destroy"]);


Route::Post('task/store',[TaskContrller::class , "store"]);
Route::get('task/index',[TaskContrller::class , "index"]);
Route::get('task/show/{id}',[TaskContrller::class , "show"]);
Route::put('task/update/{id}',[TaskContrller::class , "update"]);
Route::delete('task/destroy/{id}',[TaskContrller::class , "destroy"]);
Route::get('task/staff/{id}',[TaskContrller::class , "getStaffTask"]);

Route::get('user/index',[UserController::class , "index"]);
Route::Post('user/register',[UserController::class , "register"]);
Route::post('user/login',[UserController::class , "login"]);
Route::post('user/logout',[UserController::class , "logout"]);

Route::get('position/index',[PositionController::class , "index"]);
Route::get('gender/index',[GenderController::class , "index"]);

