<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class OperadorController extends Controller
{
  public function index() {
    return view('operador.index');
  }

  public function cadastrarPaciente() {
    return view('paciente.cadastrar-paciente');
  }

  public function buscarPaciente() {
    return view('paciente.buscar-paciente');
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
