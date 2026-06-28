<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottle
{
    public function __construct(protected RateLimiter $limiter) {}

    public function handle(Request $request, Closure $next, int $maxAttempts = 5, int $decayMinutes = 1): Response
    {
        $key = $this->resolveKey($request, $maxAttempts, $decayMinutes);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            $seconds = $this->limiter->availableIn($key);

            return back()->with('loginError', "Percobaan login telah melebihi {$maxAttempts}x. Coba lagi dalam {$seconds} detik.");
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }

    protected function resolveKey(Request $request, int $maxAttempts, int $decayMinutes): string
    {
        return 'login:' . $request->ip();
    }
}
