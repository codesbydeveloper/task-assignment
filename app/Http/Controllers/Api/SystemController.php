<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HealthCheckService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SystemController extends Controller
{
    public function health(HealthCheckService $healthCheck): JsonResponse
    {
        return response()->json($healthCheck->run());
    }

    public function version(): JsonResponse
    {
        return response()->json([
            'app' => config('app.name'),
            'version' => config('app.version', '1.0.0'),
            'laravel' => app()->version(),
        ]);
    }

    public function rateLimit(Request $request): JsonResponse
    {
        $key = 'api:'.$request->ip();
        $max = 60;

        $remaining = RateLimiter::remaining($key, $max);

        return response()->json([
            'remaining' => $remaining,
            'limit' => $max,
        ]);
    }
}
