<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\GroupPermission;
use Carbon\Carbon;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        view()->share([
            'role_menu' => 'active'
        ]);
    }

    public function index()
    {
        $roles = Role::select('*')->with('permissionRole')->orderBy('id', 'DESC')->paginate(20);

        return view('backend.account.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();

        return view('backend.account.role.create', compact('permissionGroups'));
    }

    public function store(RolesRequest $request)
    {
        $dataRoles['name'] = safeTitle($request->name);
        $dataRoles['display_name'] = $request->name;
        $dataRoles['created_at'] = Carbon::now();
        $dataRoles['updated_at'] = Carbon::now();

        try {
            $id =  Role::insertGetId($dataRoles);

            if($id) {
                if(!empty($request->permissions)) {
                    foreach($request->permissions as $permission) {
                        \DB::table('permission_role')->insert(['permission_id'=> $permission, 'role_id'=> $id]);
                    }
                }
            }
            return redirect()->route('get.list.role')->with('success','Thêm mới thành công');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $listPermission = \DB::table('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();

        if(!$role) {
            return redirect()->route('get.list.role')->with('danger', 'Quyền không tồn tại');
        }
        $viewData = [
            'listPermission' => $listPermission,
            'permissionGroups' => $permissionGroups,
            'role' =>$role,
        ];

        return view('backend.account.role.update', $viewData);
    }

    public function update(RolesRequest $request, $id)
    {
        $dataRoles['name'] = safeTitle($request->name);
        $dataRoles['display_name'] = $request->name;
        $dataRoles['updated_at'] = Carbon::now();

        try {
            Role::findOrFail($id)->update($dataRoles);
            if($id) {
                \DB::table('permission_role')->where('role_id', $id)->delete();
                if(!empty($request->permissions)) {
                    foreach($request->permissions as $permission) {
                        \DB::table('permission_role')->insert(['permission_id'=> $permission, 'role_id'=> $id]);
                    }
                }
            }
            return redirect()->route('get.list.role')->with('success','Cập nhật thành công');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->back()->with('success','Xoá thành công');
    }
}
