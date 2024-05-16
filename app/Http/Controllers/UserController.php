<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req) {
        $user = new User;
        $user->email = $req->input("Email");
        $user->matkhau = Hash::make($req->input("MatKhau"));
        $user->save();
        return $user;
    }
}
