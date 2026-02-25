<?php

namespace App\Livewire\User;

use App\Models\NotificationCustom;
use Livewire\Component;

class NotificationsList extends Component
{
    public function render()
    {
        $notifications = NotificationCustom::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('livewire.user.notifications-list', [
            'notifications' => $notifications,
        ])->layout('layouts.app', ['title' => 'Notifications']);
    }
}

