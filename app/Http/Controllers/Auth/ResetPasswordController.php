<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\PasswordResets;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use App\Model\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
    public function resetPassword(Request $request)
    {
        $data = PasswordResets::where('token', $request->token)->first();

        if (!$data) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        $dateNow = \Carbon\Carbon::now();
        $dateReset = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data->time_reset);
        $minutes = $dateReset->diffInMinutes($dateNow);
        if ($minutes <= 0 || $data->flg_update == 1) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        return view('backend.auth.reset-password', compact('data'));
    }

    public function postResetPassword(ResetPasswordRequest $request, $token)
    {
        $data['password'] = bcrypt($request->password);

        $dataPass = PasswordResets::where('token', $token)->first();

        if (!$dataPass) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        try {
            User::where('email', $dataPass->email)->update($data);
            return redirect()->route('login');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }
}
