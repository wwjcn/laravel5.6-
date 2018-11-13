<?php

namespace App\Admin\Controllers;

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
}
