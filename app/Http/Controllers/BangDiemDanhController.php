<?php

namespace App\Http\Controllers;

use App\Models\BangDiemDanh;
use App\Models\DanhSachSinhVien_LopHocPhan;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BangDiemDanhController extends Controller
{
    function themBDD(Request $req)
    {

        $diemdanhData = $req->all();

        //dd($diemdanhData);
        foreach ($diemdanhData as $data) {
            if (is_array($data) && isset($data['MaSV'])) {
                BangDiemDanh::create([
                    'MaSV' => $data['MaSV'],
                    'MaLop' => $data['MaLop'],
                    'TrangThaiDiemDanh' => $data['TrangThaiDiemDanh'],
                    'NgayDiemDanh' => $data['NgayDiemDanh'],
                    'GhiChu' => $data['GhiChu']
                ]);
                // $BangDiemDanh = new BangDiemDanh;
                // $BangDiemDanh->MaSV = $data['MaSV'];
                // $BangDiemDanh->MaLop = $data['MaLop'];
                // $BangDiemDanh->TrangThaiDiemDanh = $data['TrangThaiDiemDanh'];
                // $BangDiemDanh->NgayDiemDanh = $data['NgayDiemDanh'];
                // $BangDiemDanh->GhiChu = $req->input[]'GhiChu'];
                // $BangDiemDanh->save();
            }
        }

        // $BangDiemDanh = new BangDiemDanh;
        // $BangDiemDanh->MaSV = $req->input('MaSV');
        // $BangDiemDanh->MaLop = $req->input('MaLop');
        // $BangDiemDanh->TrangThaiDiemDanh = $req->input('TrangThaiDiemDanh');
        // $BangDiemDanh->NgayDiemDanh = $req->input('NgayDiemDanh');
        // $BangDiemDanh->GhiChu = $req->input('GhiChu');
        // $BangDiemDanh->save();

        return response()->json(['message' => 'Diem danh da duoc luu'], 200);
    }

    public function danhSachBDD($tenlop)
    {

        $lhp = LopHocPhan::where('TenLop', $tenlop)->first();
        if (!$lhp) {
            $lhpController = new LopHocPhanController();
            $lhp = $lhpController->layLHP($tenlop);
        }

        // Lấy mã ngày học
        $maLop = $lhp->MaLop;
        $dssv = DanhSachSinhVien_LopHocPhan::where("MaLop", $maLop)->get();

        return response()->json($dssv);
    }
}
