<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Hash;
use Auth;
use Validator;
use \qms\User;
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

  public function acessoNegadoAtendente() {
    return view('atendente.erro-acesso-atendente'); 
  }

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

    return view('atendente.perfil-usuario')->with(compact('endereco', 'telefone', 'cidade', 'estado', 'status'));
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

  public function manualAtendente() {
    return view('atendente.manual-atendente');
  }

}
