<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\User;

class PostController extends Controller
{
    //首页文章列表
    public function index(\Psr\Log\LoggerInterface $log)
    {
        //从容器中拿
        /*$app = app();
        $log = $app->make('log');*/
        //也可以使用依赖注入，传入类对象
        //$log->info('222222222', ['data' => 444444]);
        //也可以使用门脸模式
        //\log::info('33333333', ['data' => 555555]);
        $posts = Post::orderBY('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    //文章详情页
    public function show(Post $post)
    {
        $userId = \Auth::id();
        $user = User::find($userId);
        return view('post/show', compact('post', 'user'));
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
        $userId = \Auth::id();
        $params = array_merge(request(['title', 'content']), ['user_id' =>$userId]);
        $return = Post::create($params);
        return redirect('/posts');
    }

    //编辑文章页面
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    //编辑文章
    public function update(Post $post)
    {
        //用户权限认证
        $this->authorize('update', $post);
        $this->validate(request(), [
            'title' => 'required | string | max:100 | min:5',
            'content' => 'required | string | min:10',
        ]);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect('/posts/' . $post->id);
    }

    //删除文章
    public function delete(Post $post)
    {
        //用户权限认证
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/posts');
    }

    //图片上传
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }
}
