<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }} - Home</title>
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-6xl font-bold text-gray-900 dark:text-gray-100">
            Welcome, {{ $current_user['username'] }}!
        </h1>
        <div class="flex items-center justify-center mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-primary-button class="ml-4">
                    {{ __('Logout') }}
                </x-primary-button>
            </form>
        </div>
        <h2>
            Channels
        </h2>
        <!-- Add channel form -->
        <h3>
            Add Channel
        </h3>
        <form method="POST" action="{{ route('add_channel') }}">
            @csrf
            <x-label for="name" :value="__('Name')"/>
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                     autofocus/>
            <x-label for="description" :value="__('Description')"/>
            <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                     :value="old('description')" required autofocus/>
            <x-primary-button class="ml-4">
                {{ __('Add Channel') }}
            </x-primary-button>
        </form>

        @foreach($channels as $channel)
            <div class="channel" id="{{ $channel->channel_id }} ">
                <p class="channel_title">
                    <a href="{{ route('channel', ['channel_id' => $channel->channel_id]) }}">{{ $channel->name }}</a>
                </p>
                <p>
                        <?php $author = DB::table('users')->where('id', $channel->created_by)->first(); ?>
                    Created by {{ $author->username }}
                </p>
                <p class="channel_description">
                    {{ $channel->description }}
                </p>
                <p>
                        <?php $number_of_posts = DB::table('posts')->where('channel_id', $channel->channel_id)->count(); ?>
                    Posts: {{ $number_of_posts }}
                </p>
                <p class="post_created">
                    Made on {{ $channel->created_on }}
                </p>
            </div>
        @endforeach
    </div>
</div>
