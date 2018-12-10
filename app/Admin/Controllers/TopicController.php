<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    //列表
    public function index()
    {
        $topics = Topic::orderBY('created_at', 'asc')->paginate(20);
        return view('admin.topic.index', compact('topics'));
    }

    //创建页面
    public function create()
    {
        return view('admin.topic.create');
    }

    //创建
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required | min:2',
        ]);
        $name = request('name');
        $topic = Topic::create(compact('name'));
        return redirect('/admin/topics');
    }

    //删除
    public function destroy(\App\Topic $topic)
    {
        $topic->delete();
        return ['error' => 0, 'msg' => '666'];
    }
}
