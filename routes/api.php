<?php

use App\Http\Controllers\BangDiemDanhController;
use App\Http\Controllers\DanhSachSinhVien_LopHocPhanController;
use App\Http\Controllers\LopNienCheController;
use App\Http\Controllers\SinhVienController;
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
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LopHocPhanController;
use App\Http\Controllers\ChiTietNgayHocController;
use App\Http\Controllers\NgayHocController;
use App\Http\Controllers\TietHocController;


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
Route::get('kiemTraPQ/{id}', [NguoiDungController::class, 'kiemTraPQ']);
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
//LopHocPhan
Route::post('themLHP', [LopHocPhanController::class, 'themLHP']);
Route::get('danhSachLHP', [LopHocPhanController::class, 'danhSachLHP']);
Route::delete('xoaLHP/{id}', [LopHocPhanController::class, 'xoaLHP']);
Route::get('layLHP/{id}', [LopHocPhanController::class, 'layLHP']);
Route::get('timLHP/{key}', [LopHocPhanController::class, 'timLHP']);
Route::post('suaLHP/{id}', [LopHocPhanController::class, 'capNhatLHP']);
//ChiTietNgayHoc
Route::post('themCTNH', [ChiTietNgayHocController::class, 'themCTNH']);
Route::get('danhSachCTNH', [ChiTietNgayHocController::class, 'danhSachCTNH']);
Route::delete('xoaCTNH/{id}', [ChiTietNgayHocController::class, 'xoaCTNH']);
Route::get('layCTNH/{id}', [ChiTietNgayHocController::class, 'layCTNH']);
Route::get('timCTNH/{key}', [ChiTietNgayHocController::class, 'timCTNH']);
Route::post('suaCTNH/{id}', [ChiTietNgayHocController::class, 'capNhatCTNH']);
//LopNienChe
Route::post('themLNC', [LopNienCheController::class, 'themLNC']);
Route::get('danhSachLNC', [LopNienCheController::class, 'danhSachLNC']);
Route::delete('xoaLNC/{id}', [LopNienCheController::class, 'xoaLNC']);
Route::get('layLNC/{id}', [LopNienCheController::class, 'layLNC']);
Route::get('timLNC/{key}', [LopNienCheController::class, 'timLNC']);
Route::post('suaLNC/{id}', [LopNienCheController::class, 'capNhatLNC']);
//TietHoc
Route::post('themTH', [TietHocController::class, 'themTH']);
Route::get('danhSachTH', [TietHocController::class, 'danhSachTH']);
Route::delete('xoaTH/{id}', [TietHocController::class, 'xoaTH']);
Route::get('layTH/{id}', [TietHocController::class, 'layTH']);
Route::get('timTH/{key}', [TietHocController::class, 'timTH']);
Route::post('suaTH/{id}', [TietHocController::class, 'capNhatTH']);
//SinhVien
Route::post('themSV', [SinhVienController::class, 'themSV']);
Route::get('danhSachSV', [SinhVienController::class, 'danhSachSV']);
Route::delete('xoaSV/{id}', [SinhVienController::class, 'xoaSV']);
Route::get('laySV/{id}', [SinhVienController::class, 'laySV']);
Route::get('timSV/{key}', [SinhVienController::class, 'timSV']);
Route::post('suaSV/{id}', [SinhVienController::class, 'capNhatSV']);
//SinhVien
Route::post('themDSSV_LHP', [DanhSachSinhVien_LopHocPhanController::class, 'themDSSV_LHP']);
Route::get('danhSachDSSV_LHP', [DanhSachSinhVien_LopHocPhanController::class, 'danhSachDSSV_LHP']);
Route::delete('xoaDSSV_LHP/{masv}/{malop}', [DanhSachSinhVien_LopHocPhanController::class, 'xoaDSSV_LHP']);
Route::get('layDSSV_LHP/{masv}/{malop}', [DanhSachSinhVien_LopHocPhanController::class, 'layDSSV_LHP']);
Route::get('timDSSV_LHP/{masv}/{malop}', [DanhSachSinhVien_LopHocPhanController::class, 'timDSSV_LHP']);
Route::post('suaDSSV_LHP/{masv}/{malop}', [DanhSachSinhVien_LopHocPhanController::class, 'capNhatDSSV_LHP']);
//Calendar
Route::get('danhSachCalendar', [CalendarController::class, 'danhSachCalendar']);
//BangDiemDanh
Route::post('themBDD', [BangDiemDanhController::class, 'themBDD']);
Route::get('danhSachBDD/{tenlop}', [BangDiemDanhController::class, 'danhSachBDD']);