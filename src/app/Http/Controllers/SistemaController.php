<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class SistemaController extends Controller {
  public function __construct() {
      $this->middleware('auth');
  }

  public function acessoNegadoAtendente() {
    return view('sistema.erro-acesso-atendente');
  }

}
