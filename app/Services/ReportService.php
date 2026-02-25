<?php

namespace App\Services;

use App\Jobs\SendReportJob;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportService
{
    public function generateDailyReport(\DateTimeInterface $date = null): array
    {
        $dateString = $date ? $date->format('Y-m-d') : now()->toDateString();

        $totalUsers = User::count();
        $activeUsers = User::where('active', true)->count();
        $totalTransactions = Transaction::count();
        $dailyTransactions = Transaction::whereDate('created_at', $dateString)->count();

        return [
            'report_date' => $dateString,
            'total_users' => $totalUsers,
            'active_users' => $activeUsers,
            'total_transactions' => $totalTransactions,
            'daily_transactions' => $dailyTransactions,
        ];
    }

    public function storeReport(array $data): Report
    {
        return DB::transaction(function () use ($data) {
            $report = Report::updateOrCreate(
                ['report_date' => $data['report_date'], 'type' => 'daily'],
                ['summary' => 'Daily system report', 'data' => $data]
            );

            Log::info('Daily report stored', ['report_id' => $report->id]);

            return $report;
        });
    }

    public function sendAdminSummary(Report $report): void
    {
        SendReportJob::dispatch($report->id)->onQueue('reports');
    }
}

