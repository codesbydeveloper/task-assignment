<?php

namespace App\Services;

use App\Jobs\SendNotificationJob;
use App\Models\NotificationCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function createNotification(array $data): NotificationCustom
    {
        return NotificationCustom::create([
            'user_id' => $data['user_id'],
            'channel' => $data['channel'] ?? 'email',
            'type' => $data['type'] ?? null,
            'data' => $data['data'],
            'status' => 'pending',
            'scheduled_at' => $data['scheduled_at'] ?? null,
        ]);
    }

    public function dispatchPending(): void
    {
        $pending = NotificationCustom::query()
            ->where('status', 'pending')
            ->where(function ($q) {
                $q->whereNull('scheduled_at')
                    ->orWhere('scheduled_at', '<=', now());
            })
            ->limit(100)
            ->get();

        foreach ($pending as $notification) {
            DB::transaction(function () use ($notification) {
                $notification->update([
                    'status' => 'queued',
                    'attempts' => $notification->attempts + 1,
                ]);

                SendNotificationJob::dispatch($notification->id)->onQueue('notifications');
            });
        }

        Log::info('Pending notifications dispatched', ['count' => $pending->count()]);
    }
}

