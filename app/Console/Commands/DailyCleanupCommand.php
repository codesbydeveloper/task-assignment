<?php

namespace App\Console\Commands;

use App\Models\CronLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyCleanupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:daily-cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily cleanup of expired tokens, logs, and temporary records';

    public function handle()
    {
        $startedAt = now();

        try {
            DB::transaction(function () {
                DB::table('personal_access_tokens')
                    ->where('last_used_at', '<', now()->subDays(30))
                    ->orWhere('created_at', '<', now()->subDays(60))
                    ->delete();

                DB::table('cron_logs')
                    ->where('created_at', '<', now()->subDays(30))
                    ->delete();

            });

            $message = 'Daily cleanup completed successfully.';

            CronLog::create([
                'command' => $this->signature,
                'status' => 'success',
                'started_at' => $startedAt,
                'finished_at' => now(),
                'message' => $message,
            ]);

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $message = 'Daily cleanup failed: '.$e->getMessage();
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

