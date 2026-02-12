<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureNotConvidat
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'convidat') {
            abort(403, 'El convidat no té permisos per a modificar dades.');
        }

        return $next($request);
    }
}
