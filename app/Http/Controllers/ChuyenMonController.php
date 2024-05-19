<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuyenMon;

class ChuyenMonController extends Controller
{
    function themTD(Request $req) {
        $ChuyenMon = new ChuyenMon;
        $ChuyenMon->TenTD = $req->input('TenCM');
        $ChuyenMon->save();

        return $ChuyenMon;
    }

    function danhSachTD() {
        return ChuyenMon::all();
    }

    function xoaTD($id) {
        #return $id;
        $result = ChuyenMon::where('MaCM', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layTD($id) {
        #return $id;
        $ChuyenMon = ChuyenMon::where('MaCM', $id)->first();
        return response()->json($ChuyenMon);
    }
    function timTD(Request $key) {
        $search = $key->search;

        $posts = ChuyenMon::where(function($query) use ($search) {
            $query->where('MaCM', 'like', "%$search%")
            ->orwhere('TenCM', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatTD(Request $request, $id) {
        $ChuyenMon = ChuyenMon::where('MaCM', $id)->first();
        //return response()->json($ChuyenMon);
        if(!$ChuyenMon) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenCM' => 'required|string|max:255',
        ]);

        //$ChuyenMon->MaPH = $maPH;
        $ChuyenMon->TenCM = $request->input('TenCM');
        $ChuyenMon->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $ChuyenMon], 200);
    }
}
