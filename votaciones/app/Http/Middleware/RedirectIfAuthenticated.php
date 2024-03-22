<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Obtiene el rol del usuario autenticado
                $role = Auth::user()->role;

                // Redirige al usuario basado en su rol
                switch ($role) {
                    case 'admin':
                        // Ruta hacia el dashboard del administrador
                        return redirect('/dashboard/administrador');
                    case 'votante':
                        // Ruta hacia el dashboard del votante
                        return redirect('/dashboard/votante');
                    default:
                        // Redirige a algún lugar predeterminado si el rol no coincide
                        return redirect('/login');
                }
            }
        }

        return $next($request);
    }
}
