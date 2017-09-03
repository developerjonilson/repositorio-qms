<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
  public function cadastrarPaciente(Request $request) {
    $uri = $request->path();
    return view('paciente.cadastrar-paciente')->with('rota', $uri);
  }

  public function buscarPaciente(Request $request) {
    $uri = $request->path();
    return view('paciente.buscar-paciente')->with('rota', $uri);
  }
}
