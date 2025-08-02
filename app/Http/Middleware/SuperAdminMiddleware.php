<?php

namespace App\Http\Middleware;

use App\Trait\TraitsApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{

         use TraitsApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = auth()->user();
        if($user->hasRole('super_admin')){
            return $next($request);
        }
        return $this->unauthorized();
    }
}
