<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{

  public function index() {
    return view('administrador.index');
  }

  public function cadastrarOperador() {
    return view('administrador.cadastrar-operador');
  }

  public function cadastrarMedico() {
    return view('administrador.cadastrar-medico');
  }

  public function alterarMedico() {
    return 'Essa pagina ainda não foi criada, se está achando ruim faça ela';
  }

  public function removerOperador() {
    return view('administrador.remover-operador');
  }

  public function removerMedico() {
    return view('administrador.remover-medico');
  }

  public function cadastrarHorario() {
    return view('administrador.cadastrar-horario');
  }

  public function manual() {
    return view('sistema.manual-administrador');
  }

  public function perfilUsuario() {
    return view('administrador.perfil-usuario');
  }

  public function alterarUsuario() {
    return view('administrador.alterar-dados-usuario');
  }

  public function alterarSenhaUsuario() {
    return view('administrador.alterar-senha-usuario');
  }
}
