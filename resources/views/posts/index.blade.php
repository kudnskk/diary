<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts by Category</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Include your custom CSS file here -->
    <link rel="stylesheet" href="{{ asset('css/styles_admin.css') }}">
</head>
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
<body>
    <div class="container">
    <div class="top-right">
            <a href="{{ route('dashboard') }}">Return to Dashboard</a>
        </div>
        <h1>Posts in Category: {{ $category->name }}</h1>

        <!-- Display Posts -->
        @if ($posts->isEmpty())
            <p>No posts found in this category.</p>
        @else
            <ul>
                @foreach ($posts as $post)
                    <li>
                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
