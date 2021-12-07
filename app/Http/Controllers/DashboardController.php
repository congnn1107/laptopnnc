<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //
    public $destination;
    public function __construct(Request $request)
    {
        
    }
    public function login()
    {
        return view("admin.login");
    }

    public function checkLogin(Request $request)
    {
        // dd($request);
        $request->validate([
            "username" => ["required"],
            "password" => "required",
        ]);

        $credentials = [
            "username" => $request->username,
            "password" => $request->password
        ];
        $remember = isset($request->remember) ? true : false;
        
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with("message", "Tài khoản hoặc mật khẩu không chính xác!");
    }

    public function dashboard()
    {
        return view("admin.dashboard");
    }


    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $accessToken = auth("admin")->user()->setRememberToken("");

            Auth::guard('admin')->logout();
            session()->invalidate();
            session()->flush();
            session()->regenerateToken();
            return redirect(route("admin.login"));
        }
        return back();
    }
}
