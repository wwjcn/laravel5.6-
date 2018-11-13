<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view('admin.login.index');
    }

    //登陆操作
    public function login()
    {
        $this->validate(request(), [
            'name' => 'required | min:2',
            'password' => 'required | min:5 | max:10',
        ]);

        $user['name'] = request('name');
        $user['password'] = request('password');
        if (\Auth::guard('admin')->attempt($user)) {
            return redirect('/admin/home');
        }
        return \Redirect::back()->withErrors('用户名密码不匹配');
    }

    //注销
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
