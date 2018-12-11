<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMessage;
use App\Notice;

class NoticeController extends Controller
{
    //列表
    public function index()
    {
        $notices = Notice::orderBY('created_at', 'asc')->paginate(20);
        return view('admin.notice.index', compact('notices'));
    }

    //创建页面
    public function create()
    {
        return view('admin.notice.create');
    }

    //创建
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required | min:2',
            'content' => 'required | min:10',
        ]);
        $notice = Notice::create(request(['title', 'content']));
        $this->dispatch(new \App\Jobs\SendMessage($notice));
        /*$users = \App\User::all();
        foreach($users as $user) {
            $user->addNotice($notice);
        }*/
        return redirect('/admin/notices');
    }

}
