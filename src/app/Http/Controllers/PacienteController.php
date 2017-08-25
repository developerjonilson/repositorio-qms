<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
  public function cadastrarPaciente() {
    return view('paciente.cadastrar-paciente');
  }

  public function buscarPaciente() {
    return view('paciente.buscar-paciente');
  }
}
