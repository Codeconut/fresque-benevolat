<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LastOnlineAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            return $next($request);
        }

        $last_online = new Carbon(auth()->user()->last_online_at);
        if (!auth()->user()->last_online_at || ($last_online->diffInMinutes(now()) > 5)) {
            $now = now();
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update([
                    'last_online_at' => $now,
                ]);
        }

        return $next($request);
    }
}
