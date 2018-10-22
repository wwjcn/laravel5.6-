<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    //首页文章列表
    public function index()
    {
        $posts = Post::orderBY('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    //文章详情页
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    //创建文章页面
    public function create()
    {
        return view('post/create', array());
    }

    //创建文章
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required | string | max:100 | min:5',
            'content' => 'required | string | min:10',
        ]);
        $return = Post::create(request(['title', 'content']));
        return redirect('/posts');
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

    //图片上传
    public function imageUpload()
    {
        dd(request()->all());
    }
}
