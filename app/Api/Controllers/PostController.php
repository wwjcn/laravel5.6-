<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //主页
    public function index()
    {
        $posts = Post::orderBY('created_at', 'desc')->where(['status' => 0])->paginate(20);
        return view('admin.post.index', compact('posts'));
    }

    public function status(Post $post)
    {
        $status = request('status', 1);
        $return = ['error' => 0, 'msg' => ''];
        $post->status = $status;
        if (!$post->save()) {
            $return = ['error' => 1, 'msg' => '更新失败'];
        }
        return json_encode($return);
    }
}
