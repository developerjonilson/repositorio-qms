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
  private $totalPage = 4;
  private $ativado = 0;
  private $desativado = 1;

  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddleware::class');
  }

  public function agendarConsulta(Request $request, $idPaciente = null) {

    if ($request->session()->has('sucesso')) {
      $sucesso = $request->session()->get('sucesso');
      $idPaciente = $request->session()->get('idPaciente');

      $paciente = Paciente::where('id_paciente', $idPaciente)->first();
      $especialidades = Especialidade::all();
      return view('consulta.agendar-consulta', ['paciente' => $paciente, 'especialidades' => $especialidades, 'sucesso' => $sucesso]);
    } else {
      if ($request->session()->has('erro')) {
        $erro = $request->session()->get('erro');
        //return $erro;
        if ($idPaciente != null) {
          $paciente = Paciente::where('id_paciente', $idPaciente)->first();
          $especialidades = Especialidade::all();
          return view('consulta.agendar-consulta', ['paciente' => $paciente, 'especialidades' => $especialidades, 'erro' => $erro]);
        }
      } else {
        if ($idPaciente != null) {
          $paciente = Paciente::where('id_paciente', $idPaciente)->first();
          $especialidades = Especialidade::all();
          return view('consulta.agendar-consulta', ['paciente' => $paciente, 'especialidades' => $especialidades]);
        } else {
          return view('consulta.agendar-consulta');
        }
      }
    }

  }

  public function pacienteParaAgendarConsulta(Request $request) {
    //busca e mostra o paciente_id:
    $id_paciente = $request->input('paciente_id');
    $paciente = Paciente::where('id_paciente', $id_paciente)->first();

    $especialidades = Especialidade::all();

    return redirect('operador/agendar-consulta')
    ->with('paciente', $paciente)->with('especialidades', $especialidades);
  }

  public function getMedicos($idEspecialidade) {
    $especialidade = Especialidade::where('id_especialidade', $idEspecialidade)->get()->first();
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

    return Response::json($calendarios);
  }

  public function getPeriodos($idCaleandario) {
    $periodos = DB::table('periodos')
                            ->where('calendario_id', '=', $idCaleandario)
                            ->get();

    return Response::json($periodos);
  }

  public function getVagas($idPeriodo) {
    $vagas = Periodo::where('id_periodo', $idPeriodo)->get()->first();

    return Response::json($vagas);
  }

  public function getLocal($idPeriodo) {
    $vagas = Periodo::where('id_periodo', $idPeriodo)->get()->first();
    $local = DB::table('locals')->where('id_local', '=', $vagas->local_id)
                                ->get()->first();

    return Response::json($local);
  }

  public function agendandoConsulta(Request $request) {

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
                                                   ->where('system_status', '=', $this->ativado)
                                                   ->get()->first();

            if ($consultaBanco != null) {
              //erro consulta já foi agendada:
              return redirect('operador/agendar-consulta/'.$id_paciente)->with('erro', '2');
            } else {
              $calendario = Calendario::where('id_calendario', $id_data_consulta)->get()->first();
              $periodo = Periodo::where('id_periodo', $id_periodo)->get()->first();

              $consultaMesmoPeriodo = DB::table('consultas')
                                        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                        ->select('consultas.*', 'periodos.*', 'pacientes.*')
                                        ->where('calendarios.data', '=', $calendario->data)
                                        ->where('periodos.nome', '=', $periodo->nome)
                                        ->where('pacientes.id_paciente', '=', $id_paciente)
                                        ->where('consultas.system_status', '=', $this->ativado)
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

                $periodo = Periodo::where('id_periodo', $id_periodo)->get()->first();
                $vagas_atuais = $periodo->vagas_disponiveis;
                if ($vagas_atuais > 0) {
                  $novo_numero_vagas = $vagas_atuais - 1;
                  $periodo->vagas_disponiveis = $novo_numero_vagas;

                  //$status = true;
                  $ConsultasAgendadasBanco = Consulta::all();
                  $codigo = $ConsultasAgendadasBanco->count();
                  $codigoProximaConsulta = 0;
                  if ($codigo == 0) {
                    $codigoProximaConsulta = 171;
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
                                                      ->where('consultas.system_status', '=', $this->ativado)
                                                      ->get()->first();

                    return redirect()->action('ConsultaController@sucessoAgendamentoConsulta', $consultaSalva->id_consulta);
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

  public function listagemConsultas(Request $request) {
    if ($request->session()->has('falha')) {
      $falha = $request->session()->get('falha');

      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
          ->where('consultas.system_status', '=', $this->ativado)
          ->orderBy('consultas.created_at', 'desc')
          ->paginate($this->totalPage);

      $especialidades = Especialidade::all();
      return view('consulta.listagem-consultas', compact('consultas', 'especialidades', 'falha'));
    }

    if ($request->session()->has('sucesso')) {
      $sucesso = $request->session()->get('sucesso');

      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
          ->where('consultas.system_status', '=', $this->ativado)
          ->orderBy('consultas.created_at', 'desc')
          ->paginate($this->totalPage);

      $especialidades = Especialidade::all();
      return view('consulta.listagem-consultas', compact('consultas', 'especialidades', 'sucesso'));
    }

    if ($request->session()->has('consultas') && $request->session()->has('especialidades')) {
      $consultas = $request->session()->get('consultas');
      $especialidades = $request->session()->get('especialidades');

      return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
    } else {
      $consultas = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
          ->where('consultas.system_status', '=', $this->ativado)
          ->orderBy('consultas.created_at', 'desc')
          ->paginate($this->totalPage);

      $especialidades = Especialidade::all();

      if ($request->session()->has('erro')) {
        $erro = $request->session()->get('erro');
        $consultas->withPath('/operador/listagem-consultas');
        return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades], ['erro' => $erro]);
      } else {
        if ($request->session()->has('sucesso')) {
          $sucesso = $request->session()->get('sucesso');
          $consultas->withPath('/operador/listagem-consultas');
          return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades], ['sucesso' => $sucesso]);
        } else {
          $consultas->withPath('/operador/listagem-consultas');
          return view('consulta.listagem-consultas', ['consultas' => $consultas], ['especialidades' => $especialidades]);
        }
      }
    }
  }

  public function verConsulta(Request $request, $idConsulta) {
    $consulta = DB::table('consultas')
        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
        ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
        ->where('consultas.codigo_consulta', '=', $idConsulta)->get()->first();
    $request->session()->reflash();
    return view('consulta.ver-consulta', ['consulta' => $consulta]);
  }

  public function filtrarConsultas(Request $request) {
    if ($request->session()->has('id_data_consulta') && $request->session()->has('id_periodo')
        && $request->session()->has('id_especialidade') && $request->session()->has('id_medico')) {

      $id_data_consulta = $request->session()->get('id_data_consulta');
      $id_periodo = $request->session()->get('id_periodo');
      $id_especialidade = $request->session()->get('id_especialidade');
      $id_medico = $request->session()->get('id_medico');

      $consultas = DB::table('consultas')->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                         ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                         ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                         ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                         ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                         ->where('consultas.calendario_id', '=', $id_data_consulta)
                                         ->where('consultas.periodo_id', '=', $id_periodo)
                                         ->where('consultas.especialidade_id', '=', $id_especialidade)
                                         ->where('consultas.medico_id', '=', $id_medico)
                                         ->where('consultas.system_status', '=', $this->ativado)
                                         ->orderBy('calendarios.data', 'desc')
                                         ->paginate($this->totalPage);

      $request->session()->reflash();
      $consultas->withPath('/operador/filtrar-consultas');
      return view('consulta.filtragem-consultas', ['consultas' => $consultas]);

    } else {
      if (isset($request->numero_cns)) {
        $numero_cns = $request->numero_cns;
        $consultas = DB::table('consultas')->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                           ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                           ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                           ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                           ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                           ->where('pacientes.numero_cns', '=', $numero_cns)
                                           ->where('consultas.system_status', '=', $this->ativado)
                                           ->orderBy('calendarios.data', 'desc')
                                           ->paginate($this->totalPage);

        $request->session()->flash('numero_cns', $numero_cns);
        $consultas->withPath('/operador/filtrar-consultas');
        return view('consulta.filtragem-consultas', ['consultas' => $consultas]);

      } else {
        if ($request->session()->has('numero_cns')) {
          $numero_cns = $request->session()->get('numero_cns');

          $consultas = DB::table('consultas')->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                             ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                             ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                             ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                             ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                             ->where('pacientes.numero_cns', '=', $numero_cns)
                                             ->where('consultas.system_status', '=', $this->ativado)
                                             ->orderBy('calendarios.data', 'desc')
                                             ->paginate($this->totalPage);

          $request->session()->reflash();
          $consultas->withPath('/operador/filtrar-consultas');
          return view('consulta.filtragem-consultas', ['consultas' => $consultas]);

        } else {
          $id_data_consulta = $request->data_consulta;
          $id_periodo = $request->periodo;
          $id_especialidade = $request->especialidade;
          $id_medico =  $request->medico;

          $consultas = DB::table('consultas')->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                             ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                             ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                             ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                             ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                             ->where('consultas.calendario_id', '=', $id_data_consulta)
                                             ->where('consultas.periodo_id', '=', $id_periodo)
                                             ->where('consultas.especialidade_id', '=', $id_especialidade)
                                             ->where('consultas.medico_id', '=', $id_medico)
                                             ->where('consultas.system_status', '=', $this->ativado)
                                             ->orderBy('calendarios.data', 'desc')
                                             ->paginate($this->totalPage);

          $request->session()->flash('id_data_consulta', $id_data_consulta);
          $request->session()->flash('id_periodo', $id_periodo);
          $request->session()->flash('id_especialidade', $id_especialidade);
          $request->session()->flash('id_medico', $id_medico);

          $consultas->withPath('/operador/filtrar-consultas');
          return view('consulta.filtragem-consultas', ['consultas' => $consultas]);
        }

      }

    }
  }

  public function gerarPdf(Request $request, $codigo = null) {
    if ($codigo != null) {
      $consulta = DB::table('consultas')
          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
          ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
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

  public function cancelarAgendamentoConsulta(Request $request) {
    if ($request->id_consulta != null) {
      $codigo = $request->id_consulta;

     $consulta = Consulta::where('codigo_consulta', $codigo)->first();

     $consulta->system_status = $this->desativado;

     $periodo = Periodo::where('id_periodo', $consulta->periodo_id)->first();
     $vagas_atuais = $periodo->vagas_disponiveis;
     $total_consultas = $periodo->total_consultas;

      if ($vagas_atuais <= $total_consultas) {
        $novo_numero_vagas = $vagas_atuais + 1;
        $periodo->vagas_disponiveis = $novo_numero_vagas;

        // dd($consulta, $periodo);

        $status = false;
        try {
          $consulta->save();
          $periodo->save();
          $status = true;
        } catch (Exception $e) {
          $e;
        }

        if ($status) {
          $request->session()->flash('sucesso', 'Agendamento cancelado com sucesso!');
          return redirect()->action('ConsultaController@listagemConsultas');
        } else {
          $request->session()->flash('falha', 'Não foi possível realizar o cancelamento do agendamento, por favor tente em instantes!');
          return redirect()->action('ConsultaController@listagemConsultas');
        }
      }
    } else {
      $request->session()->flash('falha', 'Não foi possível realizar o cancelamento do agendamento, por favor tente em instantes!');
      return redirect()->action('ConsultaController@listagemConsultas');
    }


  }

}
