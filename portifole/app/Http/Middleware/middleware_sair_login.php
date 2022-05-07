<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class middleware_sair_login
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
        if (session()->get('key') == 0) {
            return $next($request);
        }
        return redirect()->route('index');
    }
}
