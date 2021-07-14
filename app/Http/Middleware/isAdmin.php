<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin 
{
    public function handle($request, Closure $next)
    {
        if($request->user()->roles == 1){
            return $next($request);
        }
        abort(403, 'Access Forbidden!');
    }
}
