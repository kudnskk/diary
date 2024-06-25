<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles_admin.css') }}">
    <style>
        h1 {
            color: #70c1b3;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
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
        .description {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>

        <div class="top-right">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
        </div>

        <!-- Form to Edit Profile -->
        <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"><br><br>
    
    <!-- Add more fields as needed -->

    <button type="submit">Update Profile</button>
</form>

    </div>
</body>
</html>
