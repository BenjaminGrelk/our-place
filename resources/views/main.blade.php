<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Main Page</h1>
    <p>
        Welcome, {{ auth()->user()->username }}!
    </p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
