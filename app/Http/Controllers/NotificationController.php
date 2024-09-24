<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Feedback::all();

        return view('admin.notifications.index', compact('notifications'));
    }
    public function destroy($id)
    {
        $notification = Feedback::find($id);

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
