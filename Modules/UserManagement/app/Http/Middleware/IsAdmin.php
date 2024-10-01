<?php

namespace Modules\UserManagement\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\Check;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && Auth::user()->role === 'admin'){
            return $next($request);            
        }

        return response()->json(['error' => 'Unauthorized for ' . Auth::user()->role], 403);
    }
}
