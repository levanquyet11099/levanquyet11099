<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use App\Model\User;
use App\Model\PasswordResets;
use App\Helpers\MailHelper;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*
     * hiển thị giao diện quên mật khẩu
     */
    public function forgotPassword()
    {
        return view('backend.auth.forgot-password');
    }

    /*
     * xử lý gửi mật khẩu cho người dùng
     */

    public function postPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token =  Str::random(32);
        if ($user) {
            $data = [
                'email' => $user->email,
                'token' => $token,
                'flg_update' => 0,
                'time_reset' => \Carbon\Carbon::now()->addHours(3),
                'created_at' => \Carbon\Carbon::now(),
            ];

            \DB::beginTransaction();
            try {
                MailHelper::sendMailForgotPassword($data);
                PasswordResets::insert($data);
                \DB::commit();
                return redirect()->back()->with('success','Thông tin thay đổi mật khẩu đã được gửi tới mail bạn đã đăng ký');
            } catch (\Exception $exception) {
                \DB::rollBack();
                \Log::error($exception);
                return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể thay đổi mật khẩu');
            }

        } else {
            return redirect()->back()->with('danger', 'Email không tồn tại');
        }
    }
}
