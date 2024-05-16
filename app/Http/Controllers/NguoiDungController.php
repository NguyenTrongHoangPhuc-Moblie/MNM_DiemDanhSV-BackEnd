<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    //
    function register(Request $req) {
        $user = new NguoiDung();
        $user->Email = $req->input("Email");
        $user->MatKhau = Hash::make($req->input("MatKhau"));
        $user->save();
        return $user;
    }
}
