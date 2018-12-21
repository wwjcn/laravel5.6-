<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view('admin.login.index');
    }

    //登陆操作
    public function login(Request $request)
    {
//        dd(444);
        if(!$request->email || !$request->password){
            $this->fail(1);
        }
        $user['email'] = $request->email;
        $user['password'] = $request->password;
//        $user['api_token'] = 456789;
        if (\Auth::attempt($user)) {
            $user = \Auth::user()->toArray();
            return $this->success($user);
        }
//        dd($token);
        return $this->fail(201);
    }

    //注销
    public function me()
    {
        if($user = \Auth::guard('api')->user()){
//            dd($user);
            return $this->success($user);
        }
    }

    //注销
    public function logout()
    {
        \Auth::logout();
        $this->success();

    }
}
