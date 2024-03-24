<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check())
        {
            $allowedRoles = ['0', '1'];  // 0 = for Admin and 1 = For super Admin
            $role = Auth::user()->role_as;

            if (in_array($role, $allowedRoles))
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('error', 'Unauthorized Access');
            }
        }
        else
        {
            return redirect('/login')->with('status', 'OOPS..Please Login First');
        }return $next($request);
    }
}
