<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\CronLog;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminApiController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'total_users' => User::count(),
            'active_users' => User::where('active', true)->count(),
            'total_transactions' => Transaction::count(),
            'daily_reports' => DB::table('reports')
                ->whereDate('report_date', now()->toDateString())
                ->count(),
            'queue_pending' => DB::table('jobs')->count(),
        ]);
    }

    public function logs()
    {
        $logs = CronLog::latest()->paginate(50);

        return response()->json($logs);
    }

    public function cronStatus()
    {
        $lastRuns = CronLog::query()
            ->select('command', DB::raw('MAX(created_at) as last_run'))
            ->groupBy('command')
            ->get();

        return response()->json(['last_runs' => $lastRuns]);
    }

    public function queueStatus()
    {
        return response()->json([
            'jobs' => DB::table('jobs')->count(),
            'failed_jobs' => DB::table('failed_jobs')->count(),
        ]);
    }
}

