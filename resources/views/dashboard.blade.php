<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Include your custom CSS file here -->
    <link rel="stylesheet" href="{{ asset('css/styles_admin.css') }}">
    <style>
        /* styles.css */
        h1 {
            color: #70c1b3;
        }
        
        
        h2 {
            color: #70c1b3;
        }
        
        nav {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            font-size: 18px; /* slightly larger text */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            font-size: 18px; /* slightly larger text */
        }
        
        .navbar {
            background-color: #70c1b3;
            padding: 1rem;
        }
        
        .navbar ul {
            list-style: none;
            display: flex;
            align-items: center;
        }
        
        .navbar ul li {
            margin-right: 1rem;
        }
        
        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .navbar ul li a:hover {
            background-color: #5aa89e;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f4f0ec;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 10px;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown:hover .dropbtn {
            background-color: #5aa89e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Your Dashboard!</h1>
        
        <!-- Navigation Links -->
        <nav class="navbar">
            <ul>
                <li><a href="{{ route('posts.create') }}">Create New Post</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Categories</a>
                    <div class="dropdown-content">
                        @foreach ($categories as $category)
                            <a href="{{ route('posts.category', $category->id) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('users.show', $user->id) }}">View Profile</a></li>
                <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
            </ul>
        </nav>
        
        <!-- Display User's Posts -->
        @if ($posts->isEmpty())
            <p>You haven't created any posts yet.</p>
        @else
            <h2>Your Posts</h2>
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
                    
                    <p>Category: {{ $post->category->name }}</p>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                </div>
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="mt-6" style="padding: 20px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>
            @endforeach
        @endif
        
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
</body>
</html>
