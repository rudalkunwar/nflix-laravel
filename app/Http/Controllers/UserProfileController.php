<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        return view('users.profile.index');
    }
}
