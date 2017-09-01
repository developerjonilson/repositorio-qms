<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
  public function buscarConsulta(Request $request) {
    $uri = $request->path();
    return view('consulta.buscar-consulta')->with('rota', $uri);
  }

  public function agendarConsulta(Request $request) {
    $uri = $request->path();
    return view('consulta.agendar-consulta')->with('rota', $uri);
  }

  public function alterarConsulta() {
    return view('consulta.alterar-consulta');
  }

  public function relatorioDiario(Request $request) {
    $uri = $request->path();
    return view('consulta.relatorio-diario')->with('rota', $uri);
  }

  public function relatorioMensal(Request $request) {
    $uri = $request->path();
    return view('consulta.relatorio-mensal')->with('rota', $uri);
  }

  public function relatorioPersonalizado(Request $request) {
    $uri = $request->path();
    return view('consulta.relatorio-personalizado')->with('rota', $uri);
  }
}
