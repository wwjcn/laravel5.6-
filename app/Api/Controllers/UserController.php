<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\AdminUser;

class UserController extends Controller
{
    //管理员列表
    public function index()
    {
        $adminUsers = AdminUser::orderBY('created_at', 'asc')->paginate(20);
        return view('admin.user.index', compact('adminUsers'));
    }

    //创建页面
    public function create()
    {
        return view('admin.user.create');
    }

    //创建
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required | min:2',
            'password' => 'required | min:5 | max:10',
        ]);
        $name = request('name');
        $password = bcrypt(request('password'));
        $user = AdminUser::create(compact('name', 'password'));
        return redirect('/admin/users');
    }

    //用户角色页面
    public function role(\App\AdminUser $user)
    {
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;
        return view('admin.user.role', compact('roles', 'myRoles', 'user'));
    }

    //储存用户角色
    public function storeRole(\App\AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required | array',
        ]);
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;
        //要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->assignRole($role);
        }
        //要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRole($role);
        }
        return back();
    }
}
