<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TestController extends Controller
{
    //测试
    public function test()
    {
        $topics = Topic::orderBY('created_at', 'asc')->paginate(20);
        return $this->success($topics);
    }
}
