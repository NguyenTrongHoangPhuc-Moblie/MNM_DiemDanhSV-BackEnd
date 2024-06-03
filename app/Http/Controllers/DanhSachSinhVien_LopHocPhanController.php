<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhSachSinhVien_LopHocPhan;

class DanhSachSinhVien_LopHocPhanController extends Controller
{
    public function index()
    {
        $DSSV_LHP = DanhSachSinhVien_LopHocPhan::with('SinhVien', 'LopHocPhan')->get();

        return response()->json([
            'success' => true,
            'data' => $DSSV_LHP
        ]);
    }
    function themDSSV_LHP(Request $req)
    {
        $DSSV_LHP = new DanhSachSinhVien_LopHocPhan;
        $DSSV_LHP->MaLop = $req->input('MaLop');
        $DSSV_LHP->MaSV = $req->input('MaSV');
        $DSSV_LHP->SoLanCoMat = $req->input('SoLanCoMat');
        $DSSV_LHP->SoLanVang = $req->input('SoLanVang');
        $DSSV_LHP->save();

        return $DSSV_LHP;
    }

    function danhSachDSSV_LHP()
    {
        return DanhSachSinhVien_LopHocPhan::all();
    }

    function xoaDSSV_LHP($masv, $malop)
    {
        #return $id;
        $result = DanhSachSinhVien_LopHocPhan::where('MaSV', $masv)
        ->where('MaLop', $malop)
        ->delete();
        if ($result) {
            return ["result" => "Giao vien da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function layDSSV_LHP($masv, $malop)
    {
        #return $id;
        $DSSV_LHP = DanhSachSinhVien_LopHocPhan::where('MaSV', $masv)
        ->where("MaLop", $malop)
        ->first();
        return response()->json($DSSV_LHP);
    }
    function timDSSV_LHP(Request $key)
    {
        $search = $key->search;

        $posts = DanhSachSinhVien_LopHocPhan::where(function ($query) use ($search) {
            $query->where('MaSV', 'like', "%$search%")
                ->orwhere('MaLop', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatDSSV_LHP(Request $request, $masv, $malop)
    {
        $DSSV_LHP = DanhSachSinhVien_LopHocPhan::where('MaSV', $masv)
        ->where("MaLop", $malop)
        ->first();
        //return response()->json($DSSV_LHP);
        if (!$DSSV_LHP) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'MaSV' => 'required|exists:SinhVien,MaSV',
            'MaLop' => 'required|exists:LopHocPhan,MaLop',
            'SoLanVangMat' => 'required|int',
            'SoLanVang' => 'required|int'
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        //$namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NamSinh'))->format('Y-m-d');

        //$DSSV_LHP->MaPH = $maPH;
        $DSSV_LHP->MaSV = $request->input('MaSV');
        $DSSV_LHP->MaLop = $request->input("MaLop");
        $DSSV_LHP->SoLanVangMat = $request->input("SoLanVangMat");
        $DSSV_LHP->SoLanVang = $request->input("SoLanVang");
        $DSSV_LHP->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $DSSV_LHP], 200);
    }
}
