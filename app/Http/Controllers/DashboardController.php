<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Fetch authenticated user
        $posts = $user->posts()->latest()->get(); // Example of fetching user's posts
        $categories = Category::all(); // Example of fetching categories
        return view('dashboard', compact('user', 'posts', 'categories'));
    
    }
}
