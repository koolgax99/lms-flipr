<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class HOD
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::user()->role_id === 5) {
          return $next($request);
      }

      else {
          return response()->json(['error' => 'Unauthorized'], 403);
      }
    }
}
