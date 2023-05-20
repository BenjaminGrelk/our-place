<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }} - Channel</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<!-- Show all the posts in the channel -->
<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-6xl font-bold text-gray-900 dark:text-gray-100">
            {{ $channel->name }}
        </h1>
        <a href="{{ route('home') }}">Home</a>
        <h2>Description</h2>
        <p class="description">
            {{ $channel->description }}
        </p>
        <h3>
            Posts
        </h3>
        <!-- Add post form -->
        <form method="POST" action="{{ route('add_post', ['channel_id' => $channel->channel_id]) }}">
            @csrf
            <x-label for="title" :value="__('Title')"/>
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                     autofocus/>
            <x-label for="content" :value="__('Content')"/>
            <x-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content')"
                     required autofocus/>
            <x-primary-button class="ml-4">
                {{ __('Add Post') }}
            </x-primary-button>
        </form>
        @foreach($posts as $post)
            <div class="post" id="{{ $post->post_id }}">
                <p class="post_title">
                    {{ $post->title }}
                </p>
                    <?php $author = DB::table('users')->where('id', $post->author_id)->first(); ?>
                <p class="post_author">
                    By {{ $author->username }}
                </p>
                <p class="post_content">
                    {{ $post->content }}
                </p>
                <p class="post_created">
                    Made on {{ $post->created_on }}
                </p>
                @if (($post->author_id == $current_user['id']) || ($current_user['is_admin']))
                    <!-- Edit the post -->
                    <form method="POST" class="edit_post"
                          action="{{ route('editing_post', ['post_id' => $post->post_id, 'channel_id' => $channel->channel_id]) }}">
                        @csrf
                        <button type="submit">Edit</button>
                    </form>

                    <!-- Delete the post -->
                    <form method="POST" class="delete_post"
                          action="{{ route('delete_post', ['post_id' => $post->post_id, 'channel_id' => $channel->channel_id]) }}">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</body>
</html>
