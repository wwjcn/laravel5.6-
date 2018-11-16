<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\AdminUser;

class PermissionController extends Controller
{
    //权限列表列表
    public function index()
    {
        $permissions = \App\AdminPermission::paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    //创建页面
    public function create()
    {
        return view('admin.permission.create');
    }

    //创建
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required | min:3',
            'description' => 'required',
        ]);
        \App\AdminPermission::create(request(['name', 'description']));
        return redirect('/admin/permissions');
    }
}
