<?php

namespace App\Http\Controllers;

use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class LopHocPhanController extends Controller
{
    public function index()
    {
        $lhp = LopHocPhan::withCM('MonHoc', 'GiaoVien', 'PhongHoc')->get();

        return response()->json([
            'success' => true,
            'data' => $lhp
        ]);
    }
    function themLHP(Request $req)
    {
        $lhp = new LopHocPhan;
        $lhp->TenLop = $req->input('TenLop');
        //$namSinh = Carbon::createFromFormat('Y-m-d', $req->input('NamSinh'))->format('Y-m-d');
        $lhp->SiSo = $req->input('SiSo');
        $lhp->MaGV = $req->input('MaGV');
        $lhp->MaMH = $req->input('MaMH');
        $lhp->MaPH = $req->input('MaPH');
        $lhp->save();

        return $lhp;
    }

    function danhSachLHP()
    {
        return LopHocPhan::all();
    }

    function xoaLHP($id)
    {
        #return $id;
        $result = LopHocPhan::where('MaLop', $id)->delete();
        if ($result) {
            return ["result" => "Lop hoc phan da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function layLHP($id)
    {
        #return $id;
        $lhp = LopHocPhan::where('TenLop', $id)->first();
        return response()->json($lhp);
    }
    function timLHP(Request $key)
    {
        $search = $key->search;

        $posts = LopHocPhan::where(function ($query) use ($search) {
            $query->where('MaLop', 'like', "%$search%")
                ->orwhere('TenLop', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatLHP(Request $request, $id)
    {
        $lhp = LopHocPhan::where('MaLop', $id)->first();
        //return response()->json($lhp);
        if (!$lhp) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'TenLop' => 'required|string|max:255',
            'SiSo' => 'required|int',
            'MaGV' => 'required|exists:GiaoVien,MaGV',
            'MaMH' => 'required|exists:MonHoc,MaMH',
            'MaPH' => 'required|exists:PhongHoc,MaPH'
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        //$namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NamSinh'))->format('Y-m-d');

        //$lhp->MaPH = $maPH;
        $lhp->TenLop = $request->input('TenLop');
        $lhp->MaGV = $request->input("MaGV");
        $lhp->MaMH = $request->input("MaMH");
        $lhp->MaPH = $request->input("MaPH");
        $lhp->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $lhp], 200);
    }
}
