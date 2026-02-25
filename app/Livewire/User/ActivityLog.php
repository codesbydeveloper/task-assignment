<?php

namespace App\Livewire\User;

use App\Models\ActivityLog as ActivityLogModel;
use Livewire\Component;

class ActivityLog extends Component
{
    public function render()
    {
        $logs = ActivityLogModel::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('livewire.user.activity-log', [
            'logs' => $logs,
        ])->layout('layouts.app', ['title' => 'Activity Logs']);
    }
}

