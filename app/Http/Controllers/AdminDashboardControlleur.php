<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardControlleur extends Controller
{
    public function notifier()
    {
        $notifications = auth()->user()->unreadNotifications;
        //Marquer comme lue
        $notifications->markAsRead();
        return view('Admin.LayoutAdmin', compact('notifications'));
    }
}
