<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header('language')) :
            return response()->json(['error' => 'отсутствуют необходимые заголовки(language)'],500);
        endif;
        if (!$request->header('system')) :
            return response()->json(['error' => 'отсутствуют необходимые заголовки(system)'],500);
        endif;
        if (!$request->header('version')) :
            return response()->json(['error' => 'отсутствуют необходимые заголовки(version)'],500);
        endif;
        return $next($request);
    }
}
