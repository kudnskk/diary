<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();

        // Pass the users data to the view
        return view('admin.dashboard', compact('users'));
    }
}
