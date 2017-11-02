<?php

namespace qms\Http\Controllers\Auth;

use qms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function redirectTo() {
      if (strcmp(\Auth::user()->tipo, 'operador') == 0) {
        return '/operador';
      } else {
        if (strcmp(\Auth::user()->tipo, 'administrador') == 0) {
          return '/administrador';
        } else {
          //aqui é pra redirecionar para atendente index:
          return '/atendente';
        }
      }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
