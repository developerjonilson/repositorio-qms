<?php

namespace qms\Http\Middleware;

use Closure;

class AutorizacaoMiddlewareOperador {
    public function handle($request, Closure $next) {

        // if (strcmp(\Auth::user()->tipo, 'operador') != 0) {
        //   if (strcmp(\Auth::user()->tipo, 'administrador') == 0) {
        //     return redirect('/acesso-negado-administrador');
        //   } else {
        //     return redirect('/acesso-negado-atendente');
        //   }
        // }
        // if ($tipoUser = \Auth::user()->tipo) {
        //   # code...
        // } else {
        //   # code...
        // }
        if (isset(\Auth::user()->tipo)) {
          $user = \Auth::user()->tipo;

          if (strcmp($user, 'operador') == 0) {
            return $next($request);
          } else {
            if (strcmp($user, 'administrador') == 0) {
              return Redirect('/acesso-negado-administrador');
            } else {
              return Redirect('/acesso-negado-atendente');
            }
          }

        }
        // return $next($request);
    }
}
