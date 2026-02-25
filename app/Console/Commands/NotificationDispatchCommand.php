<?php

namespace App\Console\Commands;

use App\Models\CronLog;
use App\Services\NotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationDispatchCommand extends Command
{
    protected $signature = 'notifications:dispatch-pending';

    protected $description = 'Dispatch pending notifications';

    public function handle(NotificationService $notificationService): int
    {
        $startedAt = now();

        try {
            $notificationService->dispatchPending();

            $message = 'Pending notifications dispatched.';
            Log::info($message);

            CronLog::create([
                'command' => $this->signature,
                'status' => 'success',
                'started_at' => $startedAt,
                'finished_at' => now(),
                'message' => $message,
            ]);

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $message = 'Notification dispatch failed: '.$e->getMessage();
            Log::error($message, ['exception' => $e]);

            CronLog::create([
                'command' => $this->signature,
                'status' => 'failed',
                'started_at' => $startedAt,
                'finished_at' => now(),
                'message' => $message,
                'context' => ['trace' => $e->getTraceAsString()],
            ]);

            return self::FAILURE;
        }
    }
}

