<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DetectDeleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(request()->json()->all()['event'] === 'message_revoke_everyone'){
            Log::info(DetectDeleteMiddleware::class,request()->json()->all());
            return response("Naa bro",200);
        }

        return $next($request);
    }
}
