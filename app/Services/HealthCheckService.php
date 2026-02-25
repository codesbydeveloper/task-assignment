<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckService
{
    public function run(): array
    {
        $status = 'ok';
        $checks = [];

        try {
            DB::connection()->getPdo();
            $checks['db'] = 'ok';
        } catch (\Throwable $e) {
            $checks['db'] = 'failed';
            $status = 'degraded';
        }

        try {
            Redis::ping();
            $checks['redis'] = 'ok';
        } catch (\Throwable $e) {
            $checks['redis'] = 'failed';
            $status = 'degraded';
        }

        try {
            $checks['queue_pending'] = DB::table('jobs')->count();
        } catch (\Throwable $e) {
            $checks['queue_pending'] = 'error';
        }

        try {
            $checks['failed_jobs'] = DB::table('failed_jobs')->count();
        } catch (\Throwable $e) {
            $checks['failed_jobs'] = 'error';
        }

        return [
            'status' => $status,
            'checks' => $checks,
        ];
    }
}
