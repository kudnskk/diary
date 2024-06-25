<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
/* styles.css */
h1{
    color: #70c1b3;
}
/* Container styles */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Top right navigation */
.top-right {
    text-align: right;
    margin-top: 20px;
    padding: 10px;
}

.top-right a {
    margin-left: 10px;
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 5px;
    background-color: #70c1b3;
    transition: background-color 0.3s ease;
}

.top-right a:hover {
    background-color: #5baa9f;
    color: white;
    text-decoration: none;
}

/* Description section */
.description {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    font-size: 18px; /* slightly larger text */
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Diary App!</h1>
        <div class="top-right">
            @if (Route::has('login'))
                @auth
                @if (auth()->user()->role_id === 1) <!-- Check if user role_id is 1 (admin role) -->
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        @else
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @endif
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            @endif
        </div>
        <div class="description">
            <p>Here you will see posted diary posts after the log in.</p>
            <p>In this application you can create and maintain a personal diary, where it is possible to write records in different categories, upload photos and send reminders to your email.</p>
        </div>
    </div>
</body>
</html>
