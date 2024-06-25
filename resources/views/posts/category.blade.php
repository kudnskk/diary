<!-- resources/views/posts/category.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts in {{ $category->name }}</title>
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
        <h1>Posts in {{ $category->name }}</h1>

        <!-- Display Posts in Selected Category -->
        @if ($posts->isEmpty())
            <p>No posts found in this category.</p>
        @else
            @foreach ($posts as $post)
                <div class="card">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                    
                    @if ($post->photos->isNotEmpty())
            <div class="photos-container">
            @foreach ($post->photos as $photo)
    <img src="{{ asset($photo->filename) }}" alt="Post Image" style="width: 300px;"><br>
@endforeach
            </div>
        @endif
                    <p>Posted by: {{ $post->user->name }}</p>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
