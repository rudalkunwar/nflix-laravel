<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    /**
     * Display the user's profile information.
     */
    public function profile()
    {
        $user = Auth::user();
        $userDetails = $user->userDetails;

        return view('users.account.index', compact('user', 'userDetails'));
    }

    /**
     * Display the account settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        return view('users.account.settings', compact('user'));
    }

    /**
     * Show the form for changing the password.
     */
    public function changePassword()
    {
        return view('users.account.change-password');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Update userDetails if exists
        if ($user->userDetails) {
            $userDetails = $user->userDetails;
            $userDetails->address = $request->address;
            $userDetails->phone_number = $request->phone_number;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/users');
                $userDetails->photo = basename($path);
            }

            $userDetails->save();
        } else {
            // Create userDetails if not exists
            $user->userDetails()->create([
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'photo' => $request->hasFile('photo') ? basename($request->file('photo')->store('public/users')) : null,
            ]);
        }

        $user->save();

        return redirect()->route('user.account.profile')->with('status', 'Profile updated successfully.');
    }

    /**
     * Handle the password change request.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.account.profile')->with('status', 'Password updated successfully.');
    }
}
