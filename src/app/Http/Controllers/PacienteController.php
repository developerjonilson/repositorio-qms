<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller {
  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddlewareOperador::class');
  }

  public function cadastrarPaciente(Request $request) {
    $uri = $request->path();
    return view('paciente.cadastrar-paciente')->with('rota', $uri);
  }

  public function buscarPaciente(Request $request) {
    $uri = $request->path();
    return view('paciente.buscar-paciente')->with('rota', $uri);
  }
}
