<?php

namespace App\Http\Middleware;

use App\Http\Services\RoleService;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (str_contains($request->getRequestUri(), '/admin')) {
            if (RoleService::isAdmin()) {
                return $next($request);
            }

            abort(403, 'You do not have access to this resource.');
        } else {
            if (str_contains($request->getRequestUri(), '/user')
                || ! str_contains($request->getRequestUri(), '/user')) {
                if (RoleService::isUser()
                    || str_contains($request->getRequestUri(), '/logout')) {
                    return $next($request);
                }

                abort(403, 'You do not have access to this resource.');
            }
        }
    }
}
