<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserHasAnyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$permissions)
    {
        if(!auth()->guard('admin')->user()->hasAnyPermission($permissions)){
            abort(403,'You do not have permission to access this page');
        }
        return $next($request);
    }
}
