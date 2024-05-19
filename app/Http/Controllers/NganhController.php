<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nganh;

class NganhController extends Controller
{
    function themNganh(Request $req) {
        $Nganh = new Nganh;
        $Nganh->TenNganh = $req->input('TenNganh');
        $Nganh->SoLuongSV = 0;
        $Nganh->save();

        return $Nganh;
    }

    function danhSachNganh() {
        return Nganh::all();
    }

    function xoaNganh($id) {
        #return $id;
        $result = Nganh::where('MaNganh', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layNganh($id) {
        #return $id;
        $Nganh = Nganh::where('MaNganh', $id)->first();
        return response()->json($Nganh);
    }
    function timNganh(Request $key) {
        $search = $key->search;

        $posts = Nganh::where(function($query) use ($search) {
            $query->where('MaNganh', 'like', "%$search%")
            ->orwhere('TenNganh', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatNganh(Request $request, $id) {
        $Nganh = Nganh::where('MaNganh', $id)->first();
        //return response()->json($Nganh);
        if(!$Nganh) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenNganh' => 'required|string|max:255',
            'SoLuongSV' => 'required|int',
        ]);

        //$Nganh->MaPH = $maPH;
        $Nganh->TenNganh = $request->input('TenNganh');
        $Nganh->SoLuongSV = $request->input("SoLuongSV");
        $Nganh->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $Nganh], 200);
    }
}
