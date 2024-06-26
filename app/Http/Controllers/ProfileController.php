<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Notifications\ProfileDeleted;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
{   
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    // Notify about profile deletion
    $notification = new ProfileDeleted($user);
    
    // Attempt to send the notification synchronously
    try {
        $user->notifyNow($notification); // Send notification synchronously
        Log::info('Profile deletion notification dispatched successfully.');
        // Optionally, set a flag indicating notification was sent successfully
        $notificationSent = true;
    } catch (\Exception $e) {
        Log::error('Failed to dispatch profile deletion notification: ' . $e->getMessage());
        // Optionally, handle notification sending failure
        $notificationSent = false;
    }

    // Logout the user
    Auth::logout();
    
    // Invalidate session and regenerate token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Delete the user if notification was sent successfully
    if ($notificationSent) {
        $user->delete();
        Log::info('User ' . $user->name . ' has been deleted.');
    } else {
        Log::error('User deletion aborted due to failed notification dispatch.');
        // Optionally handle the case where user deletion is aborted
    }

    return redirect('/');
}


}
