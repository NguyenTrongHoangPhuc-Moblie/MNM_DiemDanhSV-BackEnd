<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;

class KhoaController extends Controller
{
    function themKhoa(Request $req) {
        $Khoa = new Khoa;
        $Khoa->TenKhoa = $req->input('TenKhoa');
        $Khoa->SoLuongSV = 0;
        $Khoa->save();

        return $Khoa;
    }

    function danhSachKhoa() {
        return Khoa::all();
    }

    function xoaKhoa($id) {
        #return $id;
        $result = Khoa::where('MaKhoa', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layKhoa($id) {
        #return $id;
        $Khoa = Khoa::where('MaKhoa', $id)->first();
        return response()->json($Khoa);
    }
    function timKhoa(Request $key) {
        $search = $key->search;

        $posts = Khoa::where(function($query) use ($search) {
            $query->where('MaKhoa', 'like', "%$search%")
            ->orwhere('TenKhoa', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatKhoa(Request $request, $id) {
        $Khoa = Khoa::where('MaKhoa', $id)->first();
        //return response()->json($Khoa);
        if(!$Khoa) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenKhoa' => 'required|string|max:255',
            'SoLuongSV' => 'required|int',
        ]);

        //$Khoa->MaPH = $maPH;
        $Khoa->TenKhoa = $request->input('TenKhoa');
        $Khoa->SoLuongSV = $request->input("SoLuongSV");
        $Khoa->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $Khoa], 200);
    }
}
