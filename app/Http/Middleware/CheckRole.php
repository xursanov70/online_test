<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $user_type)
    {
        $user = $request->user();

        if ($user && $user->user_type === $user_type) {
            return $next($request);
        }
        
        return response()->json(['error' => 'Amalyotga huquq yo\'q'], 401);
    }
}
