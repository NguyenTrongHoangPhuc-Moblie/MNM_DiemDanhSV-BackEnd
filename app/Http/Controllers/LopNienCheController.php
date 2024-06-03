<?php

namespace App\Http\Controllers;

use App\Models\LopNienChe;
use Illuminate\Http\Request;

class LopNienCheController extends Controller
{
    public function index()
    {
        $lnc = LopNienChe::withCM('GiaoVien')->get();

        return response()->json([
            'success' => true,
            'data' => $lnc
        ]);
    }
    function themLNC(Request $req)
    {
        $lnc = new LopNienChe;
        $lnc->TenLop = $req->input('TenLNC');
        //$namSinh = Carbon::createFromFormat('Y-m-d', $req->input('NamSinh'))->format('Y-m-d');
        $lnc->SiSo = $req->input('SiSo');
        $lnc->MaGV = $req->input('MaGV');
        $lnc->save();

        return $lnc;
    }

    function danhSachLNC()
    {
        return LopNienChe::all();
    }

    function xoaLNC($id)
    {
        #return $id;
        $result = LopNienChe::where('MaLNC', $id)->delete();
        if ($result) {
            return ["result" => "Lop hoc phan da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function layLNC($id)
    {
        #return $id;
        $lnc = LopNienChe::where('MaLNC', $id)->first();
        return response()->json($lnc);
    }
    function timLNC(Request $key)
    {
        $search = $key->search;

        $posts = LopNienChe::where(function ($query) use ($search) {
            $query->where('MaLNC', 'like', "%$search%")
                ->orwhere('TenLNC', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatLNC(Request $request, $id)
    {
        $lnc = LopNienChe::where('MaLNC', $id)->first();
        //return response()->json($lnc);
        if (!$lnc) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenLNC' => 'required|string|max:255',
            'SiSo' => 'required|int',
            'MaGV' => 'required|exists:GiaoVien,MaGV',
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        //$namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NamSinh'))->format('Y-m-d');

        //$lnc->MaPH = $maPH;
        $lnc->TenLop = $request->input('TenLNC');
        $lnc->SiSo = $request->input("SiSo");
        $lnc->MaGV = $request->input("MaGV");
        $lnc->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $lnc], 200);
    }
}
