<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use \qms\Paciente;
use \qms\Endereco;
use \qms\Cidade;
use \qms\Estado;
use \qms\Telefone;
use \qms\Local;
use \qms\Especialidade;
use \qms\Medico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

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

  public function pacienteParaAgendarConsulta(Request $request) {
    //busca e mostra o paciente_id:
    $id_paciente = $request->input('paciente_id');
    $paciente = Paciente::where('id', $id_paciente)->first();

    $especialidades = Especialidade::all();
    //$especialidades = $especialidadesBanco->toArray();

    //$especialidadesSession->session()->flash('especialidades', $especialidades);

    return redirect('operador/agendar-consulta')
    ->with('paciente', $paciente)->with('especialidades', $especialidades);
    //return view('consulta.agendar-consulta', ['paciente'=>$paciente, 'especialidades'=>$especialidades]);

  }

  public function getMedicos($idEspecialidade) {
    //$medicos =
    return Response::json($medicos);
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
