<?php

namespace App\Console\Commands;

use App\Models\CronLog;
use App\Services\EmailService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthCheckCommand extends Command
{
    protected $signature = 'system:health-check';

    protected $description = 'Check database and queue health';

    public function handle(EmailService $emailService): int
    {
        $startedAt = now();
        $status = 'success';
        $message = 'All systems healthy.';
        $context = [];

        try {
            DB::connection()->getPdo();
            $context['db'] = 'ok';
        } catch (\Throwable $e) {
            $status = 'failed';
            $message = 'Database connection failed.';
            $context['db'] = $e->getMessage();
        }

        try {
            Artisan::call('queue:failed');
            $context['queue'] = 'ok';
        } catch (\Throwable $e) {
            $status = 'failed';
            $message = 'Queue status check failed.';
            $context['queue'] = $e->getMessage();
        }

        if ($status === 'success') {
            Log::info($message, $context);
        } else {
            Log::critical('Health check failed', $context);

            $adminEmail = config('mail.from.address', 'admin@example.com');

            $emailService->queueEmail(
                $adminEmail,
                'System health check failed',
                'emails.health_failed',
                ['context' => $context]
            );
        }

        CronLog::create([
            'command' => $this->signature,
            'status' => $status,
            'started_at' => $startedAt,
            'finished_at' => now(),
            'message' => $message,
            'context' => $context,
        ]);

        return $status === 'success' ? self::SUCCESS : self::FAILURE;
    }
}

