<?php

namespace App\Livewire\User;

use App\Models\Transaction;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        return view('livewire.user.dashboard', [
            'totalTransactions' => Transaction::where('user_id', $user?->id)->count(),
        ])->layout('layouts.app', ['title' => 'Dashboard']);
    }
}

