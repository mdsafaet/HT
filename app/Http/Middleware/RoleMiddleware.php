<?php

namespace App\Http\Middleware;

use App\Trait\TraitsApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

   use TraitsApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        dd('Safaet');
        $user = auth()->user()->load('role');
        dd($user);
        if($user->$role){

            return $next($request);
        }
        return $this->unauthorized();
    }
}
