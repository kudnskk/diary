<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


// After the profile is created
Mail::to($user->email)->send(new ProfileCreated($user));
class CustomUserController extends Controller

{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Assign default role_id
    $role = Role::where('name', 'user')->first(); // Assuming 'user' role exists
    $role_id = $role->id;

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $role_id, // Assign default role_id here
    ]);
   
    return redirect()->route('home')
        ->with('success', 'User created successfully.');
}

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    // If $id is 'profile', update the authenticated user's profile
    if ($id === 'profile') {
        $user = auth()->user();
    } else {
        $user = User::findOrFail($id);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Redirect based on whether it was a profile update or user update
    if ($id === 'profile') {
        return redirect()->route('users.show', $user->id)->with('success', 'Profile updated successfully.');
    } else {
        return redirect()->route('users.show', $user->id)->with('success', 'User updated successfully.');
    }
}

    public function destroy(User $user)
    {
        $user->delete();
        
        // Send email notification
        Mail::to($user->email)->send(new \App\Mail\UserDeleted($user));

        return redirect()->route('admin.dashboard')
            ->with('success', 'User deleted successfully.');
    }

    public function deleteProfile(Request $request)
    {
        Log::info('deleteProfile method called'); // Log method entry

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Log::info('User authenticated', ['user' => $user]);

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('User deleted and session invalidated');

        return Redirect::to('/');
    }
}
