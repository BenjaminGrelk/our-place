<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MainController
{
    /**
     * If the user is authenticated, redirect to the dashboard.
     * Otherwise, redirect to the registration page.
     */
    public function index()
    {
        if (auth()->check()) {
            // Call the home route
            return redirect()->route('home');
        }

        return redirect()->route('register');
    }

    // Home route, passing in auth middleware auth()->user()
    public function home()
    {
        $channels = DB::select('
            select *
            from channels
            order by created_on desc
            ');

        // Pass in the authenticated user
        return view('home', ['current_user' => auth()->user(), 'channels' => $channels]);
    }

    public function channel($channel_id)
    {
        $posts = DB::select('
            select *
            from posts
            where channel_id = ?
            order by created_on desc',
            [$channel_id]);
        $channel = DB::select('select * from channels where channel_id = ?', [$channel_id])[0];
        global $channel_id;
        $channel_id = $channel->channel_id;

        // Pass in the authenticated user
        return view('channel', [
            'current_user' => auth()->user(), 'channel_id' => $channel_id, 'channel' => $channel, 'posts' => $posts
        ]);
    }

    public function addPost()
    {
        global $channel_id;
        $channel_id = request()->input('channel_id');
        $user_id = auth()->user()->id;
        DB::insert('
            insert into posts (channel_id, author_id, title, content, reply_to, created_on)
                values (?, ?, ?, ?, ?, ?)', [
            $channel_id, $user_id, request()->input('title'), request()->input('content'),
            request()->input('reply_to'), date('Y-m-d H:i:s')
        ]);
        return redirect()->route('channel', ['channel_id' => $channel_id]);
    }
}
