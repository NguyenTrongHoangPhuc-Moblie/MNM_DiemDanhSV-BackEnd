<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNgayHoc;
use Illuminate\Http\Request;
use App\Models\NgayHoc;
use Exception;

class ChiTietNgayHocController extends Controller
{
    public function index()
    {
        $ctnh = ChiTietNgayHoc::with('NgayHoc', 'TietHoc', 'LopHocPhan')->get();

        return response()->json([
            'success' => true,
            'data' => $ctnh
        ]);
    }
    function themCTNH(Request $req)
    {
        // $ctnh = new ChiTietNgayHoc;
        // $ctnh->MaNH = $req->input('MaNH');
        // $ctnh->MaTH = $req->input('TietBatDau');
        // $ctnh->MaLop = $req->input('MaLop');
        try {
            $date = $req->input('Ngay');
            $tietBD = $req->input('TietBatDau');
            $tietKT = $req->input('TietKetThuc');
            $maLop = $req->input('MaLop');
    
            $ngayHoc = NgayHoc::where('Ngay', $date)->first();
    
            if(!$ngayHoc) {
                $nhController = new NgayHocController();
                $ngayHoc = $nhController->themNgayHoc($date);
            }
    
            // Lấy mã ngày học
            $maNH = $ngayHoc->MaNH;
    
            // Thêm giờ bắt đầu vào bảng ChiTietNgayHoc
            $chiTietNgayHocBatDau = ChiTietNgayHoc::create([
                'MaNH' => $maNH,
                'MaTH' => $tietBD,
                'MaLop' => $maLop
            ]);
    
            // Thêm giờ kết thúc vào bảng ChiTietNgayHoc
            $chiTietNgayHocKetThuc = ChiTietNgayHoc::create([
                'MaNH' => $maNH,
                'MaTH' => $tietKT,
                'MaLop' => $maLop
            ]);
    
            //$chiTietNgayHoc->save();
    
            return response()->json([
                'bat_dau' => $chiTietNgayHocBatDau,
                'ket_thuc' => $chiTietNgayHocKetThuc
            ]);
        }catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    function danhSachCTNH()
    {
        return ChiTietNgayHoc::all();
    }

    function xoaCTNH($date)
    {
        $ngayHoc = NgayHoc::where('Ngay', $date)->first();
        if(!$ngayHoc) {
            $nhController = new NgayHocController();
            $ngayHoc = $nhController->layNH($date);
        }

        // Lấy mã ngày học
        $maNH = $ngayHoc->MaNH;
        #return $id;
        $result = ChiTietNgayHoc::where('MaNH', $maNH)->delete();
        if ($result) {
            return ["result" => "Lop hoc phan da duoc xoa"];
        } else {
            return ["result" => "Thuc thi that bai"];
        }
    }
    function layCTNH($date)
    {
        $ngayHoc = NgayHoc::where('Ngay', $date)->first();
        if(!$ngayHoc) {
            $nhController = new NgayHocController();
            $ngayHoc = $nhController->layNH($date);
        }

        // Lấy mã ngày học
        $maNH = $ngayHoc->MaNH;
        #return $id;
        $ctnh = ChiTietNgayHoc::where('MaNH', $maNH)->first();
        return response()->json($ctnh);
    }
    function timCTNH(Request $key)
    {
        $search = $key->search;

        $posts = ChiTietNgayHoc::where(function ($query) use ($search) {
            $query->where('MaNH', 'like', "%$search%")
                ->orwhere('MaTH', 'like', "%$search%")
                ->orwhere('MaLop', 'like', "%$search%");
        })->get();
        return response()->json($posts);
    }
    function capNhatCTNH(Request $request, $date)
    {
        $ngayHoc = NgayHoc::where('Ngay', $date)->first();
        if(!$ngayHoc) {
            $nhController = new NgayHocController();
            $ngayHoc = $nhController->layNH($date);
        }

        // Lấy mã ngày học
        $maNH = $ngayHoc->MaNH;

        $ctnh = ChiTietNgayHoc::where('MaNH', $maNH)->delete();
        //return response()->json($ctnh);
        if (!$ctnh) {
            return response()->json(['message' => 'Mon hoc khong ton tai'], 404);
        }

        $request->validate([
            'MaNH' => 'required|exists:NgayHoc,MaNH',
            'MaTH' => 'required|exists:TietHoc,MaTH',
            'MaLop' => 'required|exists:LopHocPhan,MaLop'
        ]);
        // Chuyển đổi định dạng ngày tháng năm nếu cần thiết
        //$namSinh = Carbon::createFromFormat('Y-m-d', $request->input('NamSinh'))->format('Y-m-d');

        //$ctnh->MaPH = $maPH;
        // $ctnh->MaNH = $request->input("MaNH");
        // $ctnh->MaTH = $request->input("MaTH");
        // $ctnh->MaLop = $request->input("MaLop");
        // $ctnh->save();

        // Thêm giờ bắt đầu vào bảng ChiTietNgayHoc
        $chiTietNgayHocBatDau = ChiTietNgayHoc::create([
            'MaNH' => $maNH,
            'MaTH' => $request->input("TietHocBatDau"),
            'MaLop' => $request->input("MaLop")
        ]);

        // Thêm giờ kết thúc vào bảng ChiTietNgayHoc
        $chiTietNgayHocKetThuc = ChiTietNgayHoc::create([
            'MaNH' => $maNH,
            'MaTH' => $request->input("TietHocKetThuc"),
            'MaLop' => $request->input("MaLop")
        ]);

        return response()->json(['message' => 'Cập nhật thành công', 'data' => $ctnh], 200);
    }
}
