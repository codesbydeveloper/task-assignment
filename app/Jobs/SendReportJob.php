<?php

namespace App\Jobs;

use App\Models\Report;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 120;

    public function __construct(public int $reportId)
    {
        $this->onQueue('reports');
    }

    public function handle(EmailService $emailService): void
    {
        $report = Report::findOrFail($this->reportId);
        $admins = User::where('role', 'admin')
            ->where('active', true)
            ->get();

        foreach ($admins as $admin) {
            $emailService->sendEmail(
                $admin->email,
                'Daily System Report',
                'emails.daily_report',
                ['report' => $report, 'admin' => $admin]
            );
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('SendReportJob failed', [
            'report_id' => $this->reportId,
            'exception' => $exception?->getMessage(),
        ]);
    }
}

