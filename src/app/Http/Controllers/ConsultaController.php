<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use \qms\Paciente;
use \qms\Endereco;
use \qms\Cidade;
use \qms\Estado;
use \qms\Telefone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ConsultaController extends Controller {

  public function __construct() {
      $this->middleware('auth');
  }

  public function buscarConsulta(Request $request) {
    $uri = $request->path();
    return view('consulta.buscar-consulta')->with('rota', $uri);
  }

  public function agendarConsulta() {
    return view('consulta.agendar-consulta');
  }

  public function agendamentoConsulta(Request $request) {
    $id_paciente = $request->input('paciente_id');

    //$paciente = DB::table()
    $paciente = Paciente::where('id', $id_paciente)->first();

    return redirect('operador/agendar-consulta')->with('paciente', $paciente);

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
