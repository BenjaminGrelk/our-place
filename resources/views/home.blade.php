<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }} - Home</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<!-- Welcome the user by name -->

<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-6xl font-bold text-gray-900 dark:text-gray-100">
            Welcome {{ $current_user['username'] }}
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
        <p>
        @foreach($channels as $channel)
            <h3>
                <a href="{{ route('channel', ['channel_id' => $channel->channel_id]) }}">{{ $channel->name }}</a>
            </h3>
            @endforeach
            </p>
    </div>
</div>
