<?php

namespace App\Http\Controllers;

use App\Models\NgayHoc;
use Illuminate\Http\Request;

class NgayHocController extends Controller
{
    function themNgayHoc($date) {
        $NgayHoc = new NgayHoc;
        $NgayHoc->Ngay = $date;
        //$NgayHoc->Thu = $req->input('Thu');
        
        $NgayHoc->save();

        // return $NgayHoc;

        //$NgayHoc = NgayHoc::create(['Ngay' => $date]);
        return $NgayHoc;
    }

    function danhSachNH() {
        return NgayHoc::all();
    }

    function xoaNH($id) {
        #return $id;
        $result = NgayHoc::where('MaNH', $id)->delete();
        if ($result) {
            return ["result"=>"NHong da duoc xoa" ];
        }
        else {
            return ["result"=>"Thuc thi that bai" ];
        }
    }
    function layNH($id) {
        #return $id;
        $NgayHoc = NgayHoc::where('Ngay', $id)->first();
        return response()->json($NgayHoc);
    }
    function timNH(Request $key) {
        $search = $key->search;

        $posts = NgayHoc::where(function($query) use ($search) {
            $query->where('MaNH', 'like', "%$search%")
            ->orwhere('Thu', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatNH(Request $request, $id) {
        $NgayHoc = NgayHoc::where('MaNH', $id)->first();
        //return response()->json($NgayHoc);
        if(!$NgayHoc) {
            return response()->json(['message' => 'NHong hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenNH' => 'required|string|max:255',
            'DiaChiNH' => 'required|string|max:255',
        ]);

        $count = NgayHoc::count() + 1;
        $maNH = 'NH' . str_pad($count, 3, '0', STR_PAD_LEFT);

        //$NgayHoc->MaNH = $maNH;
        $NgayHoc->TenNH = $request->input('TenNH');
        $NgayHoc->DiaChiNH = $request->input("DiaChiNH");
        $NgayHoc->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $NgayHoc], 200);
    }
}
