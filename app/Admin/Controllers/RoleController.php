<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\AdminUser;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        $roles = \App\AdminRole::paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    //创建页面
    public function create()
    {
        return view('admin.role.create');
    }

    //创建
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required | min:3',
            'description' => 'required',
        ]);
        \App\AdminRole::create(request(['name', 'description']));
        return redirect('/admin/roles');
    }

    //角色权限页面
    public function permission(\App\AdminRole $role)
    {
        $permissions = \App\AdminPermission::paginate(10);
        $rolePermission = $role->permissions;
        return view('admin.role.permission', compact('permissions', 'rolePermission', 'role'));
    }

    //储存
    public function storePermission(\App\AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required | array',
        ]);
        $permissions = \App\AdminPermission::findMany(request('permissions'));
        $rolesPermissions = $role->permissions;
        //要增加的
        $addPermissions = $permissions->diff($rolesPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }
        //要删除的
        $deletePermissions = $rolesPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return back();
    }
}
