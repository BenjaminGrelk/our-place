<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class PostController
{
    public function add()
    {
        $title = request()->input('title');
        $content = request()->input('content');
        $reply_to = request()->input('reply_to');
        $channel_id = request()->input('channel_id');
        $user_id = auth()->user()->id;
        // Check if inputs are too big or are empty
        if (strlen($title) > 50 || strlen($content) > 5000 || strlen($title) == 0 || strlen($content) == 0) {
            return redirect()->route('channel', ['channel_id' => $channel_id]);
        }
        DB::insert('
            insert into posts (channel_id, author_id, title, content, reply_to, created_on)
                values (?, ?, ?, ?, ?, ?)', [
            $channel_id, $user_id, $title, $content, $reply_to, date('Y-m-d H:i:s')
        ]);
        return redirect()->route('channel', ['channel_id' => $channel_id]);
    }

    public function editing()
    {
        // Get the post to edit
        $post = DB::select('
            select *
            from posts
            where post_id = ?', [
            request()->input('post_id')
        ])[0];
        $channel_id = request()->input('channel_id');

        // Redirect to editing post page
        return view('edit_post', [
            'current_user' => auth()->user(), 'channel_id' => $channel_id, 'post' => $post
        ]);
    }

    public function edit()
    {
        // Check if user can edit the post

        $channel_id = request()->input('channel_id');
        DB::update('
            update posts
            set title = ?, content = ?
            where post_id = ?', [
            request()->input('title'), request()->input('content'), request()->input('post_id')
        ]);
        return redirect()->route('channel', ['channel_id' => $channel_id]);
    }

    public function delete()
    {
        $channel_id = request()->input('channel_id');
        // Remove all the likes for the post all the replies to each post removed
        DB::delete('
            delete from likes
            where post_id = ? or post_id in (
                select post_id
                from posts
                where reply_to = ?
            )', [
            request()->input('post_id'), request()->input('post_id')
        ]);

        // Delete post and all replies
        DB::delete('
            delete from posts
            where post_id = ? or reply_to = ?', [
            request()->input('post_id'), request()->input('post_id')
        ]);
        return redirect()->route('channel', ['channel_id' => $channel_id]);
    }
}
