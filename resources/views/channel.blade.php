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
        <h2>
            Posts
        </h2>
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
            <h3 class="post_title">
                {{ $post->title }}
            </h3>
            <p class="post_content">
                {{ $post->content }}
            </p>
            <p class="creation">
                {{ $post->created_on }}
            </p>
            <p>
                {{ $post->author_id }}
            </p>
            @endforeach
            </p>
    </div>
</body>
</html>
