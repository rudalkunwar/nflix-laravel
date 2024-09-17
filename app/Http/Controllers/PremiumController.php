<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
