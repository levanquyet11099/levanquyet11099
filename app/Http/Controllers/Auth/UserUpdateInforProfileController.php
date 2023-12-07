<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Http\Requests\UserUpdateInforProfileRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateInforProfileController extends Controller
{
    //
    public function userUpdateInfo()
    {
        if(!session()->has('id')) {
            return redirect()->route('login');
        }

        return view('backend.auth.update-info-profile');
    }

    public function updateInfoUser(UserUpdateInforProfileRequest $request)
    {
        $infoUser = $request->except('_token');
        $infoUser['first_login'] = User::FLAG_LOGIN;

        $id = session('id');
        $user = session('user');

        try {
            User::find($id)->update($infoUser);
            if ($id)
            {
                if (Auth::attempt($user)) {
                    session()->forget(['id', 'user']);
                    return redirect()->route('admin.dashboard');
                }
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }

    }
}
