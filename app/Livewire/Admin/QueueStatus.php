<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QueueStatus extends Component
{
    public function render()
    {
        return view('livewire.admin.queue-status', [
            'jobs' => DB::table('jobs')->count(),
            'failed' => DB::table('failed_jobs')->count(),
        ])->layout('layouts.app', ['title' => 'Queue Status']);
    }
}

