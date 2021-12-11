<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DepartamentsControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $departament)
    {
        if ($request->user()->departament->name !== $departament) {
            return abort(403);
        }
        
        return $next($request);
    }
}
