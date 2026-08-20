<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public $showDropdown = false;

    public function markAsRead($notificationId)
    {
        auth()->user()->notifications()->find($notificationId)?->markAsRead();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    protected function getListeners()
    {
        return [
            "echo-notification:App.Models.User." . auth()->id() . ",notification" => 'refreshNotifications',
        ];
    }

    public function refreshNotifications()
    {
        //
    }

    public function render()
    {
        $notifications = auth()->user()->notifications()->latest()->take(10)->get();
        $unreadCount = auth()->user()->unreadNotifications()->count();

        return view('livewire.notification-bell', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }
}