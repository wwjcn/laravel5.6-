<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //首页文章列表
    public function index()
    {
        $posts = array(
            [
                'title' => 'title1111111111',
                'content' => 'content1111111111'
            ],
            [
                'title' => 'title22222222222',
                'content' => 'content2222222222'
            ],
            [
                'title' => 'title333333333',
                'content' => 'content33333333'
            ],
            [
                'title' => 'title444444444444',
                'content' => 'content444444444444'
            ],
            [
                'title' => 'title5555555555',
                'content' => 'content5555555555'
            ],
            [
                'title' => 'title666666666666',
                'content' => 'content666666666666'
            ],
            [
                'title' => 'title77777777777',
                'content' => 'content77777777777'
            ],
        );
        return view('post/index', compact('posts'));
    }

    //文章详情页
    public function show()
    {
        return view('post/show', array(
            'title' => 'wwj',
            'isShow' => false
        ));
    }

    //创建文章页面
    public function create()
    {
        return view('post/create', array());
    }

    //创建文章
    public function store()
    {
        return ;
    }

    //编辑文章页面
    public function edit()
    {
        return view('post/edit', array());
    }

    //编辑文章
    public function update()
    {
        return ;
    }

    //删除文章
    public function delete()
    {
        return ;
    }
}
