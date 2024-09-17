<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumController extends Controller
{
    public function index()
    {
        return view('users.premium');
    }
    public function upgrade()
    {
        return view('users.premium-upgrade');
    }
    public function cancel(Request $request)
    {
        $user = Auth::user();
        $userDetails = $user->userDetails;

        if ($userDetails && $userDetails->is_premium) {
            $userDetails->is_premium = false;
            $userDetails->premium_expiry_date = null;
            $userDetails->save();

            return redirect()->route('user.premium')->with('success', 'Your premium membership has been canceled.');
        }
        return redirect()->route('user.premium')->with('error', 'You do not have an active premium membership.');
    }
}
