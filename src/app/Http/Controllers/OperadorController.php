<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class OperadorController extends Controller {
  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddlewareOperador::class');
  }

  public function index() {
    return view('operador.index');
  }

  //aagora funções do usuario logado:
  public function perfil() {
    return view('operador.perfil-usuario');
  }

  public function alterarUsuario() {
    return view('operador.alterar-dados-usuario');
  }

  public function alterarSenha() {
    return view('operador.alterar-senha-usuario');
  }

  public function manualOperador() {
    return view('operador.manual-operador');
  }

  public function acessoNegadoOperador() {
    return view('operador.erro-acesso-operador');
  }
}
