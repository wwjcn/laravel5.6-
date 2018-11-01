<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }

    //设置操作
    public function settingStore(Request $request)
    {

    }

    //个人中心
    public function show(User $user)
    {
        //个人信息，粉丝数，赞数，关注数
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);
        //个人文章列表
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        //粉丝用户
        $fans = $user->fans();
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();
        //关注用户
        $stars = $user->stars();
        $susers = User::whereIn('id', $fans->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();
        return view('user.show', compact('user', 'posts', 'fusers', 'susers'));
    }

    //关注
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return json_encode([
            'error' => 0,
            'msg' => '',
            'type' => 0
        ]);
    }

    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnFan($user->id);
        return json_encode([
            'error' => 0,
            'msg' => '',
            'type' => 1
        ]);
    }
}