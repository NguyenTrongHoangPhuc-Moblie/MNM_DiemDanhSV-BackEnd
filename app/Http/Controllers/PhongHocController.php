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
    function timPH(Request $key) {
        $search = $key->search;

        $posts = PhongHoc::where(function($query) use ($search) {
            $query->where('MaPH', 'like', "%$search%")
            ->orwhere('TenPH', 'like', "%$search%")
            ->orwhere('DiaChiPH', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatPH(Request $request, $id) {
        $phonghoc = PhongHoc::where('MaPH', $id)->first();
        //return response()->json($phonghoc);
        if(!$phonghoc) {
            return response()->json(['message' => 'Phong hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenPH' => 'required|string|max:255',
            'DiaChiPH' => 'required|string|max:255',
        ]);

        $count = PhongHoc::count() + 1;
        $maPH = 'PH' . str_pad($count, 3, '0', STR_PAD_LEFT);

        //$phonghoc->MaPH = $maPH;
        $phonghoc->TenPH = $request->input('TenPH');
        $phonghoc->DiaChiPH = $request->input("DiaChiPH");
        $phonghoc->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $phonghoc], 200);
    }
}
