<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //主页
    public function index()
    {
        return view('admin.home.index');
    }
}
