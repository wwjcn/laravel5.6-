<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view('login.index');
    }

    //登陆操作
    public function login()
    {
        $this->validate(request(), [
            'email' => 'required | email ',
            'password' => 'required | min:6 | max:10',
            'is_remember' => 'integer',
        ]);

        $user['email'] = request('email');
        $user['password'] = request('password');
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($user, $is_remember)) {
            return redirect('/posts');
        }
        return \Redirect::back()->withErrors('密码或邮箱不正确');
    }

    //注销
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
