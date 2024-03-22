<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleVotante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Comprobar si el usuario está autenticado y si es un administrador
        if (!Auth::check() || Auth::user()->role !== 'votante') {
            // Si el usuario no es un administrador, redirigir a algún lugar.
            // Podrías redirigir al dashboard de usuario o a la página de inicio, por ejemplo.
            return redirect('/login');
        }

        return $next($request);
    }
}