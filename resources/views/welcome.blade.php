<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config("app.name") }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>
<h1 style="text-align: center">
    {{ config("app.name") }}
</h1>
<hr>
<nav>
    <ul>
        <li>
            <a href="/dashboard">Go to Dashboard</a>
        </li>
        <li>
            <a href="/login">Login</a>
        </li>
        <li>
            <a href="/register">Create Account</a>
        </li>
    </ul>
</nav>
</body>
</html>
