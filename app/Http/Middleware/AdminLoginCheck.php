<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request->path());
        if(!Auth::guard('admin')->user() && $request->path()=="admin/login"){
            return $next($request);
        }
        
        if(Auth::guard('admin')->user() && $request->path()!="admin/login" && $request->path()!="admin/logout"){

                return $next($request)->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
        }
        if(Auth::guard('admin')->user() && $request->path()=="admin/login"){
            return back();
        }

        return redirect(route("admin.login"))->with("message","Bạn phải đăng nhập!");
    }
}
