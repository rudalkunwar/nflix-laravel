<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminAccountController extends Controller
{
    public function settings()
    {
        return view('admin.settings');
    }

    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function profileEdit()
    {
        $admin = Auth::user();
        return view('admin.profile-edit', compact('admin'));
    }

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

        return redirect()->route('admin.settings')->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Update user details
        $userDetails = $user->userDetails;

        if ($userDetails) {
            $userDetails->address = $request->address;
            $userDetails->phone_number = $request->phone;
            $userDetails->save();
        } else {
            $user->userDetails()->create([
                'address' => $request->address,
                'phone_number' => $request->phone,
            ]);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $userDetails = $user->userDetails;

        // Create user details if they don't exist
        if (!$userDetails) {
            $userDetails = $user->userDetails()->create([
                'photo' => null,
            ]);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($userDetails->photo && Storage::exists('public/users/' . $userDetails->photo)) {
                Storage::delete('public/users/' . $userDetails->photo);
            }

            // Store new photo
            $path = $request->file('photo')->store('public/users');

            $userDetails->photo = basename($path);
        }

        $userDetails->save();

        return redirect()->route('admin.profile')->with('success', 'Profile Picture updated successfully.');
    }
}
