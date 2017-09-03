<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class OperadorController extends Controller
{
  public function index(Request $request) {
    $uri = $request->path();
    return view('operador.index')->with('rota', $uri);
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
}
