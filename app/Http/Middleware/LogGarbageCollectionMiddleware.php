<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogGarbageCollectionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Log memory usage
        Log::info('Actual memory used (false): ' . memory_get_usage());
        Log::info('Allocated memory block (true): ' . memory_get_usage(true));
        $cycles = gc_collect_cycles();
        Log::info('GC cycles run: ' . $cycles);
        Log::info('Actual memory used (false): ' . memory_get_usage());
        Log::info('Allocated memory block (true): ' . memory_get_usage(true));

        return $response;
    }
}
