<?php

namespace App\Livewire\Admin;

use App\Services\HealthCheckService;
use Livewire\Component;

class SystemHealth extends Component
{
    public array $health = [];

    public function mount(HealthCheckService $healthCheck): void
    {
        $this->health = $healthCheck->run();
    }

    public function refreshHealth(HealthCheckService $healthCheck): void
    {
        $this->health = $healthCheck->run();
    }

    public function render()
    {
        return view('livewire.admin.system-health', [
            'health' => $this->health,
        ])->layout('layouts.app', ['title' => 'System Health']);
    }
}
