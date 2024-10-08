<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Premium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {


        // Check if the authenticated user is a premium user

        if (auth()->check() && !auth()->user()->userDetails) {

            return redirect()->route('user.premium');
        }


        if (auth()->check() && auth()->user()->userDetails->is_premium) {

            return $next($request);
        }


        return redirect()->route('user.premium');
    }
}
