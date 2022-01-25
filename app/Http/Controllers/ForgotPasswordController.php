<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|exists:user',
        ], [
            'email.required' => 'Email không được bỏ trống!',
            'email.exists' => 'Không tìm thấy người dùng có email này!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'forget')->withInput();
        }


        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $data = [
            'email' => $request->email,
            'token' => $token
        ];

        Mail::to($request->email)->send(new ResetPassword($data));

        return back()->with('email-sent', 'Chúng tôi đã gửi link đặt lại mật khẩu, vui lòng kiểm tra email của bạn!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($email,$token)
    {
        return view('shop.resetpassword', ['email' => $email,'token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'confirm' => 'required|same:password'
        ], [
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải gồm 6 ký tự!',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Thông tin không hợp lệ!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return back()->with('success', 'Đã thay đổi mật khẩu thành công, bạn có thể đăng nhập bằng mật khẩu mới!');
    }
}
