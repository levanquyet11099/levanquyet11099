<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Model\User;
use Validator;


class ChangePasswordController extends Controller
{
    //
    public function __construct()
    {
        view()->share([
            'change_password' => 'active'
        ]);
    }

    public function  changePassword()
    {
        return view('backend.account.password.change');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $data['password'] = bcrypt($request->password);

        try {

            User::find(\Auth::user()->id)->update($data);
            \Auth::logout();
            return redirect()->route('login');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }
}
