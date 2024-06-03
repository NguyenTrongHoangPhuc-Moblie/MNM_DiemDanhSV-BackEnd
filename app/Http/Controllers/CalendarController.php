<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNgayHoc;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function danhSachCalendar() {
        $events = DB::table('NgayHoc AS nh')
        ->select(
            'lhp.TenLop as title',
            DB::raw('CONCAT(nh.Ngay, " ", MIN(th.GioBD)) AS start'),
            DB::raw('CONCAT(nh.Ngay, " ", MAX(th.GioKT)) AS end')
        )
        ->join('ChiTietNgayHoc AS ctnh', 'nh.MaNH', '=', 'ctnh.MaNH')
        ->join('TietHoc AS th', 'ctnh.MaTH', '=', 'th.MaTH')
        ->join('LopHocPhan AS lhp', 'ctnh.MaLop', '=', 'lhp.MaLop')
        ->groupBy('lhp.TenLop', 'nh.Ngay')
        ->get();

        return response()->json($events);
    }
    //
    // public function danhSachCalendar() {
    //     //$events = array();
    //     $events = [];
    //     $ctnhs = ChiTietNgayHoc::with(['NgayHoc', 'TietHoc', 'LopHocPhan'])->get();
    //     foreach($ctnhs as $ctnh) {
    //         // $start = $ctnh->NgayHoc->Ngay + '' + $ctnh->TietHoc->GioBD;
    //         // echo $start;
    //         $events[] = [
    //             'title' => $ctnh->LopHocPhan->TenLop,
    //             'start' => $ctnh->NgayHoc->Ngay . ' ' . $ctnh->TietHoc->GioBD,
    //             'end' => $ctnh->NgayHoc->Ngay . ' ' . $ctnh->TietHoc->GioKT
    //         ];
    //     }
    //     return response()->json($events);

        
    //     //return $events;
    //     //return ChiTietNgayHoc::all();
    // }

    // function danhSachLH() {
    //     return ChuyenMon::all();
    // }
}
