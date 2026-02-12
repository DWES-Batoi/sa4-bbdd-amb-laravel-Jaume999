<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Importante para detectar el tipo de petición

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            'not.convidat' => \App\Http\Middleware\EnsureNotConvidat::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        // --- INICI CONFIGURACIÓ ERRORS API ---
        $exceptions->render(function (\Throwable $e, Request $request) {
            // Si la petició comença per 'api/' (p.ex. /api/jugadores)
            if ($request->is('api/*')) {
                
                // Determinem el codi d'estat (404 si el model no existeix, 500 per defecte)
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

                if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    $statusCode = 404;
                    $message = "Recurs no trobat.";
                } else {
                    $message = $e->getMessage();
                }

                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], $statusCode);
            }

            // Si no és una ruta d'API, Laravel continua amb el seu comportament normal
            return null;
        });
        // --- FI CONFIGURACIÓ ERRORS API ---

    })->create();