<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (! $user?->isAdmin) {
            return response()->json([
                "status" => "401: Unauthorized",
                "message" => "Only admins can use the api",
            ]);
        }

        return $next($request);
    }
}
