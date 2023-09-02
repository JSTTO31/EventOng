<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request){

        $notifications = $request->status == 'read' ? $request->user()->readNotifications : ($request->status == 'unread' ? $request->user()->unreadNotifications : $request->user()->notifications);

        return Inertia::render('Notification', [
            'notifications' => $notifications,
            'hasRead' => $request->user()->readNotifications->count() > 0,
            'hasUnread' => $request->user()->unreadNotifications->count() > 0,
        ]);
    }


    public function markAsRead(Request $request, $notification){
        // dd($notification);
        $request->user()->notifications->where('id', $notification)->markAsRead();

        return back();
    }

    public function markAsReadAll(Request $request){
        // dd($notification);
        $request->user()->notifications->markAsRead();

        return back();
    }

    public function markAsReadAndVisit(Request $request, $notification){
        // dd($notification);
        $notification = $request->user()->notifications->where('id', $notification)->first();
        $notification->markAsRead();
        return redirect()->route('events.show', ['event' => $notification->data['event']['id'], 'attendee' => $notification->data['attendee']['id']]);
    }


    public function markAsUnread(Request $request, $notification){
        $request->user()->notifications->where('id', $notification)->markAsUnread();

        return back();
    }

    public function markAsUnreadAll(Request $request){
        $request->user()->notifications->markAsUnread();

        return back();
    }


    public function remove(Request $request, $notification){
        $request->user()->notifications()->where('id', $notification)->delete();

        return back();
    }

    public function removeAll(Request $request, $notification){
        $request->user()->notifications()->delete();

        return back();
    }
}
