<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhongHoc;

class PhongHocController extends Controller
{
    //
    function themPhongHoc(Request $req) {
        $phonghoc = new PhongHoc;
        $phonghoc->TenPH = $req->input('TenPH');
        $phonghoc->DiaChiPH = $req->input('DiaChiPH');
        $phonghoc->save();

        return $phonghoc;
    }

    function danhSachPH() {
        return PhongHoc::all();
    }

    function xoaPH($id) {
        #return $id;
        $result = PhongHoc::where('MaPH', $id)->delete();
        if ($result) {
            return ["result"=>"Phong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layPH($id) {
        #return $id;
        $phonghoc = PhongHoc::where('MaPH', $id)->first();
        return response()->json($phonghoc);
    }
    function timPH($key) {
        return PhongHoc::where('TenPH', 'Like', "%$key%")->get();
    }
}
