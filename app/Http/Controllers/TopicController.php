<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        $topic = Topic::withCount('postTopics')->find($topic->id);
        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();
        //我的文章，未投稿
        $myPosts = Post::AuthorBy(\Auth::id())->TopicNotBy($topic->id)->get();
        return view('topic.show', compact('topic', 'posts', 'myPosts'));
    }

    public function submit(Topic $topic)
    {
        $this->validate(request(), [
            'post_ids' => 'required | array',
        ]);

        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
            \App\PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }
    }
}
