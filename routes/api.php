<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\PhongHocController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});

Route::get('nguoidung', [NguoiDungController::class, 'index']);
Route::post('register', [NguoiDungController::class, 'register']);
Route::post('login', [NguoiDungController::class, 'login']);
Route::post('themPhongHoc', [PhongHocController::class, 'themPhongHoc']);
Route::get('danhSachPH', [PhongHocController::class, 'danhSachPH']);
Route::delete('xoaPH/{id}', [PhongHocController::class, 'xoaPH']);
Route::get('layPH/{id}', [PhongHocController::class, 'layPH']);
Route::get('timPH/{key}', [PhongHocController::class, 'timPH']);