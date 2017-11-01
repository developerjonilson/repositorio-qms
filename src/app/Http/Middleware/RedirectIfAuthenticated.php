<?php

namespace qms\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        if (Auth::guard($guard)->check()) {
          $tipoUser = \Auth::user()->tipo;
            if (strcmp($tipoUser, 'operador' ) == 0) {
              return redirect('/operador');
            } else {
              if (strcmp($tipoUser, 'administrador' ) == 0) {
                return redirect('/administrador');
              } else {
                return redirect('/atendende');
              }

            }
        }

        return $next($request);
    }
}
