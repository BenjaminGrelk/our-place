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
        // Get all channels ordered by number of posts
        $channels = DB::select('
            select *
            from channels
            order by (
                select count(*)
                from posts
                where posts.channel_id = channels.channel_id
            ) desc
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

    public function addChannel()
    {
        $channel_name = request('name');
        $channel_description = request('description');
        if (strlen($channel_name) > 50) {
            return redirect()->route('home');
        }
        if (strlen($channel_description) > 100) {
            return redirect()->route('home');
        }
        if (empty($channel_name)) {
            return redirect()->route('home');
        }
        DB::insert('insert into channels (name, created_by, description, created_on) values (?, ?, ?, ?)', [
            $channel_name, auth()->user()->id, $channel_description, date("Y-m-d H:i:s")]);
        return redirect()->route('home');
    }
}
