<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardControlleur extends Controller
{
    public function notifier()
    {
        $notifications = auth()->user()->notifications;
        //Marquer comme lue
        $notifications->markAsRead();
        return view('Admin.LayoutAdmin', compact('notifications'));
    }
    public function read($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            return redirect($notification->data['lien']);
        }

        return redirect()->back()->with('error', 'Notification introuvable.');
    }
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
    public function destroy($id)
    {
        $notif = auth()->user()->notifications()->where('id', $id)->first();

        if ($notif) {
            $notif->delete();
        }
        return back();
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('notifications', []);

        auth()->user()->notifications()->whereIn('id', $ids)->delete();

        return back()->with('success', 'Notifications supprimées.');
    }


}
