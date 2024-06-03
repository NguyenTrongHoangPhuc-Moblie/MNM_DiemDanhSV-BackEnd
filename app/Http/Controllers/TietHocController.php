<?php

namespace App\Http\Controllers;

use App\Models\TietHoc;
use Illuminate\Http\Request;

class TietHocController extends Controller
{
    function themTH(Request $req) {
        $TietHoc = new TietHoc;
        $TietHoc->TenTH = $req->input('TenTH');
        $TietHoc->GioBD = $req->input('GioBD');
        $TietHoc->GioKT = $req->input('GioKT');
        $TietHoc->save();

        return $TietHoc;
    }

    function danhSachTH() {
        return TietHoc::all();
    }

    function xoaTH($id) {
        #return $id;
        $result = TietHoc::where('MaTH', $id)->delete();
        if ($result) {
            return ["result"=>"THong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layTH($id) {
        #return $id;
        $TietHoc = TietHoc::where('MaTH', $id)->first();
        return response()->json($TietHoc);
    }
    function timTH(Request $key) {
        $search = $key->search;

        $posts = TietHoc::where(function($query) use ($search) {
            $query->where('MaTH', 'like', "%$search%")
            ->orwhere('TenTH', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatTH(Request $request, $id) {
        $TietHoc = TietHoc::where('MaTH', $id)->first();
        //return response()->json($TietHoc);
        if(!$TietHoc) {
            return response()->json(['message' => 'THong hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenTH' => 'required|string|max:255',
        ]);

        $count = TietHoc::count() + 1;
        $maTH = 'TH' . str_pad($count, 3, '0', STR_PAD_LEFT);

        //$TietHoc->MaTH = $maTH;
        $TietHoc->TenTH = $request->input('TenTH');
        $TietHoc->GioBD = $request->input("GioBD");
        $TietHoc->GioKT = $request->input("GioKT");
        $TietHoc->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $TietHoc], 200);
    }

}
