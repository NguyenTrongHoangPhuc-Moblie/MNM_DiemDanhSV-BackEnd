<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\PhongHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\TrinhDoController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\ChuyenMonController;
use App\Http\Controllers\GiaoVienController;
use App\Http\Controllers\LichHocController;

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
//PhongHoc
Route::post('themPH', [PhongHocController::class, 'themPhongHoc']);
Route::get('danhSachPH', [PhongHocController::class, 'danhSachPH']);
Route::delete('xoaPH/{id}', [PhongHocController::class, 'xoaPH']);
Route::get('layPH/{id}', [PhongHocController::class, 'layPH']);
Route::get('timPH/{key}', [PhongHocController::class, 'timPH']);
Route::post('suaPH/{id}', [PhongHocController::class, 'capNhatPH']);
//MonHoc
Route::post('themMH', [MonHocController::class, 'themMH']);
Route::get('danhSachMH', [MonHocController::class, 'danhSachMH']);
Route::delete('xoaMH/{id}', [MonHocController::class, 'xoaMH']);
Route::get('layMH/{id}', [MonHocController::class, 'layMH']);
Route::get('timMH/{key}', [MonHocController::class, 'timMH']);
Route::post('suaMH/{id}', [MonHocController::class, 'capNhatMH']);
//Nganh
Route::post('themNganh', [NganhController::class, 'themNganh']);
Route::get('danhSachNganh', [NganhController::class, 'danhSachNganh']);
Route::delete('xoaNganh/{id}', [NganhController::class, 'xoaNganh']);
Route::get('layNganh/{id}', [NganhController::class, 'layNganh']);
Route::get('timNganh/{key}', [NganhController::class, 'timNganh']);
Route::post('suaNganh/{id}', [NganhController::class, 'capNhatNganh']);
//TrinhDo
Route::post('themTD', [TrinhDoController::class, 'themTD']);
Route::get('danhSachTD', [TrinhDoController::class, 'danhSachTD']);
Route::delete('xoaTD/{id}', [TrinhDoController::class, 'xoaTD']);
Route::get('layTD/{id}', [TrinhDoController::class, 'layTD']);
Route::get('timTD/{key}', [TrinhDoController::class, 'timTD']);
Route::post('suaTD/{id}', [TrinhDoController::class, 'capNhatTD']);
//Khoa
Route::post('themKhoa', [KhoaController::class, 'themKhoa']);
Route::get('danhSachKhoa', [KhoaController::class, 'danhSachKhoa']);
Route::delete('xoaKhoa/{id}', [KhoaController::class, 'xoaKhoa']);
Route::get('layKhoa/{id}', [KhoaController::class, 'layKhoa']);
Route::get('timKhoa/{key}', [KhoaController::class, 'timKhoa']);
Route::post('suaKhoa/{id}', [KhoaController::class, 'capNhatKhoa']);
//ChuyenMon
Route::post('themCM', [ChuyenMonController::class, 'themCM']);
Route::get('danhSachCM', [ChuyenMonController::class, 'danhSachCM']);
Route::delete('xoaCM/{id}', [ChuyenMonController::class, 'xoaCM']);
Route::get('layCM/{id}', [ChuyenMonController::class, 'layCM']);
Route::get('timCM/{key}', [ChuyenMonController::class, 'timCM']);
Route::post('suaCM/{id}', [ChuyenMonController::class, 'capNhatCM']);
//GiaoVien
Route::post('themGV', [GiaoVienController::class, 'themGV']);
Route::get('danhSachGV', [GiaoVienController::class, 'danhSachGV']);
Route::delete('xoaGV/{id}', [GiaoVienController::class, 'xoaGV']);
Route::get('layGV/{id}', [GiaoVienController::class, 'layGV']);
Route::get('timGV/{key}', [GiaoVienController::class, 'timGV']);
Route::post('suaGV/{id}', [GiaoVienController::class, 'capNhatGV']);
//GiaoVien
Route::post('themTGH', [LichHocController::class, 'themTGH']);
Route::get('danhSachTGH', [LichHocController::class, 'danhSachTGH']);
Route::delete('xoaTGH/{id}', [LichHocController::class, 'xoaTGH']);
Route::get('layTGH/{id}', [LichHocController::class, 'layTGH']);
Route::get('timTGH/{key}', [LichHocController::class, 'timTGH']);
Route::post('suaTGH/{id}', [LichHocController::class, 'capNhatTGH']);
