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

class AdministradorController extends Controller {

  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddleware::class');
  }

  public function index() {
    return view('administrador.index');
  }

  public function acessoNegadoAdministrador() {
    return view('administrador.admin.erro-acesso-administrador');
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

    return view('administrador.admin.perfil-usuario')->with(compact('endereco', 'telefone', 'cidade', 'estado', 'status'));
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
      return redirect()->action('AdministradorController@perfilUsuario')->with('status', $status);
    } else {
      $status = 2;
      return redirect()->action('AdministradorController@perfilUsuario')->with('status', $status);
    }

  }

  public function alterarSenha() {
    return view('administrador.admin.alterar-senha');
  }

  public function updatePassword(Request $request) {
    $usuario = \Auth::user(); // resgata o usuario

    $senhaAtual = $request->input('senha_atual');
    $novaSenha = $request->input('nova_senha');
    $confirmaNovaSenha = $request->input('confirma_nova_senha');

    if ($senhaAtual != '') {
      if (! Hash::check($senhaAtual, Auth::user()->password)){
        //return "erro senha atual é diferente da senha do banco";
        return redirect('/administrador/alterar-senha')->withErrors(['password' => 'Senhas'])->withInput();
      } else {
        if ($novaSenha === $confirmaNovaSenha) {
          $tamanho = strlen($novaSenha);
          if ($tamanho >= 8) {

            if (Hash::check($novaSenha, Auth::user()->password)) {
              //return "nova senha igual a senha do banco de dados";
              return redirect('/administrador/alterar-senha')->withErrors(['equal-password' => 'Senhas'])->withInput();
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
              return Redirect::to('/administrador')->with('success', 'Senha alterada com sucesso');
            } else {
              //return "senha não salva no banco erro interno!";
              return redirect('/administrador/alterar-senha')->withErrors(['less-password' => 'Senhas'])->withInput();
            }
          } else {
            //return "tamnho da senha menor do 8!";
             return redirect('/administrador/alterar-senha')->withErrors(['min-password' => 'Senhas'])->withInput();
          }
        } else {
          //return "nova senha e confirma senha sao diferentes";
          return redirect('/administrador/alterar-senha')->withErrors(['password' => 'Senhas'])->withInput();
        }
      }
    } else {
    //  return "erro campo senha atual em branco!";
     return redirect('/administrador/alterar-senha')->withErrors(['less-password' => 'Senhas'])->withInput();
    }

  }

  public function operadores() {
    return view('administrador.operador.operadores');
  }

  public function cadastrarOperador() {
    return view('administrador.operador.cadastrar-operador');
  }

  public function cadastrarMedico() {
    return view('administrador.cadastrar-medico');
  }

  public function alterarMedico() {
    return 'Essa pagina ainda não foi criada, se está achando ruim faça ela';
  }

  public function removerOperador() {
    return view('administrador.remover-operador');
  }

  public function removerMedico() {
    return view('administrador.remover-medico');
  }

  public function cadastrarHorario() {
    return view('administrador.cadastrar-horario');
  }

  public function manualAdministrador() {
    return view('administrador.manual-administrador');
  }

}
