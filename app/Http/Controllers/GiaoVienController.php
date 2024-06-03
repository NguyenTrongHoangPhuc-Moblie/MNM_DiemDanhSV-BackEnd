<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiaoVien;
use Carbon\Carbon;

class GiaoVienController extends Controller
{
    public function index()
    {
        $gv = GiaoVien::with('ChuyenMon', 'TrinhDo')->get();

        return response()->json([
            'success' => true,
            'data' => $gv
        ]);
    }
    function themGV(Request $req)
    {
        $GV = new GiaoVien;
        $GV->HoTenGV = $req->input('HoTenGV');
        $namSinh = Carbon::createFromFormat('Y-m-d', $req->input('NamSinh'))->format('Y-m-d');
        $GV->NamSinh = $namSinh;
        $GV->GioiTinh = $req->input('GioiTinh');
        $GV->DiaChi = $req->input('DiaChi');
        $GV->MaCM = $req->input('MaCM');
        $GV->MaTD = $req->input('MaTD');
        $GV->save();

        return $GV;
    }

    function danhSachGV()
    {
        return GiaoVien::all();
    }

    function xoaGV($id)
    {
        #return $id;
        $result = GiaoVien::where('MaGV', $id)->delete();
        if ($result) {
            return ["result" => "Giao vien da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function layGV($id)
    {
        #return $id;
        $GV = GiaoVien::where('MaGV', $id)->first();
        return response()->json($GV);
    }
    function timGV(Request $key)
    {
        $search = $key->search;

        $posts = GiaoVien::where(function ($query) use ($search) {
            $query->where('MaGV', 'like', "%$search%")
                ->orwhere('HoTenGV', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatGV(Request $request, $id)
    {
        $GV = GiaoVien::where('MaGV', $id)->first();
        //return response()->json($GV);
        if (!$GV) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'HoTenGV' => 'required|string|max:255',
            'NamSinh' => 'required|date_format:Y-m-d',
            'GioiTinh' => 'required|string|max:255',
            'DiaChi' => 'required|string|max:255',
            'MaCM' => 'required|exists:ChuyenMon,MaCM',
            'MaTD' => 'required|exists:TrinhDo,MaTD'
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        $namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NamSinh'))->format('Y-m-d');

        //$GV->MaPH = $maPH;
        $GV->HoTenGV = $request->input('HoTenGV');
        $GV->NamSinh = $namSinh;
        $GV->GioiTinh = $request->input("GioiTinh");
        $GV->DiaChi = $request->input("DiaChi");
        $GV->MaCM = $request->input("MaCM");
        $GV->MaTD = $request->input("MaTD");
        $GV->save();

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $GV], 200);
    }
}
