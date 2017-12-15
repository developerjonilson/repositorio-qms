<?php

namespace qms\Http\Controllers\Auth;

use qms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
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
        $this->middleware('guest');
    }
}
