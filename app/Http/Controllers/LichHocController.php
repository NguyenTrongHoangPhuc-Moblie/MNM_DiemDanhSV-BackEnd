<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LichHoc;

class LichHocController extends Controller
{
    function themTGH(Request $req) {
        $TGH = new LichHoc;
        $TGH->SoLuongNgayHoc = $req->input('SoLuongNgayHoc');
        $TGH->NgayBD = $req->input('NgayBD');
        $TGH->NgayKT = $req->input('NgayKT');
        $TGH->save();

        return $TGH;
    }

    function danhSachTGH() {
        return LichHoc::all();
    }

    function xoaTGH($id) {
        #return $id;
        $result = LichHoc::where('MaTGH', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layTGH($id) {
        #return $id;
        $TGH = LichHoc::where('MaTGH', $id)->first();
        return response()->json($TGH);
    }
    function timTGH(Request $key) {
        $search = $key->search;

        $posts = LichHoc::where(function($query) use ($search) {
            $query->where('MaTGH', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatTGH(Request $request, $id) {
        $TGH = LichHoc::where('MaTGH', $id)->first();
        //return response()->json($TGH);
        if(!$TGH) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'SoLuongNgayHoc' => 'required|int',
            'NgayBD' => 'required|date',
            'NgayKT' => 'required|date',
        ]);

        //$TGH->MaPH = $maPH;
        $TGH->SoLuongNgayHoc = $request->input('SoLuongNgayHoc');
        $TGH->NgayBD = $request->input("NgayBD");
        $TGH->NgayKT = $request->input("NgayKT");
        $TGH->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $TGH], 200);
    }
}
