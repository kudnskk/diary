<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Include your custom CSS file here -->
    <link rel="stylesheet" href="{{ asset('css/styles_admin.css') }}">
</head>
<style>
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
        <h1>Create New Post</h1>

        <!-- Form to Create New Post -->
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title') }}"><br><br>

    <label for="content">Content:</label><br>
    <textarea id="content" name="content">{{ old('content') }}</textarea><br><br>

    <label for="category_id">Category:</label><br>
    <select id="category_id" name="category_id">
    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
    </select><br><br>

    <label for="photos">Photos:</label><br>
    <input type="file" id="photos" name="photos[]" multiple accept="image/*"><br><br>

    <button type="submit">Create Post</button>
</form>

    </div>
</body>
</html>
