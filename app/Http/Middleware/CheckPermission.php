<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $permission = explode('|', $permission);

        
        if(checkPermission($permission)){
            return $next($request);
        }


        return response()->view('notPermission');
    }
}
