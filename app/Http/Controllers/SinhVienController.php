<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SinhVienController extends Controller
{
    public function index()
    {
        $sv = SinhVien::with('Khoa', 'Nganh', 'LopNienChe')->get();

        return response()->json([
            'success' => true,
            'data' => $sv
        ]);
    }
    function themSV(Request $req)
    {
        $sv = new SinhVien;
        $sv->HoTenSV = $req->input('HoTenSV');
        $namSinh = Carbon::createFromFormat('Y-m-d', $req->input('NgaySinh'))->format('Y-m-d');
        $sv->NgaySinh = $namSinh;
        $sv->GioiTinh = $req->input('GioiTinh');
        $sv->Email = $req->input('Email');
        $sv->SoDienThoai = $req->input('SoDienThoai');
        $sv->DiaChi = $req->input('DiaChi');
        $sv->MaKhoa = $req->input('MaKhoa');
        $sv->MaNganh = $req->input('MaNganh');
        $sv->MaLNC = $req->input('MaLNC');
        $sv->save();

        return $sv;
    }

    function danhSachsv()
    {
        return SinhVien::all();
    }

    function xoasv($id)
    {
        #return $id;
        $result = SinhVien::where('MaSV', $id)->delete();
        if ($result) {
            return ["result" => "Giao vien da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function laysv($id)
    {
        #return $id;
        $sv = SinhVien::where('MaSV', $id)->first();
        return response()->json($sv);
    }
    function timsv(Request $key)
    {
        $search = $key->search;

        $posts = SinhVien::where(function ($query) use ($search) {
            $query->where('MaSV', 'like', "%$search%")
                ->orwhere('HoTenSV', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatsv(Request $request, $id)
    {
        $sv = SinhVien::where('MaSV', $id)->first();
        //return response()->json($sv);
        if (!$sv) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'HoTenSV' => 'required|string|max:255',
            'NgaySinh' => 'required|date_format:Y-m-d',
            'GioiTinh' => 'required|string|max:255',
            'SoDienThoai' => 'required|string|max:12',
            'Email' => 'required|string|max:255',
            'DiaChi' => 'required|string|max:255',
            'MaKhoa' => 'required|exists:Khoa,MaKhoa',
            'MaNganh' => 'required|exists:Nganh,MaNganh',
            'MaLNC' => 'required|exists:LopNienChe,MaLNC'
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        $namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NgaySinh'))->format('Y-m-d');

        //$sv->MaPH = $maPH;
        $sv->HoTensv = $request->input('HoTenSV');
        $sv->NamSinh = $namSinh;
        $sv->GioiTinh = $request->input("GioiTinh");
        $sv->DiaChi = $request->input("DiaChi");
        $sv->SoDienThoai = $request->input("SoDienThoai");
        $sv->Email = $request->input("Email");
        $sv->MaKhoa = $request->input("MaKhoa");
        $sv->MaNganh = $request->input("MaNganh");
        $sv->MaLNC = $request->input("MaLNC");
        $sv->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $sv], 200);
    }
}
