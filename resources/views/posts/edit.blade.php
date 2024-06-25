<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
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
        <h1>Edit Post</h1>

        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control">{{ $post->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</body>
</html>
