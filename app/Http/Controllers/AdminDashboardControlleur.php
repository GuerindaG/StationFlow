<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardControlleur extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Marque une notification comme lue et redirige
     */
    public function read($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();

        // Marquer comme lue sans redirection
        $notification->markAsRead();

        // Retourner une réponse JSON pour les requêtes AJAX
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'notification' => $notification->fresh() // Retourne les données actualisées
            ]);
        }

        // Pour les requêtes normales, rechargez la même page
        return back();
    }

    /**
     * Marque une notification comme non lue
     */
    public function unread($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();

        $notification->update(['read_at' => null]);

        return response()->json(['success' => true]);
    }

    /**
     * Marque toutes les notifications comme lues
     */
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }

    /**
     * Supprime une notification
     */
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Notification supprimée.');
    }

    /**
     * Suppression en masse
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('notifications', []);

        if (count($ids) > 0) {
            auth()->user()->notifications()->whereIn('id', $ids)->delete();
            return back()->with('success', count($ids) . ' notifications supprimées.');
        }

        return back()->with('error', 'Aucune notification sélectionnée.');
    }

    /**
     * Compte les notifications non lues (pour API/AJAX)
     */
    public function unreadCount()
    {
        $count = auth()->user()->unreadNotifications->count();
        return response()->json(['count' => $count]);
    }

}
