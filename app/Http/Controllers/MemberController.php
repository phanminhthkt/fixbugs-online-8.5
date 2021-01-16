<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;//user model can kiem tra
use Auth; //use thư viện auth


class MemberController extends Controller
{
    public function getLogin()
    {
        return view('member.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::guard('members')->attempt($arr)) {
            dd('đăng nhập thành công');
        } else {
            dd('tài khoản và mật khẩu chưa chính xác');
        }
    }
}
