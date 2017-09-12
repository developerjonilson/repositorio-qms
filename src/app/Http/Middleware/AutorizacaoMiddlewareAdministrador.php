<?php

namespace qms\Http\Middleware;

use Closure;

class AutorizacaoMiddlewareAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (isset(\Auth::user()->tipo)) {
        $user = \Auth::user()->tipo;

        if (strcmp($user, 'administrador') == 0) {
          return $next($request);
        } else {
          if (strcmp($user, 'operador') == 0) {
            return Redirect('/acesso-negado-operador');
          } else {
            return Redirect('/acesso-negado-atendente');
          }
        }
      }

    }
}
