<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORS
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', $request->header('origin'));
        $response->header('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}