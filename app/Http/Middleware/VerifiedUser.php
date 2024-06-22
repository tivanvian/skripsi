<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifiedUser
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
        if(\Auth::check()){
            if (auth()->user()->email_verified_at == null && auth()->user()->getTypeRole() == 'user') {
                return redirect()->to('email/verify');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
