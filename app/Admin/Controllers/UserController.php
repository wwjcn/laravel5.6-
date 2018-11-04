<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //主页
    public function index()
    {
        return view('admin.user.index');
    }
}
