<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }} - Edit Post</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-6xl font-bold text-gray-900 dark:text-gray-100">
            Edit Post
        </h1>
        <a href="{{ route('home') }}">Home</a>
        <h2>
            Edit Post
        </h2>
        <!-- Edit post form -->
        <form method="POST" action="{{ route('edit_post', ['post_id' => $post->post_id, 'channel_id' => $channel_id]) }}">
            @csrf
            <x-label for="title" :value="__('Title')"/>
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required
                     autofocus/>
            <x-label for="content" :value="__('Content')"/>
            <x-input id="content" class="block mt-1 w-full" type="text" name="content" :value="$post->content"
                     required autofocus/>
            <x-primary-button class="ml-4">
                {{ __('Edit Post') }}
            </x-primary-button>
        </form>
    </div>
