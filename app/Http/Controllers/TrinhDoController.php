<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrinhDo;

class TrinhDoController extends Controller
{
    function themTD(Request $req) {
        $TrinhDo = new TrinhDo;
        $TrinhDo->TenTD = $req->input('TenTD');
        $TrinhDo->save();

        return $TrinhDo;
    }

    function danhSachTD() {
        return TrinhDo::all();
    }

    function xoaTD($id) {
        #return $id;
        $result = TrinhDo::where('MaTD', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layTD($id) {
        #return $id;
        $TrinhDo = TrinhDo::where('MaTD', $id)->first();
        return response()->json($TrinhDo);
    }
    function timTD(Request $key) {
        $search = $key->search;

        $posts = TrinhDo::where(function($query) use ($search) {
            $query->where('MaTD', 'like', "%$search%")
            ->orwhere('TenTD', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatTD(Request $request, $id) {
        $TrinhDo = TrinhDo::where('MaTD', $id)->first();
        //return response()->json($TrinhDo);
        if(!$TrinhDo) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenTD' => 'required|string|max:255',
        ]);

        //$TrinhDo->MaPH = $maPH;
        $TrinhDo->TenTD = $request->input('TenTD');
        $TrinhDo->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $TrinhDo], 200);
    }
}
