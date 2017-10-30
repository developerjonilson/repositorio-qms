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
use Yajra\DataTables\Facades\DataTables;

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

  public function operadores(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.operador.operadores', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.operador.operadores', compact('sucesso'));
      } else {
        return view('administrador.operador.operadores');
      }
    }
  }

  public function getOperador() {
    $users = User::select(['id', 'name', 'email'])->where('tipo', '=', 'operador');

    return Datatables::of($users)->addColumn('action', function($user) {
      // return '<button type="button" id="ver" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal_ver_operador" value="'.$user->id.'" onclick="alert(this.value)"><i class="fa fa-eye"></i> Ver</button>   '.
      return '<button type="button" id="ver" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal_ver_operador" value="'.$user->id.'" onclick="verOperador(this.value)"><i class="fa fa-eye"></i> Ver</button>   '.
             '<button type="button" id="editar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_editar_operador" value="'.$user->id.'" onclick="operadorParaEditar(this.value)"><i class="fa fa-pencil-square-o"></i> Editar</button>   '.
              '<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Excluir</a>';
    })->make(true);
  }

  public function verOperador($id) {
    $operador = DB::table('users')
        ->join('enderecos', 'users.endereco_id', '=', 'enderecos.id')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id')
        ->join('telefones', 'users.telefone_id', '=', 'telefones.id')
        ->select('users.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('users.id', '=', $id)
        ->get()
        ->first();

    return Response::json($operador);
  }

  public static function validaCpf($cpf = null) {
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $valor = trim($cpf);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(".", "", $valor);
    $cpf = str_replace("-", "", $valor);
    // $cpf = preg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {
          for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
          }

          return true;
        }
      }


  public function cadastrarOperador(Request $request) {
    if ($request->name != null && $request->data_nascimento != null &&
      $request->cpf != null && $request->rg != null &&
      $request->email != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null && $request->telefone_um != null) {

      $data = $request->data_nascimento;
      // Separa em dia, mês e ano
      list($ano, $mes, $dia,) = explode('-', $data);
      // Descobre que dia é hoje e retorna a unix timestamp
      $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      // Descobre a unix timestamp da data de nascimento do fulano
      $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
      // Depois apenas fazemos o cálculo já citado :)
      $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
      // dd($idade);

      if ($idade < 18) {
        $request->session()->flash('erro', 'O Operador não pode ser menor (não tem 18 anos),
                                        por favor verifique a data informada!');

        return redirect('/administrador/operadores')->withInput();
      }

      $validacaoCpf = AdministradorController::validaCpf($request->cpf);

      if (!$validacaoCpf) {
        $request->session()->flash('erro', 'O CPF informado é inválido!');
        return redirect('/administrador/operadores')->withInput();
      }

      $valor = trim($request->cpf);
      $valor = str_replace(".", "", $valor);
      $valor = str_replace(".", "", $valor);
      $cpf = str_replace("-", "", $valor);
      $operadorBancoCpf = User::where('cpf', $cpf)->first();
      if ($operadorBancoCpf != null) {
        $request->session()->flash('erro', 'Esse CPF já está cadastrado!');
        return redirect('/administrador/operadores')->withInput();
      }
      $operadorBancoRg = User::where('rg', $request->rg)->first();
      if ($operadorBancoRg != null) {
        $request->session()->flash('erro', 'Esse RG já está cadastrado!');
        return redirect('/administrador/operadores')->withInput();
      }
      $operadorBancoEmail = User::where('email', $request->email)->first();
      if ($operadorBancoEmail != null) {
        $request->session()->flash('erro', 'Esse Email já está cadastrado!');
        return redirect('/administrador/operadores')->withInput();
      }

      $valor = trim($request->cep);
      $cep = str_replace("-", "", $valor);

      $valor = trim($request->telefone_um);
      $valor = str_replace("(", "", $valor);
      $valor = str_replace(")", "", $valor);
      $valor = str_replace(" ", "", $valor);
      $telefone_um = str_replace("-", "", $valor);

      $telefone_dois = trim($request->telefone_dois);
      $telefone_dois = str_replace("(", "", $telefone_dois);
      $telefone_dois = str_replace(")", "", $telefone_dois);
      $telefone_dois = str_replace(" ", "", $telefone_dois);
      $telefone_dois = str_replace("-", "", $telefone_dois);

      $telefone = Telefone::create(['telefone_um' => $telefone_um,
                                      'telefone_dois' => $telefone_dois, ]);


      $user = new User();
      $user->name = $request->name;
      $user->data_nascimento = $request->data_nascimento;
      $user->cpf = $cpf;
      $user->rg = $request->rg;
      $user->email = $request->email;
      $user->password = bcrypt('QMS12345678');
      $user->tipo = 'operador';
      $user->numero_alteracao_senha = 0;
      $user->data_alteracao_senha = date('Y-m-d');
      $user->telefone_id = $telefone->id;

      $estado = Estado::create($request->all());
      $cidade = new Cidade($request->all());
      $cidade->estado_id = $estado->id;

      $cidadeCreate = Cidade::create(['nome_cidade' => $cidade->nome_cidade,
                                      'cep' => $cep,
                                      'estado_id' => $cidade->estado_id, ]);
      $endereco = new Endereco($request->all());

      $endereco->cidade_id = $cidadeCreate->id;

      $enderecoCreate = Endereco::create(['rua' => $endereco->rua,
                                      'numero' => $endereco->numero,
                                      'complemento' => $endereco->complemento,
                                      'bairro' => $endereco->bairro,
                                      'cidade_id' => $endereco->cidade_id, ]);
      $user->endereco_id = $enderecoCreate->id;

      if ($user->save()) {
        $request->session()->flash('sucesso', '  Cadastro realizado com sucesso!');
        return redirect('/administrador/operadores');
      } else {
        $request->session()->flash('erro', 'Erro inesperado, por favor tente em instantes!');
        return redirect('/administrador/operadores')->withInput();
      }


    } else {
      $request->session()->flash('erro', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/operadores')->withInput();
    }

  }

  public function editarOperador(Request $request) {
    dd($request->all());
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
