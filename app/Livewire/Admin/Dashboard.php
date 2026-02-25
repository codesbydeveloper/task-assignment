<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('active', true)->count(),
            'totalTransactions' => Transaction::count(),
            'dailyReports' => Report::whereDate('report_date', now()->toDateString())->count(),
            'queuePending' => DB::table('jobs')->count(),
        ])->layout('layouts.app', ['title' => 'Admin Dashboard']);
    }
}

