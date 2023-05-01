<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/app.css">
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
