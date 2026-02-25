<?php

namespace App\Livewire\Admin;

use App\Models\CronLog;
use Livewire\Component;
use Livewire\WithPagination;

class CronLogViewer extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.cron-log-viewer', [
            'logs' => CronLog::latest()->paginate(25),
        ])->layout('layouts.app', ['title' => 'Cron Logs']);
    }
}

