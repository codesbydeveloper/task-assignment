<?php

namespace App\Console\Commands;

use App\Models\CronLog;
use App\Services\ReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReportGenerationCommand extends Command
{
    protected $signature = 'reports:generate-daily';

    protected $description = 'Generate and dispatch daily system report';

    public function handle(ReportService $reportService)
    {
        $startedAt = now();

        try {
            $data = $reportService->generateDailyReport();
            $report = $reportService->storeReport($data);
            $reportService->sendAdminSummary($report);

            $message = 'Daily report generated and summary dispatched.';
            Log::info($message, ['report_id' => $report->id]);

            CronLog::create([
                'command' => $this->signature,
                'status' => 'success',
                'started_at' => $startedAt,
                'finished_at' => now(),
                'message' => $message,
            ]);

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $message = 'Daily report generation failed: '.$e->getMessage();
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

