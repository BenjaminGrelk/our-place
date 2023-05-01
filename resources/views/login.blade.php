<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <label>
            <input type="text" name="username" placeholder="Username">
        </label>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label>
        <button type="submit">Login</button>
    </form>
</body>
</html>
