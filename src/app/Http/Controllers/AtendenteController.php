<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Hash;
use Auth;
use Validator;
use \qms\User;
use \qms\Models\Periodo;
use \qms\Models\Endereco;
use \qms\Models\Cidade;
use \qms\Models\Estado;
use \qms\Models\Telefone;
use \qms\Models\Paciente;
use \qms\Models\Especialidade;
use \qms\Models\Medico;
use \qms\Models\Consulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class AtendenteController extends Controller
{
  private $ativado = 0;

  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddleware::class');
  }

  public function index() {
    $total_pacientes = DB::table('pacientes')->count();
    $total_consultas = DB::table('consultas')->count();
    $total_especialidades = DB::table('especialidades')->count();
    $total_medicos = DB::table('medicos')->count();

    return view('atendente.index', ['pacientes' => $total_pacientes,
                                  'consultas' => $total_consultas,
                                  'especialidades' => $total_especialidades,
                                  'medicos' => $total_medicos]);
  }
  // public function acessoNegadoAtendente() {
  //   return view('atendente.erro-acesso-atendente');
  // }

  public function alterarSenha() {
    return view('atendente.alterar-senha');
  }

  public function updatePassword(Request $request) {
    $usuario = \Auth::user(); // resgata o usuario

    $senhaAtual = $request->input('senha_atual');
    $novaSenha = $request->input('nova_senha');
    $confirmaNovaSenha = $request->input('confirma_nova_senha');

    if ($senhaAtual != '') {
      if (! Hash::check($senhaAtual, Auth::user()->password)){
        //return "erro senha atual é diferente da senha do banco";
        return redirect('/atendente/alterar-senha')->withErrors(['password' => 'Senhas'])->withInput();
      } else {
        if ($novaSenha === $confirmaNovaSenha) {
          $tamanho = strlen($novaSenha);
          if ($tamanho >= 8) {

            if (Hash::check($novaSenha, Auth::user()->password)) {
              //return "nova senha igual a senha do banco de dados";
              return redirect('/atendente/alterar-senha')->withErrors(['equal-password' => 'Senhas'])->withInput();
            }
            $user = User::find($usuario->id);
            $dataAtual = date('Y-m-d');
            $qteAlteracao = $usuario->numero_alteracao_senha + 1;
            $user->data_alteracao_senha = $dataAtual;
            $user->numero_alteracao_senha = $qteAlteracao;

            $user->password = bcrypt($novaSenha); // muda a senha do seu usuario já criptografada pela função bcrypt
            $saved = $user->save();
            if ($saved) {
              //return "senha alterada com sucesso!";
              return Redirect::to('/atendente')->with('success', 'Senha alterada com sucesso');
            } else {
              //return "senha não salva no banco erro interno!";
              return redirect('/atendente/alterar-senha')->withErrors(['less-password' => 'Senhas'])->withInput();
            }
          } else {
            //return "tamnho da senha menor do 8!";
             return redirect('/atendente/alterar-senha')->withErrors(['min-password' => 'Senhas'])->withInput();
          }
        } else {
          //return "nova senha e confirma senha sao diferentes";
          return redirect('/atendente/alterar-senha')->withErrors(['password' => 'Senhas'])->withInput();
        }
      }
    } else {
    //  return "erro campo senha atual em branco!";
     return redirect('/atendente/alterar-senha')->withErrors(['less-password' => 'Senhas'])->withInput();
    }

  }

  public function perfilUsuario(Request $request) {
    $status = null;
    if ($request->session()->has('status')) {
      $status = $request->session()->get('status');
    }

    $endereco = Endereco::find(Auth::user()->endereco_id);
    $telefone = Telefone::find(Auth::user()->telefone_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    return view('atendente.perfil-usuario', compact('endereco', 'telefone', 'cidade', 'estado', 'status'));
  }

  public function alterProfile(Request $request) {
    $endereco_id = $request->endereco_id;
    $telefone_id = $request->telefone_id;
    $telefone_um = $request->telefone_um;
    $telefone_dois = $request->telefone_dois;
    $rua = strtoupper($request->rua);
    $numero = $request->numero;
    $bairro = strtoupper($request->bairro);
    $complemento = strtoupper($request->complemento);
    $nome_cidade = strtoupper($request->cidade);
    $nome_estado = strtoupper($request->estado);

    $endereco = Endereco::find($endereco_id);
    $telefone = Telefone::find($telefone_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    $telefone->telefone_um = $telefone_um;
    $telefone->telefone_dois = $telefone_dois;

    $endereco->rua = $rua;
    $endereco->numero = $numero;
    $endereco->bairro = $bairro;
    $endereco->complemento = $complemento;

    $cidade->nome_cidade = $nome_cidade;

    $estado->nome_estado = $nome_estado;

    if ($endereco->save() && $cidade->save() && $estado->save() && $telefone->save()) {
      $status = 1;
      return redirect()->action('AtendenteController@perfilUsuario')->with('status', $status);
    } else {
      $status = 2;
      return redirect()->action('AtendenteController@perfilUsuario')->with('status', $status);
    }

  }

  public function consultas(Request $request) {
    $especialidades = Especialidade::all();

    if ($request->session()->has('consultas')) {
      $especialidade_id = $request->session()->get('especialidade_id');
      $medico_id = $request->session()->get('medico_id');
      $periodo_id = $request->session()->get('periodo_id');

      $especialidade_atual = DB::table('especialidades')->where('id_especialidade', '=', $especialidade_id)->get()->first();
      $medico = DB::table('medicos')->where('id_medico', '=', $medico_id)->get()->first();
      $periodo = DB::table('periodos')->where('id_periodo', '=', $periodo_id)->get()->first();

      $consultas = $request->session()->get('consultas');
      return view('atendente.consultas', compact('especialidades', 'consultas', 'especialidade_atual', 'medico', 'periodo'));
    }
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('atendente.consultas', compact('especialidades', 'erro'));
    }

    return view('atendente.consultas', compact('especialidades'));
  }

  public function getMedicos($idEspecialidade) {
    $especialidade = Especialidade::where('id_especialidade', $idEspecialidade)->get()->first();
    $medicos = $especialidade->medicos;

    return Response::json($medicos);
  }

  public function getPeriodos($idEspecialidade, $idMedico) {
    $data_hoje = date('Y-m-d');

    $periodos = DB::table('periodos')
                     ->join('calendarios', 'periodos.calendario_id', '=', 'calendarios.id_calendario')
                     ->where('calendarios.data', '=', $data_hoje)
                     ->where('calendarios.especialidade_id', '=', $idEspecialidade)
                     ->where('calendarios.medico_id', '=', $idMedico)
                     ->get();

    return Response::json($periodos);
  }

  public function listarAtendimentos(Request $request) {
    if ($request->has('especialidade') && $request->has('medico') && $request->has('periodo')) {
      $data_hoje = date('Y-m-d');

      $consultas = DB::table('consultas')
                        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                        ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                        ->where('system_status', '=', $this->ativado)
                        ->where('calendarios.data', '=', $data_hoje)
                        ->where('consultas.especialidade_id', '=', $request->get('especialidade'))
                        ->where('consultas.medico_id', '=', $request->get('medico'))
                        ->where('consultas.periodo_id', '=', $request->get('periodo'))
                        ->orderBy('consultas.created_at', 'asc')
                        ->get();

      $request->session()->flash('especialidade_id', $request->get('especialidade'));
      $request->session()->flash('medico_id', $request->get('medico'));
      $request->session()->flash('periodo_id', $request->get('periodo'));
      $request->session()->flash('consultas', $consultas);
      return redirect('/atendente/consultas');
    }
    $request->session()->flash('erro', 'Campos obrigatórios não preenchidos!');
    return redirect('/atendente/consultas');
  }

  public function gerarPdf(Request $request) {
    $data_hoje = date('Y-m-d');

    $especialidade_id = $request->get('especialidade_num');
    $medico_id = $request->get('medico_num');
    $periodo_id = $request->get('periodo_num');

    if ($request->has('especialidade_num') && $request->has('medico_num') && $request->has('periodo_num')) {
      $especialidade = DB::table('especialidades')->where('id_especialidade', '=', $especialidade_id)->get()->first();
      $medico = DB::table('medicos')->where('id_medico', '=', $medico_id)->get()->first();
      $periodo = DB::table('periodos')->where('id_periodo', '=', $periodo_id)->get()->first();

      $consultas = DB::table('consultas')
                        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                        ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                        ->where('system_status', '=', $this->ativado)
                        ->where('calendarios.data', '=', $data_hoje)
                        ->where('consultas.especialidade_id', '=', $especialidade_id)
                        ->where('consultas.medico_id', '=', $medico_id)
                        ->where('consultas.periodo_id', '=', $periodo_id)
                        ->orderBy('consultas.created_at', 'asc')
                        ->get();

      $view = view('atendente.relatorio-pdf', compact('consultas', 'especialidade', 'medico', 'periodo'));
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view)->setPaper('a4', 'landscape');
      return $pdf->stream('consultas');
    } else {
      $request->session()->flash('erro', 'Erro ao gerar PDF!');
      return redirect('/atendente/consultas');
    }
  }

  public function status(Request $request) {
    $id_consulta = $request->id;
    $consulta = Consulta::where('id_consulta', $id_consulta)->get()->first();

    $result;

    if ($consulta != null) {

      $status = $consulta->status_atendimento;

      if ($status == 'true') {
        $consulta->status_atendimento = 'false';
      } else {
        $consulta->status_atendimento = 'true';
      }

      if ($consulta->save()) {
        $result = ['menssage' => 'success'];
      } else {
        $result = ['menssage' => 'error'];
      }

    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);
  }

  public function manualAtendente() {
    return view('atendente.manual-atendente');
  }

}
