<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')"/>
            <x-text-input id="username" class="block mt-1 w-full" type="username" name="username"
                          :value="old('username')" required autocomplete="username"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('register') }}">
                {{ __('Not registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
