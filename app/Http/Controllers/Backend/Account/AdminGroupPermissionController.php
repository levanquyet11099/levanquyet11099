<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\GroupPermission;
use App\Http\Requests\GroupPermissionRequest;

class AdminGroupPermissionController extends Controller
{
    public function index()
    {
        $permissionGroups = GroupPermission::orderBy('id', 'DESC')->paginate(20);

        $viewData = [
            'permissionGroups' => $permissionGroups
        ];

        return view('backend.account.group-permission.index',$viewData);
    }

    public function create()
    {
        return view('backend.account.group-permission.create');
    }

    public function store(GroupPermissionRequest $request)
    {
        $this->createOrUpdate($request);
        
        return redirect()->back()->with('success','Thêm mới thành công');
    }

    public function edit($id)
    {
        $permissionGroup = GroupPermission::findOrFail($id);

        return view('backend.account.group-permission.update',compact('permissionGroup'));
    }

    public function update(GroupPermissionRequest $request,$id)
    {
        $this->createOrUpdate($request,$id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    public function delete($id)
    {
        GroupPermission::findOrFail($id)->delete();
        return redirect()->back()->with('success','Xoá thành công');
    }

    public function createOrUpdate($request , $id ='')
    {
        $groupPermission = new GroupPermission();

        if ($id)
        {
            $groupPermission = GroupPermission::findOrFail($id);
        }

        $groupPermission->name        = $request->name;
        $groupPermission->description = $request->description;

        $groupPermission->save();
    }

}
