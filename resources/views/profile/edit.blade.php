<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        h1 {
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
    <div class="top-right">
            <a href="{{ route('dashboard') }}">Return to Dashboard</a>
        </div>
        <div>
            <h1>Edit Profile</h1>

            <div class="description">
                <!-- Update Profile Information Form -->
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="description">
                <!-- Update Password Form -->
                @include('profile.partials.update-password-form')
            </div>

            <div class="description">
                <!-- Delete User Form -->
                <form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <label for="password">Password</label>
    <input id="password" name="password" type="password" required>
    
    <button type="submit">Delete Account</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>
