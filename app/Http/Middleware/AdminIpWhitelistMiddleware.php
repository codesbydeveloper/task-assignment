<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminIpWhitelistMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = config('admin.ip_whitelist', []);

        if (! empty($allowedIps) && ! in_array($request->ip(), $allowedIps, true)) {
            abort(403, 'Access from your IP is not allowed.');
        }

        return $next($request);
    }
}

