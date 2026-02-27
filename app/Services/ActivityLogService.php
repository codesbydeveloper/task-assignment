<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogService
{
    public function log(?User $user, string $action, array $meta = [])
    {
        return ActivityLog::create([
            'user_id' => $user?->id,
            'action' => $action,
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
            'meta' => $meta,
        ]);
    }
}

