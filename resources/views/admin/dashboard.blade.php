<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles_admin.css') }}">
</head>
<body>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="container mx-auto">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <div class="collapse navbar-collapse">
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container mx-auto py-6 sm:px-6 lg:px-8">
           

            <!-- User List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($users as $user)
                    <div class="p-4 bg-white rounded-lg shadow-md card"> <!-- Add 'card' class here -->
                        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-gray-600">Role: {{ $user->role->name }}</p>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete User</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </main>
    </div>

    <!-- Include your JS scripts if needed -->
</body>
</html>
