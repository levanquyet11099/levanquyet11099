<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateInforProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use Validator;


class AdminUserController extends Controller
{
    public function __construct()
    {
        view()->share([
            'admin_menu' => 'active'
        ]);
    }
    public function index(Request $request)
    {
        $users = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            },
        ]);

        if($request->account) {
            $users = $users->where('account', $request->account);
        }

        if($request->email) {
            $users = $users->where('email', $request->email);
        }

        if($request->phone) {
            $users = $users->where('phone', $request->phone);
        }

        $users = $users->orderBy('id', 'DESC')->paginate(20);

        return view('backend.account.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.account.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'role', 'password');
        $data['password'] = bcrypt($request->password);
        $data['remember_token'] = $request->_token;

        try {
            $id =  User::insertGetId($data);
            \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $id]);
            return redirect()->route('get.list.user')->with('success','Thêm mới thành công');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }


    }

    public function edit($id)
    {
        // Lấy ra thông tin người dùng
        $user = User::find($id);
        $listRoleUser = \DB::table('role_user')->where('user_id', $id)->first();
        $roles = Role::all();

        if(!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Thông tin người dùng không tồn tại');
        }

        $viewData = [
            'user' => $user,
            'listRoleUser' => $listRoleUser,
            'roles' => $roles,
        ];
        return view('backend.account.user.update', $viewData);
    }

    public function update(UserUpdateInforProfileRequest $request, $id)
    {

        $data = $request->except('_token');

        try {
            User::find($id)->update($data);

            if($request->role) {
                \DB::table('role_user')->where('user_id', $id)->delete();
            }

            \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $id]);

            return redirect()->route('get.list.user')->with('success','Cập nhật thành công');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }

    public function delete($id)
    {
        if($id != 1) {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success','Xoá thành công');
        } else {
            return redirect()->back()->with('danger','Tài khoản quản trị không thể xóa');
        }

    }

    public function account()
    {
        $user = User::find(\Auth::user()->id);
        return view('backend.account.user.account', compact('user'));
    }

    public function updateAccount(UserUpdateInforProfileRequest $request, $id)
    {
        $data = $request->except('_token');
        try {

            User::find($id)->update($data);
            return redirect()->route('get.list.user')->with('success','Cập nhật thành công');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }
}
