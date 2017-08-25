<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
  public function buscarConsulta() {
    return view('consulta.buscar-consulta');
  }

  public function agendarConsulta() {
    return view('consulta.agendar-consulta');
  }

  public function alterarConsulta() {
    return view('consulta.alterar-consulta');
  }

  public function relatorioDiario() {
    return view('consulta.relatorio-diario');
  }

  public function relatorioMensal() {
    return view('consulta.relatorio-mensal');
  }

  public function relatorioPersonalizado() {
    return view('consulta.relatorio-personalizado');
  }
}
