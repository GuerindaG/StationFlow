<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGerant
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isGestionnaire()) {
            abort(403, 'Accès interdit. Gestionnaire requis.');
        }

        return $next($request);
    }
}
