<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class NguoiDungController extends Controller
{
    function index() {
        // $users = NguoiDung::all();
        // return response()->json([
        //     'results' => $users
        // ], 100);
        return NguoiDung::all();
    }
    //
    function register(Request $req) {
        $user = new NguoiDung();
        $user->Email = $req->input("Email");
        $user->MatKhau = Hash::make($req->input("MatKhau"));
        $user->save();
        return $user;
    }
    function login(Request $req) {
        $user = NguoiDung::where("Email", $req->Email)->first();
        if(!$user || !$user->MatKhau === md5($req->MatKhau)) {
            return ["error"=>"Email or MatKhau is not matched"];
        }
        return $user;
    }

    function kiemTraPQ($email) {
        $events = DB::table('NguoiDung AS nd')
        ->select(
            'pq.TenNhomQuyen'
        )
        ->join('NguoiDung_PhanQuyen AS ndpq', 'ndpq.MaND', '=', 'nd.MaND')
        ->join('PhanQuyen AS pq', 'pq.MaPQ', '=', 'ndpq.MaPQ')
        ->where("nd.Email", $email)
        ->first();

        return response()->json([
            $events
        ]);
    }
}
