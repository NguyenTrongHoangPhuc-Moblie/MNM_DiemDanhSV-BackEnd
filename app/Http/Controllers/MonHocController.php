<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;

class MonHocController extends Controller
{
    function themMH(Request $req) {
        $monhoc = new MonHoc;
        $monhoc->TenMH = $req->input('TenMH');
        $monhoc->SoTietLyThuyet = $req->input('SoTietLyThuyet');
        $monhoc->SoTietThucHanh = $req->input('SoTietThucHanh');
        $monhoc->TongSoTiet = $req->input('TongSoTiet');
        $monhoc->SoTinChi = $req->input('SoTinChi');
        $monhoc->save();

        return $monhoc;
    }

    function danhSachMH() {
        return MonHoc::all();
    }

    function xoaMH($id) {
        #return $id;
        $result = MonHoc::where('MaMH', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layMH($id) {
        #return $id;
        $monhoc = MonHoc::where('MaMH', $id)->first();
        return response()->json($monhoc);
    }
    function timMH(Request $key) {
        $search = $key->search;

        $posts = MonHoc::where(function($query) use ($search) {
            $query->where('MaMH', 'like', "%$search%")
            ->orwhere('TenMH', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatMH(Request $request, $id) {
        $monhoc = MonHoc::where('MaMH', $id)->first();
        //return response()->json($monhoc);
        if(!$monhoc) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenMH' => 'required|string|max:255',
            'SoTietLyThuyet' => 'required|int',
            'SoTietThucHanh' => 'required|int',
            'TongSoTiet' => 'required|int',
            'SoTinChi' => 'required|int',
        ]);

        $count = MonHoc::count() + 1;
        $maPH = 'PH' . str_pad($count, 3, '0', STR_PAD_LEFT);

        //$monhoc->MaPH = $maPH;
        $monhoc->TenMH = $request->input('TenMH');
        $monhoc->SoTietLyThuyet = $request->input("SoTietLyThuyet");
        $monhoc->SoTietThucHanh = $request->input("SoTietThucHanh");
        $monhoc->TongSoTiet = $request->input("TongSoTiet");
        $monhoc->SoTinChi = $request->input("SoTinChi");
        $monhoc->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $monhoc], 200);
    }
}
