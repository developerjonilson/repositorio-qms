<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use \qms\Models\Paciente;
use \qms\Models\Endereco;
use \qms\Models\Cidade;
use \qms\Models\Estado;
use \qms\Models\Telefone;
use \qms\Models\Local;
use \qms\Models\Especialidade;
use \qms\Models\Medico;
use \qms\Models\Calendario;
use \qms\Models\Periodo;
use \qms\Models\Consulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ConsultaController extends Controller {

  private $medicoModel;
  private $totalPage = 2;

  public function __construct() {
      $this->middleware('auth');
  }

  public function agendarConsulta(Request $request, $idPaciente = null) {

    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      //return $erro;
      if ($idPaciente != null) {
        $paciente = Paciente::where('id', $idPaciente)->first();
        $especialidades = Especialidade::all();
        return view('consulta.agendar-consulta', ['paciente' => $paciente, 'especialidades' => $especialidades, 'erro' => $erro]);
      }
    } else {
      if ($idPaciente != null) {
        $paciente = Paciente::where('id', $idPaciente)->first();
        $especialidades = Especialidade::all();
        return view('consulta.agendar-consulta', ['paciente' => $paciente, 'especialidades' => $especialidades]);
      } else {
        return view('consulta.agendar-consulta');
      }
    }

  }

  public function pacienteParaAgendarConsulta(Request $request) {
    //busca e mostra o paciente_id:
    $id_paciente = $request->input('paciente_id');
    $paciente = Paciente::where('id', $id_paciente)->first();

    $especialidades = Especialidade::all();

    return redirect('operador/agendar-consulta')
    ->with('paciente', $paciente)->with('especialidades', $especialidades);
  }

  public function getMedicos($idEspecialidade) {
    $especialidade = Especialidade::where('id', $idEspecialidade)->get()->first();
    $medicos = $especialidade->medicos;

    return Response::json($medicos);
  }

  public function getDataAtendimento($idEspecialidade, $idMedico) {
    $dataAtual = date('Y-m-d');
    $calendarios = DB::table('calendarios')
                            ->where('especialidade_id', '=', $idEspecialidade)
                            ->where('medico_id', '=', $idMedico)
                            ->where('data', '>=', $dataAtual)
                            ->get();
    //dd($calendarios);
    return Response::json($calendarios);
  }

  public function getPeriodos($idCaleandario) {
    $periodos = DB::table('periodos')
                            ->where('calendario_id', '=', $idCaleandario)
                            ->get();
    //dd($periodos);
    return Response::json($periodos);
  }

  public function getVagas($idPeriodo) {
    $vagas = Periodo::where('id', $idPeriodo)->get()->first();
    //dd($vagas);
    return Response::json($vagas);
  }

  public function getLocal($idPeriodo) {
    $vagas = Periodo::where('id', $idPeriodo)->get()->first();
    $local = DB::table('locals')->where('id', '=', $vagas->local_id)
                                ->get()->first();

    return Response::json($local);
  }

  public function agendandoConsulta(Request $request) {
  //  $variaveis = $request->all();
//    dd($variaveis);
    $id_data_consulta = $request->input('data_consulta');
    $id_periodo = $request->input('periodo');
    $id_paciente = $request->input('paciente_id');
    $id_especialidade = $request->input('especialidade');
    $id_medico = $request->input('medico');
    $id_local = $request->input('local_id');

    if ($id_especialidade != null) {
      if ($id_medico != null) {
        if ($id_data_consulta != null) {
          if ($id_periodo != null) {

            $consultaBanco = DB::table('consultas')->where('calendario_id', '=', $id_data_consulta)
                                                   ->where('periodo_id', '=', $id_periodo)
                                                   ->where('paciente_id', '=', $id_paciente)
                                                   ->where('especialidade_id', '=', $id_especialidade)
                                                   ->where('medico_id', '=', $id_medico)
                                                   ->where('local_id', '=', $id_local)
                                                   ->get()->first();

            if ($consultaBanco != null) {
              //erro consulta já foi agendada:
              return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '2');
            } else {
              $calendario = Calendario::where('id', $id_data_consulta)->get()->first();
              $periodo = Periodo::where('id', $id_periodo)->get()->first();

              $consultaMesmoPeriodo = DB::table('consultas')
                  ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
                  ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
                  ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
                      ->select('consultas.*', 'periodos.*', 'pacientes.*')
                          ->where('calendarios.data', '=', $calendario->data)
                          ->where('periodos.nome', '=', $periodo->nome)
                          ->where('pacientes.id', '=', $id_paciente)
                              ->first();

              if ($consultaMesmoPeriodo != null) {
                //erro : o paciente já tem alguma consulta agendada para esse dia e esse periodo:
                return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '2');
              } else {
                $consulta = new Consulta();
                $consulta->calendario_id = $id_data_consulta;
                $consulta->periodo_id = $id_periodo;
                $consulta->paciente_id = $id_paciente;
                $consulta->especialidade_id = $id_especialidade;
                $consulta->medico_id = $id_medico;
                $consulta->local_id = $id_local;

                $periodo = Periodo::where('id', $id_periodo)->get()->first();
                $vagas_atuais = $periodo->vagas_disponiveis;
                if ($vagas_atuais > 0) {
                  $novo_numero_vagas = $vagas_atuais - 1;
                  $periodo->vagas_disponiveis = $novo_numero_vagas;

                  //$status = true;
                  $ConsultasAgendadasBanco = Consulta::all();
                  $codigo = $ConsultasAgendadasBanco->count();
                  $codigoProximaConsulta = 0;
                  if ($codigo == 0) {
                    $codigoProximaConsulta = 20171;
                  } else {
                    $ultimoCodigo = $ConsultasAgendadasBanco->last();
                    $codigoProximaConsulta = $ultimoCodigo->codigo_consulta + 1;
                  }
                  $consulta->codigo_consulta = $codigoProximaConsulta;

                  $status = false;
                  try {
                    $consulta->save();
                    $periodo->save();
                    $status = true;
                  } catch (Exception $e) {
                    $e;
                  }

                  if ($status) {
                    $consultaSalva = DB::table('consultas')->where('calendario_id', $id_data_consulta)
                                                      ->where('periodo_id', $id_periodo)
                                                      ->where('paciente_id', $id_paciente)
                                                      ->where('especialidade_id', $id_especialidade)
                                                      ->where('medico_id', $id_medico)
                                                      ->where('local_id', $id_local)
                                                      ->get()->first();

                    return redirect()->action('ConsultaController@sucessoAgendamentoConsulta', $consultaSalva->id);
                  } else {
                    //erro ao agendar a consulta:
                    return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '4');
                  }

                } else {
                  #erro  não tem mais vagas disponiveis
                  return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '3');
                }

              }

            }

          } else {
            return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '1');
          }
        } else {
          return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '1');
        }
      } else {
        return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '1');
      }
    } else {
      return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '1');
    }


  }

  public function sucessoAgendamentoConsulta($idConsulta = null) {
    if ($idConsulta != null) {
      $consulta = Consulta::find($idConsulta);
      $calendario = Calendario::find($consulta->calendario_id);
      $periodo = Periodo::find($consulta->periodo_id);
      $paciente = Paciente::find($consulta->paciente_id);
      $especialidade = Especialidade::find($consulta->especialidade_id);
      $medico = Medico::find($consulta->medico_id);
      $local = Local::find($consulta->local_id);


      return view('consulta.consulta-agendada', ['calendario' => $calendario,
                                                'periodo' => $periodo,
                                                'paciente' => $paciente,
                                                'especialidade' => $especialidade,
                                                'medico' => $medico,
                                                'local' => $local,
                                                'consulta' => $consulta]);
    } else {
      return view('consulta.consulta-agendada');
    }


  }


  public function alterarConsulta() {
    return view('consulta.alterar-consulta');
  }

  public function listagemConsultas(Request $request) {
    if ($request->session()->has('consultas') && $request->session()->has('especialidades')) {
      $consultas = $request->session()->get('consultas');
      $especialidades = $request->session()->get('especialidades');

      return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
    } else {
      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
          ->orderBy('consultas.created_at', 'desc')
          ->paginate($this->totalPage);

      $especialidades = Especialidade::all();

      $consultas->withPath('/operador/listagem-consultas');
      return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
    }
  }

  public function buscarConsulta(Request $request) {
    $numero_cns = $request->numero_cns;

    if ($numero_cns != null) {
      $request->session()->flash('numero_cns', $numero_cns);

      $paciente = Paciente::where('numero_cns', $numero_cns)->get()->first();

      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
          ->where('pacientes.numero_cns', '=', $numero_cns)
          ->orderBy('consultas.created_at', 'desc')
          ->paginate($this->totalPage);

      $consultas->withPath('/operador/buscar-consulta');
      return view('consulta.buscar-consulta', ['consultas' => $consultas], ['paciente' => $paciente]);

    } else {
      if ($request->session()->has('numero_cns')) {
        $numero_cns = $request->session()->get('numero_cns');

        $paciente = Paciente::where('numero_cns', $numero_cns)->get()->first();

        $consultas = DB::table('consultas')
            ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
            ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->where('pacientes.numero_cns', '=', $numero_cns)
            ->orderBy('consultas.created_at', 'desc')
            ->paginate($this->totalPage);
        $request->session()->reflash();
        $consultas->withPath('/operador/buscar-consulta');
        return view('consulta.buscar-consulta', ['consultas' => $consultas], ['paciente' => $paciente]);
      } else {
        return view('consulta.buscar-consulta');
      }
    }


  }

  public function buscarUmaConsulta(Request $request, $idConsulta) {
    $consulta = DB::table('consultas')
        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
        ->join('locals', 'consultas.local_id', '=', 'locals.id')
        ->where('consultas.codigo_consulta', '=', $idConsulta)->get()->first();
    $request->session()->reflash();
    return view('consulta.ver-consulta', ['consulta' => $consulta]);
  }

  public function buscarUmaConsultaDois(Request $request, $idConsulta) {
    $consulta = DB::table('consultas')
        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
        ->join('locals', 'consultas.local_id', '=', 'locals.id')
        ->where('consultas.codigo_consulta', '=', $idConsulta)->get()->first();
    $request->session()->reflash();
    return view('consulta.ver-consulta2', ['consulta' => $consulta]);
  }

  public function filtrarConsultas($especialidade, $data) {
    // if ($request->session()->has('consultas') && $request->session()->has('especialidades')) {
    //   $consultas = $request->session()->get('consultas');
    //   $especialidades = $request->session()->get('especialidades');
    //   // $request->session()->reflash();
    //   $consultas->withPath('/operador/filtrar-consultas');
    //   return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
    // } else {
      // $idEspecialidade = $request->especialidade;
      // $data = $request->data;

      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
          ->where('consultas.especialidade_id', '=', $especialidade)
          ->where('calendarios.data', '=', $data)
          ->orderBy('calendarios.data', 'desc')
          ->paginate($this->totalPage);

      $especialidades = Especialidade::all();

      // $request->session()->flash('consultas', $consultas);
      // $request->session()->flash('especialidades', $especialidades);

      $consultas->withPath('/operador/filtrar-consultas');
      return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
    // }

  }

  public function gerarPdf(Request $request, $codigo = null) {
    if ($codigo != null) {
      $consulta = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
          ->join('locals', 'consultas.local_id', '=', 'locals.id')
          ->where('consultas.codigo_consulta', '=', $codigo)
          ->get()
          ->first();

      $request->session()->reflash();

      $view = view('consulta.consulta-pdf', compact('consulta'));
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('consulta');

    }
  }

}
