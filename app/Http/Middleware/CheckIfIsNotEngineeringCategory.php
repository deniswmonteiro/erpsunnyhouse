<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfIsNotEngineeringCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if users category is 'ADMINISTRADOR' or 'OPERACIONAL' or 'TÉCNICO'
        if ($request->user()->category_id != 1 && $request->user()->category_id != 3 && $request->user()->category_id != 4) {
            return redirect('/engineering');
        }

        return $next($request);
    }
}
