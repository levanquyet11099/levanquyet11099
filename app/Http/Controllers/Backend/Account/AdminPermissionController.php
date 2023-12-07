<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Model\Permission;
use App\Model\GroupPermission;

class AdminPermissionController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::with([
            'groups' => function($groups)
            {
                $groups->select('id', 'name');
            }
        ])->orderBy('id', 'DESC')->paginate(20);

        return view('backend.account.permission.index', compact('permissions'));
    }

    //
    public function create()
    {
        $permissionGroups = GroupPermission::all();

        return view('backend.account.permission.create', compact('permissionGroups'));
    }

    //
    public function store(PermissionRequest $request)
    {
        $this->createOrUpdate($request);

        return redirect()->back()->with('success','Thêm mới thành công');
    }

    //
    public function edit($id)
    {
        $permissionGroups = GroupPermission::all();
        $permission = Permission::findOrFail($id);

        return view('backend.account.permission.update',compact('permission', 'permissionGroups'));
    }
    //

    public function update(PermissionRequest $request,$id)
    {
        $this->createOrUpdate($request,$id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    //
    public function delete($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->back()->with('success','Xoá thành công');
    }

    //
    public function createOrUpdate($request , $id ='')
    {
        $permission = new Permission();

        if ($id)
        {
            $permission = Permission::findOrFail($id);
        }

        $permission->name                       = safeTitle($request->name);
        $permission->display_name               = $request->name;
        $permission->group_permission_id        = $request->group_permission_id;
        $permission->description                = $request->description;

        $permission->save();
    }
}
