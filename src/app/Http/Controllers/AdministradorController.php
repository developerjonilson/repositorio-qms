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
    $users = User::select(['id', 'name', 'email'])->where('tipo', '=', 'operador');

    return Datatables::of($users)->addColumn('action', function($user) {
      return '<button type="button" id="ver" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal_ver_operador" value="'.$user->id.'" onclick="verOperador(this.value)"><i class="fa fa-eye"></i> Ver</button>   '.
             '<button type="button" id="editar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_editar_operador" value="'.$user->id.'" onclick="operadorParaEditar(this.value)"><i class="fa fa-pencil-square-o"></i> Editar</button>   '.
             '<button type="button" id="exclir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_excluir_operador" value="'.$user->id.'" onclick="operadorParaExcluir(this.value)"><i class="fa fa-trash-o"></i> Excluir</button>   ';
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
      $user->telefone_id = $telefone->id_telefone;

      $estado = Estado::create($request->all());
      $cidade = new Cidade($request->all());
      $cidade->estado_id = $estado->id_estado;

      $cidadeCreate = Cidade::create(['nome_cidade' => $cidade->nome_cidade,
                                      'cep' => $cep,
                                      'estado_id' => $cidade->estado_id, ]);
      $endereco = new Endereco($request->all());

      $endereco->cidade_id = $cidadeCreate->id_cidade;

      $enderecoCreate = Endereco::create(['rua' => $endereco->rua,
                                      'numero' => $endereco->numero,
                                      'complemento' => $endereco->complemento,
                                      'bairro' => $endereco->bairro,
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

        $data = $request->data_nascimento;
        list($ano, $mes, $dia,) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        if ($idade < 18) {
          $request->session()->flash('erroEdit', 'O Operador não pode ser menor (não tem 18 anos),
                                          por favor verifique a data informada!');
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

        // $operador_id = $request->operador_id;

        $user = User::find($operador_id);
        $telefone =Telefone::find($user->telefone_id);
        $endereco = Endereco::find($user->endereco_id);
        $cidade = Cidade::find($endereco->cidade_id);
        $estado = Estado::find($cidade->estado_id);

        $telefone->telefone_um = $telefone_um;
        $telefone->telefone_dois = $telefone_dois;

        $estado->nome_estado = $request->nome_estado;

        $cidade->nome_cidade = $request->nome_cidade;
        $cidade->cep = $request->cep;

        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->complemento = $request->complemento;

        $user->name = $request->name;
        $user->data_nascimento = $request->data_nascimento;
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
    $operador_id = $request->operador_id;

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

    if ($status) {
      $request->session()->flash('sucesso', 'Operador excluído com sucesso!');
      return redirect('/administrador/operadores');
    } else {
      $request->session()->flash('erroExcluir', 'Não foi possível excluir o Operador, por favor tente em instantes!');
      return redirect('/administrador/operadores');
    }

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
        return view('administrador.atendente.atendentes');
      }
    }
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
        return view('administrador.admin.administradores');
      }
    }
  }

  public function medicos(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      return view('administrador.medico.medicos', compact('erro'));
    } else {
      if ($request->session()->has('sucesso')) {
        $sucesso = $request->session()->get('sucesso');
        return view('administrador.medico.medicos', compact('sucesso'));
      } else {
        return view('administrador.medico.medicos');
      }
    }
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

  public function calendarioAtendimento($medico_id) {
    $medico = Medico::find($medico_id);
    $locals = Local::all();
    $especialidades = $medico->especialidades;

    return view('administrador.medico.calendario', compact('medico', 'locals', 'especialidades'));
  }

  public function verCalendarioAtendimento($medico_id) {
    $data = DB::table('periodos')
        ->join('calendarios', 'periodos.calendario_id', '=', 'calendarios.id_calendario')
        ->join('locals', 'periodos.local_id', '=', 'locals.id_local')
        ->join('medicos', 'calendarios.medico_id', '=', 'medicos.id_medico')
        ->join('especialidades', 'calendarios.especialidade_id', '=', 'especialidades.id_especialidade')
        ->select('periodos.*', 'calendarios.*', 'locals.*', 'medicos.*', 'especialidades.*')
        ->where('calendarios.medico_id', '=', $medico_id)
        ->get();

    return Response()->json($data);
  }

  public function calendarioCadastrar(Request $request) {
    dd($request->all());


    return view('administrador.medico.calendario');
  }

  public function manualAdministrador() {
    return view('administrador.manual-administrador');
  }

}
