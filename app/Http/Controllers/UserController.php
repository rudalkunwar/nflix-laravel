<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.users.index', compact('users'));
    }
    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.user.index')->with('sucess', 'User Deleted Sucessfully');
    }
}
