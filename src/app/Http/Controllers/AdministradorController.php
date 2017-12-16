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
use \qms\Models\Periodo;
use \qms\Models\Calendario;
use \qms\Models\Local;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AdministradorController extends Controller {

  private $ativado = 0;

  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddleware::class');
  }

  public function index() {
    $total_atendentes = DB::table('users')->where('tipo', 'atendente')->count();
    $total_operadores = DB::table('users')->where('tipo', 'operador')->count();
    $total_medicos = DB::table('medicos')->count();
    $total_calendarios = DB::table('calendarios')->count();

    return view('administrador.index', ['total_atendentes' => $total_atendentes,
                                  'total_operadores' => $total_operadores,
                                  'total_medicos' => $total_medicos,
                                  'total_calendarios' => $total_calendarios]);
    // return view('administrador.index');
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

  public function operadores(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.operador.operadores', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.operador.operadores', compact('sucesso'));
      } else {
        if ($request->session()->has('erroEdit')) {
          $erroEdit = $request->session()->get('erroEdit');
          return view('administrador.operador.operadores', compact('erroEdit'));
        } else {
          if ($request->session()->has('erroExcluir')) {
            $erroExcluir = $request->session()->get('erroExcluir');
            return view('administrador.operador.operadores', compact('erroExcluir'));
          } else {
            return view('administrador.operador.operadores');
          }
        }
      }
    }
  }

  public function getOperador() {
    // $users = User::select(['id', 'name', 'email'])->where('tipo', '=', 'operador');
    $users = User::where('tipo', '=', 'operador');

    return Datatables::of($users)->addColumn('action', function($user) {
      return '<button type="button" id="ver" class="btn btn-info btn-xs" value="'.$user->id.'" onclick="detalhesOperator(this.value)"><i class="fa fa-eye"></i> Ver Detalhes</button> ';
    })->make(true);
  }

  public function verOperador($id) {
    $operador = DB::table('users')
        ->join('enderecos', 'users.endereco_id', '=', 'enderecos.id_endereco')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id_cidade')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id_estado')
        ->join('telefones', 'users.telefone_id', '=', 'telefones.id_telefone')
        ->select('users.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('users.id', '=', $id)
        ->get()
        ->first();

    return Response::json($operador);
  }

  public function cadastrarOperador(Request $request) {
    if ($request->name != null && $request->data_nascimento != null &&
      $request->cpf != null && $request->rg != null &&
      $request->email != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null && $request->telefone_um != null) {

      // $data = $request->data_nascimento;
      $data_pt = str_replace("/", "-", $request->data_nascimento);
      $data = date('Y-m-d', strtotime($data_pt));
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
        $request->session()->flash('erro', 'O Operador não pode ser menor de idade, verifique a data informada!');
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


      $operadores = User::where('tipo', 'operador')->get();
      $ultimo_operador = end($operadores);
      $ultimo_operador_final = end($ultimo_operador);
      $num_operadores_next = $ultimo_operador_final->codigo + 1;

      $user = new User();
      $user->codigo = $num_operadores_next;
      $user->name = strtoupper($request->name);
      $user->data_nascimento = $data;
      $user->cpf = $cpf;
      $user->rg = $request->rg;
      $user->email = $request->email;
      $user->password = bcrypt('QMS12345678');
      $user->tipo = 'operador';
      $user->numero_alteracao_senha = 0;
      $user->data_alteracao_senha = date('Y-m-d');
      $user->telefone_id = $telefone->id_telefone;

      $estado = Estado::create($request->all());
      $cidade = new Cidade($request->all());
      $cidade->estado_id = $estado->id_estado;

      $cidadeCreate = Cidade::create(['nome_cidade' => strtoupper($cidade->nome_cidade),
                                      'cep' => $cep,
                                      'estado_id' => $cidade->estado_id, ]);
      $endereco = new Endereco($request->all());

      $endereco->cidade_id = $cidadeCreate->id_cidade;

      $enderecoCreate = Endereco::create(['rua' => strtoupper($endereco->rua),
                                      'numero' => $endereco->numero,
                                      'complemento' => strtoupper($endereco->complemento),
                                      'bairro' => strtoupper($endereco->bairro),
                                      'cidade_id' => $endereco->cidade_id, ]);
      $user->endereco_id = $enderecoCreate->id_endereco;

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
    // dd($request->all());

    if ($request->operador_id != null && $request->name != null &&
        $request->data_nascimento != null &&
        $request->cpf != null && $request->rg != null &&
        $request->email != null && $request->rua != null &&
        $request->numero != null && $request->bairro != null &&
        $request->nome_cidade != null && $request->cep != null &&
        $request->nome_estado != null && $request->telefone_um != null) {

        $operador_id = $request->operador_id;

        $data_pt = str_replace("/", "-", $request->data_nascimento);
        $data = date('Y-m-d', strtotime($data_pt));
        list($ano, $mes, $dia,) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        if ($idade < 18) {
          $request->session()->flash('erroEdit', 'O Operador não pode ser menor de idade, verifique a data informada!');
          return redirect('/administrador/operadores')->withInput();
        }

        $validacaoCpf = AdministradorController::validaCpf($request->cpf);
        if (!$validacaoCpf) {
          $request->session()->flash('erroEdit', 'O CPF informado é inválido!');
          return redirect('/administrador/operadores')->withInput();
        }

        $valor = trim($request->cpf);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(".", "", $valor);
        $cpf = str_replace("-", "", $valor);

        $operadorBanco = User::find($operador_id);
        if ($operadorBanco->cpf != $cpf) {
          $operadorBancoCpf = User::where('cpf', $cpf)->first();
          if ($operadorBancoCpf != null) {
            $request->session()->flash('erroEdit', 'Esse CPF já está cadastrado!');
            return redirect('/administrador/operadores')->withInput();
          }
        }

        $operadorBanco = User::find($operador_id);
        if ($operadorBanco->rg != $request->rg) {
          $operadorBancoRg = User::where('rg', $request->rg)->first();
          if ($operadorBancoRg != null) {
            $request->session()->flash('erroEdit', 'Esse RG já está cadastrado!');
            return redirect('/administrador/operadores')->withInput();
          }
        }

        $operadorBanco = User::find($operador_id);
        if ($operadorBanco->email != $request->email) {
          $operadorBancoEmail = User::where('email', $request->email)->first();
          if ($operadorBancoEmail != null) {
            $request->session()->flash('erroEdit', 'Esse Email já está cadastrado!');
            return redirect('/administrador/operadores')->withInput();
          }
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

        $user = User::find($operador_id);
        $telefone =Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);
        $cidade = Cidade::find($endereco->cidade_id);
        $estado = Estado::find($cidade->estado_id);

        $telefone->telefone_um = $telefone_um;
        $telefone->telefone_dois = $telefone_dois;

        $estado->nome_estado = strtoupper($request->nome_estado);

        $cidade->nome_cidade = strtoupper($request->nome_cidade);
        $cidade->cep = $request->cep;

        $endereco->rua = strtoupper($request->rua);
        $endereco->numero = $request->numero;
        $endereco->bairro = strtoupper($request->bairro);
        $endereco->complemento = strtoupper($request->complemento);

        $user->name = strtoupper($request->name);
        $user->data_nascimento = $data;
        $user->cpf = $cpf;
        $user->rg = $request->rg;
        $user->email = $request->email;

        $status = false;
        try {
          $user->save();
          $telefone->save();
          $endereco->save();
          $cidade->save();
          $estado->save();

          $status = true;
        } catch (Exception $e) {
          dd($e);
        }

        if ($status) {
          $request->session()->flash('sucesso', 'Operador alterado com sucesso!');
          return redirect('/administrador/operadores');
        } else {
          $request->session()->flash('erroEdit', 'Não foi possível editar o Operador, por favor tente em instantes!');
          return redirect('/administrador/operadores');
        }

    } else {
      $request->session()->flash('erroEdit', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/operadores')->withInput();
    }

  }

  public function excluirOperador(Request $request) {
    $operador_id = $request->id;

    $operador = User::find($operador_id);
    $telefone =Telefone::find($operador->telefone_id);
    $endereco = Endereco::find($operador->endereco_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    $status = false;
    try {
      $operador->delete();
      $telefone->delete();
      $endereco->delete();
      $cidade->delete();
      $estado->delete();

      $status = true;
    } catch (Exception $e) {
      dd($e);
    }

    $result;

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);

  }

  public function atendentes(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.atendente.atendentes', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.atendente.atendentes', compact('sucesso'));
      } else {
        if ($request->session()->has('erroEdit')) {
          $erroEdit = $request->session()->get('erroEdit');
          return view('administrador.atendente.atendentes', compact('erroEdit'));
        } else {
          if ($request->session()->has('erroExcluir')) {
            $erroExcluir = $request->session()->get('erroExcluir');
            return view('administrador.atendente.atendentes', compact('erroExcluir'));
          } else {
            return view('administrador.atendente.atendentes');
          }
        }
      }
    }
  }

  public function getAtendente() {
    // $users = User::select(['id', 'name', 'email'])->where('tipo', '=', 'atendente');
    $users = User::where('tipo', '=', 'atendente');

    return Datatables::of($users)->addColumn('action', function($user) {
      return '<button type="button" id="ver" class="btn btn-info btn-xs" value="'.$user->id.'" onclick="detalhesAtendente(this.value)"><i class="fa fa-eye"></i> Ver Detalhes</button> ';
    })->make(true);
  }

  public function verAtendente($id) {
    $atendente = DB::table('users')
        ->join('enderecos', 'users.endereco_id', '=', 'enderecos.id_endereco')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id_cidade')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id_estado')
        ->join('telefones', 'users.telefone_id', '=', 'telefones.id_telefone')
        ->select('users.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('users.id', '=', $id)
        ->get()
        ->first();

    return Response::json($atendente);
  }

  public function cadastrarAtendente(Request $request) {
    if ($request->name != null && $request->data_nascimento != null &&
      $request->cpf != null && $request->rg != null &&
      $request->email != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null && $request->telefone_um != null) {

      // $data = $request->data_nascimento;
      $data_pt = str_replace("/", "-", $request->data_nascimento);
      $data = date('Y-m-d', strtotime($data_pt));
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
        $request->session()->flash('erro', 'O atendente não pode ser menor de idade, verifique a data informada!');
        return redirect('/administrador/atendentes')->withInput();
      }

      $validacaoCpf = AdministradorController::validaCpf($request->cpf);

      if (!$validacaoCpf) {
        $request->session()->flash('erro', 'O CPF informado é inválido!');
        return redirect('/administrador/atendentes')->withInput();
      }

      $valor = trim($request->cpf);
      $valor = str_replace(".", "", $valor);
      $valor = str_replace(".", "", $valor);
      $cpf = str_replace("-", "", $valor);
      $operadorBancoCpf = User::where('cpf', $cpf)->first();
      if ($operadorBancoCpf != null) {
        $request->session()->flash('erro', 'Esse CPF já está cadastrado!');
        return redirect('/administrador/atendentes')->withInput();
      }
      $operadorBancoRg = User::where('rg', $request->rg)->first();
      if ($operadorBancoRg != null) {
        $request->session()->flash('erro', 'Esse RG já está cadastrado!');
        return redirect('/administrador/atendentes')->withInput();
      }
      $operadorBancoEmail = User::where('email', $request->email)->first();
      if ($operadorBancoEmail != null) {
        $request->session()->flash('erro', 'Esse Email já está cadastrado!');
        return redirect('/administrador/atendentes')->withInput();
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


      // $user = new User();
      $atendentes = User::where('tipo', 'atendente')->get();
      $ultimo_atentende = end($atendentes);
      $ultimo_atentende_final = end($ultimo_atentende);
      $num_atendentes_next = $ultimo_atentende_final->codigo + 1;

      $user = new User();
      $user->codigo = $num_atendentes_next;
      $user->name = strtoupper($request->name);
      $user->data_nascimento = $data;
      $user->cpf = $cpf;
      $user->rg = $request->rg;
      $user->email = $request->email;
      $user->password = bcrypt('QMS12345678');
      $user->tipo = 'atendente';
      $user->numero_alteracao_senha = 0;
      $user->data_alteracao_senha = date('Y-m-d');
      $user->telefone_id = $telefone->id_telefone;

      $estado = Estado::create($request->all());
      $cidade = new Cidade($request->all());
      $cidade->estado_id = $estado->id_estado;

      $cidadeCreate = Cidade::create(['nome_cidade' => strtoupper($cidade->nome_cidade),
                                      'cep' => $cep,
                                      'estado_id' => $cidade->estado_id, ]);
      $endereco = new Endereco($request->all());

      $endereco->cidade_id = $cidadeCreate->id_cidade;

      $enderecoCreate = Endereco::create(['rua' => strtoupper($endereco->rua),
                                      'numero' => $endereco->numero,
                                      'complemento' => strtoupper($endereco->complemento),
                                      'bairro' => strtoupper($endereco->bairro),
                                      'cidade_id' => $endereco->cidade_id, ]);
      $user->endereco_id = $enderecoCreate->id_endereco;

      if ($user->save()) {
        $request->session()->flash('sucesso', '  Cadastro realizado com sucesso!');
        return redirect('/administrador/atendentes');
      } else {
        $request->session()->flash('erro', 'Erro inesperado, por favor tente em instantes!');
        return redirect('/administrador/atendentes')->withInput();
      }


    } else {
      $request->session()->flash('erro', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/atendentes')->withInput();
    }

  }

  public function editarAtendente(Request $request) {
    if ($request->atendente_id != null && $request->name != null &&
        $request->data_nascimento != null &&
        $request->cpf != null && $request->rg != null &&
        $request->email != null && $request->rua != null &&
        $request->numero != null && $request->bairro != null &&
        $request->nome_cidade != null && $request->cep != null &&
        $request->nome_estado != null && $request->telefone_um != null) {

        $atendente_id = $request->atendente_id;

        $data_pt = str_replace("/", "-", $request->data_nascimento);
        $data = date('Y-m-d', strtotime($data_pt));
        list($ano, $mes, $dia,) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        if ($idade < 18) {
          $request->session()->flash('erroEdit', 'O Atendente não pode ser menor de idade, verifique a data informada!');
          return redirect('/administrador/atendentes')->withInput();
        }

        $validacaoCpf = AdministradorController::validaCpf($request->cpf);
        if (!$validacaoCpf) {
          $request->session()->flash('erroEdit', 'O CPF informado é inválido!');
          return redirect('/administrador/atendentes')->withInput();
        }

        $valor = trim($request->cpf);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(".", "", $valor);
        $cpf = str_replace("-", "", $valor);

        $operadorBanco = User::find($atendente_id);
        if ($operadorBanco->cpf != $cpf) {
          $operadorBancoCpf = User::where('cpf', $cpf)->first();
          if ($operadorBancoCpf != null) {
            $request->session()->flash('erroEdit', 'Esse CPF já está cadastrado!');
            return redirect('/administrador/atendentes')->withInput();
          }
        }

        $operadorBanco = User::find($atendente_id);
        if ($operadorBanco->rg != $request->rg) {
          $operadorBancoRg = User::where('rg', $request->rg)->first();
          if ($operadorBancoRg != null) {
            $request->session()->flash('erroEdit', 'Esse RG já está cadastrado!');
            return redirect('/administrador/atendentes')->withInput();
          }
        }

        $operadorBanco = User::find($atendente_id);
        if ($operadorBanco->email != $request->email) {
          $operadorBancoEmail = User::where('email', $request->email)->first();
          if ($operadorBancoEmail != null) {
            $request->session()->flash('erroEdit', 'Esse Email já está cadastrado!');
            return redirect('/administrador/atendentes')->withInput();
          }
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

        $user = User::find($atendente_id);
        $telefone =Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);
        $cidade = Cidade::find($endereco->cidade_id);
        $estado = Estado::find($cidade->estado_id);

        $telefone->telefone_um = $telefone_um;
        $telefone->telefone_dois = $telefone_dois;

        $estado->nome_estado = strtoupper($request->nome_estado);

        $cidade->nome_cidade = strtoupper($request->nome_cidade);
        $cidade->cep = $request->cep;

        $endereco->rua = strtoupper($request->rua);
        $endereco->numero = $request->numero;
        $endereco->bairro = strtoupper($request->bairro);
        $endereco->complemento = strtoupper($request->complemento);

        $user->name = strtoupper($request->name);
        $user->data_nascimento = $data;
        $user->cpf = $cpf;
        $user->rg = $request->rg;
        $user->email = $request->email;

        $status = false;
        try {
          $user->save();
          $telefone->save();
          $endereco->save();
          $cidade->save();
          $estado->save();

          $status = true;
        } catch (Exception $e) {
          dd($e);
        }

        if ($status) {
          $request->session()->flash('sucesso', 'Atendente alterado com sucesso!');
          return redirect('/administrador/atendentes');
        } else {
          $request->session()->flash('erroEdit', 'Não foi possível editar o Atendente, por favor tente em instantes!');
          return redirect('/administrador/atendentes');
        }

    } else {
      $request->session()->flash('erroEdit', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/atendentes')->withInput();
    }

  }

  public function excluirAtendente(Request $request) {
    $atendente_id = $request->id;

    $atendente = User::find($atendente_id);
    $telefone =Telefone::find($atendente->telefone_id);
    $endereco = Endereco::find($atendente->endereco_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    $status = false;
    try {
      $atendente->delete();
      $telefone->delete();
      $endereco->delete();
      $cidade->delete();
      $estado->delete();

      $status = true;
    } catch (Exception $e) {
      dd($e);
    }

    $result;

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);

  }



  public function administradores(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.admin.administradores', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.admin.administradores', compact('sucesso'));
      } else {
        if ($request->session()->has('erroEdit')) {
          $erroEdit = $request->session()->get('erroEdit');
          return view('administrador.admin.administradores', compact('erroEdit'));
        } else {
          if ($request->session()->has('erroExcluir')) {
            $erroExcluir = $request->session()->get('erroExcluir');
            return view('administrador.admin.administradores', compact('erroExcluir'));
          } else {
            return view('administrador.admin.administradores');
          }
        }
      }
    }
  }

  public function getAdministrador() {
    // $users = User::select(['id', 'name', 'email'])->where('tipo', '=', 'administrador');
    $users = User::where('tipo', '=', 'administrador');

    return Datatables::of($users)->addColumn('action', function($user) {
      return '<button type="button" id="ver" class="btn btn-info btn-xs" value="'.$user->id.'" onclick="detalhesAdministrador(this.value)"><i class="fa fa-eye"></i> Ver Detalhes</button> ';
    })->make(true);
  }

  public function verAdministrador($id) {
    $administrador = DB::table('users')
        ->join('enderecos', 'users.endereco_id', '=', 'enderecos.id_endereco')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id_cidade')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id_estado')
        ->join('telefones', 'users.telefone_id', '=', 'telefones.id_telefone')
        ->select('users.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('users.id', '=', $id)
        ->get()
        ->first();

    return Response::json($administrador);
  }

  public function cadastrarAdministrador(Request $request) {
    if ($request->name != null && $request->data_nascimento != null &&
      $request->cpf != null && $request->rg != null &&
      $request->email != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null && $request->telefone_um != null) {

      // $data = $request->data_nascimento;
      $data_pt = str_replace("/", "-", $request->data_nascimento);
      $data = date('Y-m-d', strtotime($data_pt));
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
        $request->session()->flash('erro', 'O administrador não pode ser menor de idade, verifique a data informada!');
        return redirect('/administrador/administradores')->withInput();
      }

      $validacaoCpf = AdministradorController::validaCpf($request->cpf);

      if (!$validacaoCpf) {
        $request->session()->flash('erro', 'O CPF informado é inválido!');
        return redirect('/administrador/administradores')->withInput();
      }

      $valor = trim($request->cpf);
      $valor = str_replace(".", "", $valor);
      $valor = str_replace(".", "", $valor);
      $cpf = str_replace("-", "", $valor);
      $operadorBancoCpf = User::where('cpf', $cpf)->first();
      if ($operadorBancoCpf != null) {
        $request->session()->flash('erro', 'Esse CPF já está cadastrado!');
        return redirect('/administrador/administradores')->withInput();
      }
      $operadorBancoRg = User::where('rg', $request->rg)->first();
      if ($operadorBancoRg != null) {
        $request->session()->flash('erro', 'Esse RG já está cadastrado!');
        return redirect('/administrador/administradores')->withInput();
      }
      $operadorBancoEmail = User::where('email', $request->email)->first();
      if ($operadorBancoEmail != null) {
        $request->session()->flash('erro', 'Esse Email já está cadastrado!');
        return redirect('/administrador/administradores')->withInput();
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


      // $user = new User();
      $administradores = User::where('tipo', 'administrador')->get();
      $ultimo_administrador = end($administradores);
      $ultimo_administrador_final = end($ultimo_administrador);
      $num_administrador_next = $ultimo_administrador_final->codigo + 1;

      $user = new User();
      $user->codigo = $num_administrador_next;
      $user->name = strtoupper($request->name);
      $user->data_nascimento = $data;
      $user->cpf = $cpf;
      $user->rg = $request->rg;
      $user->email = $request->email;
      $user->password = bcrypt('QMS12345678');
      $user->tipo = 'administrador';
      $user->numero_alteracao_senha = 0;
      $user->data_alteracao_senha = date('Y-m-d');
      $user->telefone_id = $telefone->id_telefone;

      $estado = Estado::create($request->all());
      $cidade = new Cidade($request->all());
      $cidade->estado_id = $estado->id_estado;

      $cidadeCreate = Cidade::create(['nome_cidade' => strtoupper($cidade->nome_cidade),
                                      'cep' => $cep,
                                      'estado_id' => $cidade->estado_id, ]);
      $endereco = new Endereco($request->all());

      $endereco->cidade_id = $cidadeCreate->id_cidade;

      $enderecoCreate = Endereco::create(['rua' => strtoupper($endereco->rua),
                                      'numero' => $endereco->numero,
                                      'complemento' => strtoupper($endereco->complemento),
                                      'bairro' => strtoupper($endereco->bairro),
                                      'cidade_id' => $endereco->cidade_id, ]);
      $user->endereco_id = $enderecoCreate->id_endereco;

      if ($user->save()) {
        $request->session()->flash('sucesso', '  Cadastro realizado com sucesso!');
        return redirect('/administrador/administradores');
      } else {
        $request->session()->flash('erro', 'Erro inesperado, por favor tente em instantes!');
        return redirect('/administrador/administradores')->withInput();
      }


    } else {
      $request->session()->flash('erro', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/administradores')->withInput();
    }

  }

  public function editarAdministrador(Request $request) {
    if ($request->administrador_id != null && $request->name != null &&
        $request->data_nascimento != null &&
        $request->cpf != null && $request->rg != null &&
        $request->email != null && $request->rua != null &&
        $request->numero != null && $request->bairro != null &&
        $request->nome_cidade != null && $request->cep != null &&
        $request->nome_estado != null && $request->telefone_um != null) {

        $administrador_id = $request->administrador_id;

        $data_pt = str_replace("/", "-", $request->data_nascimento);
        $data = date('Y-m-d', strtotime($data_pt));
        list($ano, $mes, $dia,) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        if ($idade < 18) {
          $request->session()->flash('erroEdit', 'O administrador não pode ser menor de idade, verifique a data informada!');
          return redirect('/administrador/administradores')->withInput();
        }

        $validacaoCpf = AdministradorController::validaCpf($request->cpf);
        if (!$validacaoCpf) {
          $request->session()->flash('erroEdit', 'O CPF informado é inválido!');
          return redirect('/administrador/administradores')->withInput();
        }

        $valor = trim($request->cpf);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(".", "", $valor);
        $cpf = str_replace("-", "", $valor);

        $operadorBanco = User::find($administrador_id);
        if ($operadorBanco->cpf != $cpf) {
          $operadorBancoCpf = User::where('cpf', $cpf)->first();
          if ($operadorBancoCpf != null) {
            $request->session()->flash('erroEdit', 'Esse CPF já está cadastrado!');
            return redirect('/administrador/administradores')->withInput();
          }
        }

        $operadorBanco = User::find($administrador_id);
        if ($operadorBanco->rg != $request->rg) {
          $operadorBancoRg = User::where('rg', $request->rg)->first();
          if ($operadorBancoRg != null) {
            $request->session()->flash('erroEdit', 'Esse RG já está cadastrado!');
            return redirect('/administrador/administradores')->withInput();
          }
        }

        $operadorBanco = User::find($administrador_id);
        if ($operadorBanco->email != $request->email) {
          $operadorBancoEmail = User::where('email', $request->email)->first();
          if ($operadorBancoEmail != null) {
            $request->session()->flash('erroEdit', 'Esse Email já está cadastrado!');
            return redirect('/administrador/administradores')->withInput();
          }
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

        $user = User::find($administrador_id);
        $telefone =Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);
        $cidade = Cidade::find($endereco->cidade_id);
        $estado = Estado::find($cidade->estado_id);

        $telefone->telefone_um = $telefone_um;
        $telefone->telefone_dois = $telefone_dois;

        $estado->nome_estado = strtoupper($request->nome_estado);

        $cidade->nome_cidade = strtoupper($request->nome_cidade);
        $cidade->cep = $request->cep;

        $endereco->rua = strtoupper($request->rua);
        $endereco->numero = $request->numero;
        $endereco->bairro = strtoupper($request->bairro);
        $endereco->complemento = strtoupper($request->complemento);

        $user->name = strtoupper($request->name);
        $user->data_nascimento = $data;
        $user->cpf = $cpf;
        $user->rg = $request->rg;
        $user->email = $request->email;

        $status = false;
        try {
          $user->save();
          $telefone->save();
          $endereco->save();
          $cidade->save();
          $estado->save();

          $status = true;
        } catch (Exception $e) {
          dd($e);
        }

        if ($status) {
          $request->session()->flash('sucesso', 'Administrador alterado com sucesso!');
          return redirect('/administrador/administradores');
        } else {
          $request->session()->flash('erroEdit', 'Não foi possível editar o Administrador, por favor tente em instantes!');
          return redirect('/administrador/administradores');
        }

    } else {
      $request->session()->flash('erroEdit', 'Campos obrigatórios ficaram em branco!');
      return redirect('/administrador/administradores')->withInput();
    }

  }

  public function excluirAdministrador(Request $request) {
    $administrador_id = $request->id;

    $administrador = User::find($administrador_id);
    $telefone =Telefone::find($administrador->telefone_id);
    $endereco = Endereco::find($administrador->endereco_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    $result;

    $qteAdministradores = DB::table('users')->where('tipo', 'administrador')->get();
    $numAdmin = count($qteAdministradores);
    if ($numAdmin <= 1) {
      $result = ['menssage' => 'error_num'];
      return Response::json($result);
    }

    $status = false;
    try {
      $administrador->delete();
      $telefone->delete();
      $endereco->delete();
      $cidade->delete();
      $estado->delete();

      $status = true;
    } catch (Exception $e) {
      dd($e);
    }

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);

  }

  public function especialidades(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.medico.especialidades', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.medico.especialidades', compact('sucesso'));
      } else {
        return view('administrador.medico.especialidades');
      }
    }
  }

  public function cadastrarEspecialidade(Request $request) {
    $codigo_especialidade = $request->codigo_especialidade;
    $nome_especialidade = $request->nome_especialidade;

    $especialidadeBanco = DB::table('especialidades')
                                    ->where('codigo_especialidade', '=', $codigo_especialidade)
                                    ->where('nome_especialidade', '=', $nome_especialidade)
                                    ->get()->first();

    if ($especialidadeBanco != null) {
      $request->session()->flash('erro', 'O código ou especialidade já cadastrados!');
      return back()->withInput();
    } else {
      $especialidadeCodigo = DB::table('especialidades')
                                      ->where('codigo_especialidade', '=', $codigo_especialidade)
                                      ->get()->first();

      if ($especialidadeCodigo != null) {
        $request->session()->flash('erro', 'O código já está cadastrado!');
        return back()->withInput();
      } else {
        $especialidadeNome = DB::table('especialidades')
                                        ->where('nome_especialidade', '=', $nome_especialidade)
                                        ->get()->first();

        if ($especialidadeNome != null) {
          $request->session()->flash('erro', 'Esse nome da especialidade já está cadastrado!');
          return back()->withInput();
        } else {
          $especialidade_salvar = new Especialidade();
          $especialidade_salvar->codigo_especialidade = $codigo_especialidade;
          $especialidade_salvar->nome_especialidade = $nome_especialidade;

          if ($especialidade_salvar->save()) {
            $request->session()->flash('sucesso', 'A especialidade foi cadastrada com sucesso!');
            return back()->withInput();
          } else {
            $request->session()->flash('erro', 'Erro inesperado, tente em instantes!');
            return back()->withInput();
          }
        }
      }
    }

    dd($codigo_especialidade, $nome_especialidade);
  }

  public function getEspecialidades() {
    $especialidades = Especialidade::all();

    return Datatables::of($especialidades)
    ->addColumn('action', function($especialidade) {
      return '<button type="button" id="ver_especialidade" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal_ver_especialidade" value="'.$especialidade->id_especialidade.'" onclick="verEspecialidade(this.value)"><i class="fa fa-eye"></i> Ver</button>   ';
    })->make(true);
  }

  public function verEspecialidade($id_especialidade) {
    $especialidade = Especialidade::find($id_especialidade);

    return Response::json($especialidade);
  }

  public function excluirEspecialidade(Request $request) {
    $especialidade_id = $request->id;
    $especialidade = Especialidade::find($especialidade_id);

    $status = false;

    try {
      $especialidade->delete();
      $status = true;
    } catch (Exception $e) {
      $e;
    }

    $result;

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);
  }

  public function medicosEspecialidades($id) {
    $medico = Medico::where('id_medico', $id)->get()->first();

    $especialidades_medico = $medico->especialidades;

    return Response::json($especialidades_medico);
  }

  public function cadastrarEspecialidadeMedico(Request $request) {
    if ($request->especialidade_id != null && $request->medico_id != null) {

      $especialidade = Especialidade::find($request->especialidade_id);
      $especialidade_id = $especialidade->id_especialidade;
      $medico = Medico::find($request->medico_id);
      $medico_id = $medico->id_medico;

      $list_especialidades = $medico->especialidades;
      foreach ($list_especialidades as $ep) {
        if ($ep->id_especialidade == $especialidade_id) {
          $request->session()->flash('erroEspecialidade', 'O médico já está vinculado a especialidade!');
          return back();
        }
      }

      $status = false;
      try {
        DB::table('especialidade_medico')->insert([
            'id_especialidade' => $especialidade_id,
            'id_medico' => $medico_id,
        ]);

        $status = true;
      } catch (Exception $e) {
        dd($e);
      }

      if ($status) {
        $request->session()->flash('sucessoEspecialidade', 'Médico vinculado a especialidade com sucesso!');
        return back();
      } else {
        $request->session()->flash('erroEspecialidade', 'Erro inesperado!');
        return back();
      }

    } else {
      $request->session()->flash('erroEspecialidade', 'Por favor preencha os campos obrigatórios!');
      return back();
    }

  }

  public function excluirEspecialidadeDeMedico(Request $request) {
    $medico = Medico::find($request->medico_id);
    $especialidade = Especialidade::find($request->especialidade_id);

    $calendarios_busca = DB::table('calendarios')->where('especialidade_id', '=', $especialidade->id_especialidade)->get();
    $calendarios_delete = DB::table('calendarios')->where('especialidade_id', '=', $especialidade->id_especialidade);

    $consultas = DB::table('consultas')->where('especialidade_id', '=', $especialidade->id_especialidade);

    $status = false;

    try {
      DB::table('especialidade_medico')
                ->where('id_especialidade', $especialidade->id_especialidade)
                ->where('id_medico', $medico->id_medico)
                ->delete();

      $consultas->delete();
      foreach ($calendarios_busca as $calendario) {
        DB::table('periodos')->where('start', '=', $calendario->data)->delete();
      }
      $calendarios_delete->delete();
      $status = true;
    } catch (Exception $e) {
      dd($e);
    }

    $result;

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);
  }

  public function medicos(Request $request) {
    $especialidades = Especialidade::all();
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.medico.medicos', compact('erro', 'especialidades'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.medico.medicos', compact('sucesso', 'especialidades'));
      } else {
        if ($request->session()->has('erroEdit')) {
          $erroEdit = $request->session()->get('erroEdit');
          return view('administrador.medico.medicos', compact('erroEdit', 'especialidades'));
        } else {
          if ($request->session()->has('erroExcluir')) {
            $erroExcluir = $request->session()->get('erroExcluir');
            return view('administrador.medico.medicos', compact('erroExcluir', 'especialidades'));
          } else {
            if ($request->session()->has('erroEspecialidade')) {
              $erroEspecialidade = $request->session()->get('erroEspecialidade');
              return view('administrador.medico.medicos', compact('erroEspecialidade', 'especialidades'));
            } else {
              if ($request->session()->has('sucessoEspecialidade')) {
                $sucessoEspecialidade = $request->session()->get('sucessoEspecialidade');
                return view('administrador.medico.medicos', compact('sucessoEspecialidade', 'especialidades'));
              } else {
                return view('administrador.medico.medicos', compact('especialidades', 'especialidades'));
              }
            }
          }
        }
      }
    }
  }

  public function getMedico() {
    $medicos = Medico::all();

    return Datatables::of($medicos)
    ->addColumn('action', function($medico) {
      return '<button type="button" class="btn btn-info btn-xs" value="'.$medico->id_medico.'" onclick="detalhesDoctor(this.value)"><i class="fa fa-eye"></i> Ver Detalhes</button> '.
             '<td><a href="/administrador/medicos/calendario-atendimento/'.$medico->numero_crm.'" class="btn btn-success btn-xs" id="ver-calendario">Ir para Calendário <i class="fa fa-share-square-o"></i></a></td>';
            //  '<td><a href="/administrador/medicos/calendario-atendimento/'.$medico->id_medico.'" class="btn btn-success btn-xs" id="ver-calendario">Ir para Calendário <i class="fa fa-share-square-o"></i></a></td>';
    })->make(true);
  }

  public function verMedico($id) {
    $medico = DB::table('medicos')
        ->join('enderecos', 'medicos.endereco_id', '=', 'enderecos.id_endereco')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id_cidade')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id_estado')
        ->join('telefones', 'medicos.telefone_id', '=', 'telefones.id_telefone')
        ->select('medicos.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('medicos.id_medico', '=', $id)
        ->get()
        ->first();

    return Response::json($medico);
  }

  public function createMedico(Request $request) {
    if ($request->numero_crm != null && $request->nome_medico != null
      && $request->rua != null && $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null && $request->telefone_um != null) {

        $medicoBanco = Medico::where('numero_crm', $request->numero_crm)->get()->first();
        if ($medicoBanco != null) {
          $request->session()->flash('erro', 'Esse CRM já está cadastrado!');
          return back()->withInput();
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


        $medico = new Medico();
        $medico->nome_medico = strtoupper($request->nome_medico);
        $medico->numero_crm = $request->numero_crm;
        $medico->telefone_id = $telefone->id_telefone;

        $estado = Estado::create($request->all());
        $cidade = new Cidade($request->all());
        $cidade->estado_id = $estado->id_estado;

        $cidadeCreate = Cidade::create(['nome_cidade' => strtoupper($cidade->nome_cidade),
                                        'cep' => $cep,
                                        'estado_id' => $cidade->estado_id, ]);
        $endereco = new Endereco($request->all());

        $endereco->cidade_id = $cidadeCreate->id_cidade;

        $enderecoCreate = Endereco::create(['rua' => strtoupper($endereco->rua),
                                        'numero' => $endereco->numero,
                                        'complemento' => strtoupper($endereco->complemento),
                                        'bairro' => strtoupper($endereco->bairro),
                                        'cidade_id' => $endereco->cidade_id, ]);
        $medico->endereco_id = $enderecoCreate->id_endereco;

        if ($medico->save()) {
          $request->session()->flash('sucesso', '  Cadastro realizado com sucesso!');
          return back();
        } else {
          $request->session()->flash('erro', 'Erro inesperado, por favor tente em instantes!');
          return back()->withInput();
        }

    } else {
      $request->session()->flash('erro', 'Por favor, preencha todos os campos obrigatórios!');
      return back()->withInput();
    }
  }

  public function editMedico(Request $request) {
    if ($request->medico_id != null && $request->numero_crm != null &&
        $request->nome_medico != null && $request->rua != null && $request->numero != null &&
        $request->bairro != null && $request->nome_cidade != null && $request->cep != null &&
        $request->nome_estado != null && $request->telefone_um != null) {

        $medicoBanco = Medico::where('id_medico', $request->medico_id)->get()->first();
        if ($medicoBanco->numero_crm != $request->numero_crm) {
          $medicoBancoTwo = Medico::where('numero_crm', $request->numero_crm)->get()->first();
          if ($medicoBancoTwo != null) {
            $request->session()->flash('erroEdit', 'Esse CRM já está cadastrado!');
            return back()->withInput();
          }
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

        $medico = Medico::find($request->medico_id);
        $telefone =Telefone::find($medico->telefone_id);
        $endereco = Endereco::find($medico->endereco_id);
        $cidade = Cidade::find($endereco->cidade_id);
        $estado = Estado::find($cidade->estado_id);

        $telefone->telefone_um = $telefone_um;
        $telefone->telefone_dois = $telefone_dois;

        $estado->nome_estado = strtoupper($request->nome_estado);

        $cidade->nome_cidade = strtoupper($request->nome_cidade);
        $cidade->cep = $request->cep;

        $endereco->rua = strtoupper($request->rua);
        $endereco->numero = $request->numero;
        $endereco->bairro = strtoupper($request->bairro);
        $endereco->complemento = strtoupper($request->complemento);

        $medico->nome_medico = strtoupper($request->nome_medico);
        $medico->numero_crm = $request->numero_crm;

        $status = false;
        try {
          $medico->save();
          $telefone->save();
          $endereco->save();
          $cidade->save();
          $estado->save();

          $status = true;
        } catch (Exception $e) {
          dd($e);
        }

        if ($status) {
          $request->session()->flash('sucesso', 'Médico alterado com sucesso!');
          return back();
        } else {
          $request->session()->flash('erroEdit', 'Não foi possível editar o Médico, por favor tente em instantes!');
          return back()->withInput();
        }

    } else {
      $request->session()->flash('erroEdit', 'Por favor, preencha todos os campos obrigatórios!');
      return back()->withInput();
    }
  }

  public function deleteMedico(Request $request) {
    $medico_id = $request->id;

    $medico = Medico::find($medico_id);
    $telefone =Telefone::find($medico->telefone_id);
    $endereco = Endereco::find($medico->endereco_id);
    $cidade = Cidade::find($endereco->cidade_id);
    $estado = Estado::find($cidade->estado_id);

    $calendarios_busca = DB::table('calendarios')->where('medico_id', '=', $medico->id_medico)->get();

    $calendarios_delete = DB::table('calendarios')->where('medico_id', '=', $medico->id_medico);

    $consultas = DB::table('consultas')->where('medico_id', '=', $medico->id_medico);

    $status_one = false;

    try {
      $consultas->delete();

      foreach ($calendarios_busca as $calendario) {
        DB::table('periodos')->where('start', '=', $calendario->data)->delete();
      }
      $calendarios_delete->delete();

      $status_one = true;
    } catch (Exception $e) {
      dd($e);
    }

    $result;

    if ($status_one) {

      $status_two = false;
      try {
        $medico->delete();
        $telefone->delete();
        $endereco->delete();
        $cidade->delete();
        $estado->delete();

        $status_two = true;
      } catch (Exception $e) {
        dd($e);
      }

      if ($status_two) {
        $result = ['menssage' => 'success'];
      } else {
        $result = ['menssage' => 'error'];
      }

    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);
  }

  public function calendarioAtendimento(Request $request, $crm_medico) {
    // $medico = Medico::find($medico_id);
    $medico = Medico::where('numero_crm', $crm_medico)->get()->first();
    $locals = Local::all();
    $especialidades = $medico->especialidades;

    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades', 'erro'));
    } else {

      if ($request->session()->has('erro_list_datas') && $request->session()->has('sucesso')) {
        $erro_list_datas = $request->session()->get('erro_list_datas');
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades', 'erro_list_datas', 'sucesso'));
      } else {
        if ($request->session()->has('erro_list_datas')) {
          $erro_list_datas = $request->session()->get('erro_list_datas');
          return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades', 'erro_list_datas'));
        } else {
          $sucesso = $request->session()->get('sucesso');
          return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades', 'sucesso'));
        }
      }

    }

    return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades'));
  }

  public function verCalendarioAtendimento($crm_medico) {
    $data = DB::table('periodos')
        ->join('calendarios', 'periodos.calendario_id', '=', 'calendarios.id_calendario')
        ->join('locals', 'periodos.local_id', '=', 'locals.id_local')
        ->join('medicos', 'calendarios.medico_id', '=', 'medicos.id_medico')
        ->join('especialidades', 'calendarios.especialidade_id', '=', 'especialidades.id_especialidade')
        ->select('periodos.*', 'calendarios.*', 'locals.*', 'medicos.*', 'especialidades.*')
        ->where('medicos.numero_crm', '=', $crm_medico)
        ->get();

    return Response()->json($data);
  }

  public function calendarioCadastrar(Request $request) {
    $id_medico = $request->medico_id;
    $id_especialidade = $request->especialidade;
    $id_local = $request->local;
    $medico_return = Medico::where('id_medico', $request->medico_id)->get()->first();

    $datas_start = $request->start;
    $periodos  = $request->periodo;
    $total_consultas = $request->total_consultas;

    if ($id_medico == null || $id_especialidade == null || $id_local == null ||
        count($datas_start) == 0 || count($periodos) == 0 || count($total_consultas) == 0) {

        $request->session()->flash('erro', 'Por favor, preencha todos os campos obrigatórios!');
        // return redirect('/administrador/medicos/calendario-atendimento/'.$id_medico);
        return redirect('/administrador/medicos/calendario-atendimento/'.$medico_return->numero_crm);
    } else {

      $keys_datas = array_keys($datas_start);
      $last_index_datas = end($keys_datas);
      $erro_list_datas = array();
      $sucesso_list = array();

      for ($i=0; $i <= $last_index_datas; $i++) {
        if (array_key_exists($i, $datas_start)) {
          $search_db = DB::table('periodos')->join('calendarios', 'periodos.calendario_id', '=', 'calendarios.id_calendario')
                                            ->select('periodos.*', 'calendarios.*')
                                            ->where('periodos.start', '=', $datas_start[$i])
                                            ->where('periodos.nome', '=', $periodos[$i])
                                            ->where('calendarios.data', '=', $datas_start[$i])
                                            ->where('calendarios.medico_id', '=', $id_medico)
                                            ->first();

          if ($search_db == null) {
            $especialidade = Especialidade::where('id_especialidade', $id_especialidade)->get()->first();
            $title = $periodos[$i]." - ".$especialidade->nome_especialidade;

            $periodo = new Periodo();
            $periodo->nome = $periodos[$i];
            $periodo->title = $title;
            $periodo->start = $datas_start[$i];
            $periodo->total_consultas = $total_consultas[$i];
            $periodo->vagas_disponiveis = $total_consultas[$i];
            // $periodo->calendario_id = $calendario->id_calendario;
            $periodo->local_id = $id_local;

            $calendarioBanco = DB::table('calendarios')->where('data', '=', $datas_start[$i])->where('medico_id', '=', $id_medico)->get()->first();
            if ($calendarioBanco != null) {
              $periodo->calendario_id = $calendarioBanco->id_calendario;
            } else {
              $calendario = Calendario::create(['data' => $datas_start[$i],
                                              'especialidade_id' => $id_especialidade,
                                              'medico_id' => $id_medico]);

              $periodo->calendario_id = $calendario->id_calendario;
            }

            if ($periodo->save()) {
              array_push($sucesso_list, array('data' => $datas_start[$i], 'periodo' => $periodos[$i]));
            } else {
              array_push($erro_list_datas, array('data' => $datas_start[$i], 'periodo' => $periodos[$i]));
            }

          } else {
            array_push($erro_list_datas, array('data' => $datas_start[$i], 'periodo' => $periodos[$i]));
          }

        }
      }

      if ($erro_list_datas == null) {
        $request->session()->flash('sucesso', $sucesso_list);
        // return redirect('/administrador/medicos/calendario-atendimento/'.$id_medico);
        return redirect('/administrador/medicos/calendario-atendimento/'.$medico_return->numero_crm);
      } else {
        if ($erro_list_datas != null && $sucesso_list != null) {
          $request->session()->flash('erro_list_datas', $erro_list_datas);
          $request->session()->flash('sucesso', $sucesso_list);
          // return redirect('/administrador/medicos/calendario-atendimento/'.$id_medico);
          return redirect('/administrador/medicos/calendario-atendimento/'.$medico_return->numero_crm);
        } else {
          $request->session()->flash('erro_list_datas', $erro_list_datas);
          // return redirect('/administrador/medicos/calendario-atendimento/'.$id_medico);
          return redirect('/administrador/medicos/calendario-atendimento/'.$medico_return->numero_crm);
        }

      }

    }

  }

  public function calendarioExcluir(Request $request) {
    $id_periodo = $request->id;
    $periodo_delete = Periodo::where('id_periodo', $id_periodo)->get()->first();
    $calendario_delete = Calendario::where('id_calendario', $periodo_delete->calendario_id)->get()->first();
    $consultas_delete = Consulta::where('periodo_id', $id_periodo)->get();
    $outros_periodos = Periodo::where('start', $calendario_delete->data)->get();

    $status = false;

    $num_datas = count($outros_periodos);

    if ($num_datas == 1) {
      try {
        foreach ($consultas_delete as $consulta) {
          $consulta->delete();
        }
        $periodo_delete->delete();
        $calendario_delete->delete();
        $status = true;
      } catch (Exception $e) {
        $e;
      }
    } else {
      try {
        foreach ($consultas_delete as $consulta) {
          $consulta->delete();
        }
        $periodo_delete->delete();
        $status = true;
      } catch (Exception $e) {
        $e;
      }
    }

    $result;

    if ($status) {
      $result = ['menssage' => 'success'];
    } else {
      $result = ['menssage' => 'error'];
    }

    return Response::json($result);
  }

  public function getMedicos($idEspecialidade) {
    $especialidade = Especialidade::where('id_especialidade', $idEspecialidade)->get()->first();
    $medicos = $especialidade->medicos;

    return Response::json($medicos);
  }

  public function relatorioDiario() {
    $calendarios = DB::table('calendarios')->get();
    $years = array();
    $num = count($calendarios);

    for ($i=0; $i < $num; $i++) {
      $data = explode("-", $calendarios[$i]->data);
      $ano = $data[0];

      if (!in_array($ano, $years)) {
        array_push($years, $ano);
      }
    }

    $especialidades = Especialidade::all();

    return view('administrador.relatorios.relatorio-diario', compact('especialidades', 'years'));
  }

  public function relatorioMensal() {
    $calendarios = DB::table('calendarios')->get();
    $years = array();
    $num = count($calendarios);

    for ($i=0; $i < $num; $i++) {
      $data = explode("-", $calendarios[$i]->data);
      $ano = $data[0];

      if (!in_array($ano, $years)) {
        array_push($years, $ano);
      }
    }

    $especialidades = Especialidade::all();

    return view('administrador.relatorios.relatorio-mensal', compact('especialidades', 'years'));
  }

  public function relatoriosFilter(Request $request) {
    $data_hoje = date('Y-m-d');

    $queries = DB::table('consultas')
                      ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                      ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                      ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                      ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                      ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                      ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                      ->where('system_status', '=', $this->ativado)
                      ->where('calendarios.data', '=', $data_hoje);

    return Datatables::of($queries)
        ->filter(function ($query) use ($request) {
            if ($request->has('especialidade')) {
              $query->where('id_especialidade', '=', "{$request->get('especialidade')}");
            }

            if ($request->has('medico')) {
              $query->where('id_medico', '=', "{$request->get('medico')}");
            }

            if ($request->has('periodo')) {
              $query->where('nome', 'like', "%{$request->get('periodo')}%");
            }
        })
        ->make(true);
  }

  public function relatoriosFilterMensal(Request $request) {
    $queries = DB::table('consultas')
                      ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                      ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                      ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                      ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                      ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                      ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                      ->where('system_status', '=', $this->ativado);

   return Datatables::of($queries)
        ->editColumn('data', function ($queries) {
          return $queries->data ? with(new Carbon($queries->data))->format('d/m/Y') : '';
        })
        ->filter(function ($query) use ($request) {
           if ($request->has('ano')) {
             $query->where('data', 'like', "{$request->get('ano')}%");
           }

           if ($request->has('mes')) {
             $query->where('data', 'like', "%-{$request->get('mes')}-%");
           }

           if ($request->has('especialidade')) {
             $query->where('id_especialidade', '=', "{$request->get('especialidade')}");
           }

           if ($request->has('medico')) {
             $query->where('id_medico', '=', "{$request->get('medico')}");
           }

           if ($request->has('periodo')) {
             $query->where('nome', 'like', "%{$request->get('periodo')}%");
           }
        })
        ->make(true);
  }

  public function relatorioPdf(Request $request) {
    $data_hoje = date('Y-m-d');

    if ($request->has('periodo')) {
      $periodo = $request->get('periodo');

      if ($request->has('especialidade')) {
        $especialidade = $request->get('especialidade');

        if ($request->has('medico')) {
          $medico = $request->get('medico');

          $consultas = DB::table('consultas')
                            ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                            ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                            ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                            ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                            ->where('system_status', '=', $this->ativado)
                            ->where('calendarios.data', '=', $data_hoje)
                            ->where('periodos.nome', '=', $periodo)
                            ->where('especialidades.id_especialidade', '=', $especialidade)
                            ->where('medicos.id_medico', '=', $medico)
                            ->orderBy('consultas.created_at', 'asc')
                            ->get();

          $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view)->setPaper('a4', 'landscape');
          return $pdf->stream('consultas');
        } else {
          $consultas = DB::table('consultas')
                            ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                            ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                            ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                            ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                            ->where('system_status', '=', $this->ativado)
                            ->where('calendarios.data', '=', $data_hoje)
                            ->where('periodos.nome', '=', $periodo)
                            ->where('especialidades.id_especialidade', '=', $especialidade)
                            ->orderBy('consultas.created_at', 'asc')
                            ->get();

          $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view)->setPaper('a4', 'landscape');
          return $pdf->stream('consultas');
        }

      } else {
        $consultas = DB::table('consultas')
                          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                          ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                          ->where('system_status', '=', $this->ativado)
                          ->where('calendarios.data', '=', $data_hoje)
                          ->where('periodos.nome', '=', $periodo)
                          ->orderBy('consultas.created_at', 'asc')
                          ->get();

        $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream('consultas');
      }
    }

    if ($request->has('especialidade')) {
      $especialidade = $request->get('especialidade');

      if ($request->has('medico')) {
        $medico = $request->get('medico');

        $consultas = DB::table('consultas')
                          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                          ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                          ->where('system_status', '=', $this->ativado)
                          ->where('calendarios.data', '=', $data_hoje)
                          ->where('especialidades.id_especialidade', '=', $especialidade)
                          ->where('medicos.id_medico', '=', $medico)
                          ->orderBy('consultas.created_at', 'asc')
                          ->get();

        $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream('consultas');
      } else {
        $consultas = DB::table('consultas')
                          ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                          ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                          ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                          ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                          ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                          ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                          ->where('system_status', '=', $this->ativado)
                          ->where('calendarios.data', '=', $data_hoje)
                          ->where('especialidades.id_especialidade', '=', $especialidade)
                          ->orderBy('consultas.created_at', 'asc')
                          ->get();

        $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream('consultas');
      }

    }

    $consultas = DB::table('consultas')
                      ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                      ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                      ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                      ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                      ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                      ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                      ->where('system_status', '=', $this->ativado)
                      ->where('calendarios.data', '=', $data_hoje)
                      ->orderBy('consultas.created_at', 'asc')
                      ->get();

    $view = view('administrador.relatorios.relatorio-diario-pdf', compact('consultas'));
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view)->setPaper('a4', 'landscape');
    return $pdf->stream('consultas');
  }

  public function relatorioMensalPdf(Request $request) {
    if ($request->has('ano')) {
      $ano = $request->get('ano');

      if ($request->has('mes')) {
        $mes = $request->get('mes');

        if ($request->has('periodo')) {
          $periodo = $request->get('periodo');

          if ($request->has('especialidade')) {
            $especialidade = $request->get('especialidade');

            if ($request->has('medico')) {
              $medico = $request->get('medico');
              #Imprimir com ano, mes, periodo, especialidades e medico - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('calendarios.data', 'like', "%-{$mes}-%")
                                ->where('periodos.nome', '=', $periodo)
                                ->where('id_especialidade', '=', $especialidade)
                                ->where('id_medico', '=', $medico)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            } else {
              #Imprimir com ano, mes, perido e especialidades - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('calendarios.data', 'like', "%-{$mes}-%")
                                ->where('periodos.nome', '=', $periodo)
                                ->where('id_especialidade', '=', $especialidade)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            }
          } else {
            #Imprimir com ano, mes e periodo - OK
            $consultas = DB::table('consultas')
                              ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                              ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                              ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                              ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                              ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                              ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                              ->where('system_status', '=', $this->ativado)
                              ->where('calendarios.data', 'like', "{$ano}%")
                              ->where('calendarios.data', 'like', "%-{$mes}-%")
                              ->where('periodos.nome', '=', $periodo)
                              ->orderBy('consultas.created_at', 'asc')
                              ->get();

            $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'landscape');
            return $pdf->stream('consultas');
          }

        } else {

          if ($request->has('especialidade')) {
            $especialidade = $request->get('especialidade');

            if ($request->has('medico')) {
              #Imprimir com ano, mes, especialidades e medico - OK
              $medico = $request->get('medico');

              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('calendarios.data', 'like', "%-{$mes}-%")
                                ->where('id_especialidade', '=', $especialidade)
                                ->where('id_medico', '=', $medico)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            } else {
              #Imprimir com ano, mes e especialidades - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('calendarios.data', 'like', "%-{$mes}-%")
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            }
          } else {
            #Imprimir com ano, mes - OK
            $consultas = DB::table('consultas')
                              ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                              ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                              ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                              ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                              ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                              ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                              ->where('system_status', '=', $this->ativado)
                              ->where('calendarios.data', 'like', "{$ano}%")
                              ->where('calendarios.data', 'like', "%-{$mes}-%")
                              ->orderBy('consultas.created_at', 'asc')
                              ->get();

            $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'landscape');
            return $pdf->stream('consultas');
          }

        }

      } else {
        if ($request->has('periodo')) {
          $periodo = $request->get('periodo');

          if ($request->has('especialidade')) {
            $especialidade = $request->get('especialidade');

            if ($request->has('medico')) {
              $medico = $request->get('medico');
              #Imprimir ano, periodo, especialidades e medico - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('periodos.nome', '=', $periodo)
                                ->where('id_especialidade', '=', $especialidade)
                                ->where('id_medico', '=', $medico)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            } else {
              #Imprimir com ano, perido e especialidades - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('periodos.nome', '=', $periodo)
                                ->where('id_especialidade', '=', $especialidade)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            }
          } else {
            #Imprimir com ano e periodo - OK
            $consultas = DB::table('consultas')
                              ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                              ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                              ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                              ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                              ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                              ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                              ->where('system_status', '=', $this->ativado)
                              ->where('calendarios.data', 'like', "{$ano}%")
                              ->where('periodos.nome', '=', $periodo)
                              ->orderBy('consultas.created_at', 'asc')
                              ->get();

            $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'landscape');
            return $pdf->stream('consultas');
          }

        } else {

          if ($request->has('especialidade')) {
            $especialidade = $request->get('especialidade');

            if ($request->has('medico')) {
              #Imprimir com ano, especialidades e medico - OK
              $medico = $request->get('medico');

              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('id_especialidade', '=', $especialidade)
                                ->where('id_medico', '=', $medico)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            } else {
              #Imprimir com ano e especialidades - OK
              $consultas = DB::table('consultas')
                                ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                                ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                                ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                                ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                                ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                                ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                                ->where('system_status', '=', $this->ativado)
                                ->where('calendarios.data', 'like', "{$ano}%")
                                ->where('id_especialidade', '=', $especialidade)
                                ->orderBy('consultas.created_at', 'asc')
                                ->get();

              $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              return $pdf->stream('consultas');
            }
          } else {
            #Imprimir só com o ano - OK
            $consultas = DB::table('consultas')
                              ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                              ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                              ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                              ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                              ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                              ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                              ->where('system_status', '=', $this->ativado)
                              ->where('calendarios.data', 'like', "{$ano}%")
                              ->orderBy('consultas.created_at', 'asc')
                              ->get();

            $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'landscape');
            return $pdf->stream('consultas');

          }

        }
      }

    } else {
      // todas consultas marcadas: - OK
      $consultas = DB::table('consultas')
                        ->join('calendarios', 'consultas.calendario_id', '=', 'calendarios.id_calendario')
                        ->join('periodos', 'consultas.periodo_id', '=', 'periodos.id_periodo')
                        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id_paciente')
                        ->join('especialidades', 'consultas.especialidade_id', '=', 'especialidades.id_especialidade')
                        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id_medico')
                        ->join('locals', 'consultas.local_id', '=', 'locals.id_local')
                        ->where('system_status', '=', $this->ativado)
                        ->orderBy('consultas.created_at', 'asc')
                        ->get();

      $view = view('administrador.relatorios.relatorio-mensal-pdf', compact('consultas'));
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view)->setPaper('a4', 'landscape');
      return $pdf->stream('consultas');
    }

  }

  public function getMeses($ano) {
    $calendarios = DB::table('calendarios')->get();
    $meses = array();
    $num = count($calendarios);

    for ($i=0; $i < $num; $i++) {
      $data = explode("-", $calendarios[$i]->data);
      $mes = $data[1];
      $mes_extenso;

      if (!in_array($mes, $meses)) {
        switch ($mes) {
          case "01":
            $mes_extenso = 'Janeiro';
            break;
          case "02":
            $mes_extenso = 'Fevereiro';
            break;
          case "03":
            $mes_extenso = 'Março';
            break;
          case "04":
            $mes_extenso = 'Abril';
            break;
          case "05":
            $mes_extenso = 'Maio';
            break;
          case "06":
            $mes_extenso = 'Junho';
            break;
          case "07":
            $mes_extenso = 'Julho';
            break;
          case "08":
            $mes_extenso = 'Agosto';
            break;
          case "09":
            $mes_extenso = 'Setembro';
            break;
          case "10":
            $mes_extenso = 'Outubro';
            break;
          case "11":
            $mes_extenso = 'Novembro';
            break;
          case "12":
            $mes_extenso = 'Dezembro';
            break;
        }

        $meses[$mes] = $mes_extenso;
      }
    }

    return Response::json($meses);
  }

  public function manualAdministrador() {
    return view('administrador.manual-administrador');
  }

}
