<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use \qms\Models\Paciente;
use \qms\Models\Endereco;
use \qms\Models\Cidade;
use \qms\Models\Estado;
use \qms\Models\Telefone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;

class PacienteController extends Controller {

  private $totalPage = 3;

  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddlewareOperador::class');
  }

  public function cadastrarPaciente(Request $request) {
    if ($request->session()->has('resposta')) {
      $resposta = $request->session()->get('resposta');
      $request->session()->forget('resposta');
      // dd($request);
      $request->session()->reflash();

      return view('paciente.cadastrar-paciente', ['resposta' => $resposta]);
    } else {
      return view('paciente.cadastrar-paciente');
    }

  }

  public function createPaciente(Request $request) {
    if ($request->nome_paciente != null && $request->sexo != null &&
      $request->data_nascimento != null && $request->numero_cns != null &&
      $request->nome_mae != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null ) {

        if (strlen($request->numero_cns) != 15) {
          $resposta = 6;
          return back()->withInput()->with('resposta', $resposta);
          // return Response::json($resposta);
        }

        $pacienteBancoCns = Paciente::where('numero_cns', $request->numero_cns)->first();

        if ($pacienteBancoCns != null) {
          // erro CNS já existe no banco de dados;
          $resposta = 2;
          return back()->withInput()->with('resposta', $resposta);
          // return redirect()->action('PacienteController@cadastrarPaciente')->with('resposta', $resposta);
          // return Response::json($resposta);
        }

        if ($request->cpf != null) {
          $pacienteBancoCpf = Paciente::where('cpf', $request->cpf)->first();

          if ($pacienteBancoCpf != null) {
            // erro CNS já existe no banco de dados;
            $resposta = 7;
            return back()->withInput()->with('resposta', $resposta);
            // return Response::json($resposta);
          }
        }

        if ($request->rg != null) {
          $pacienteBancoRg = Paciente::where('rg', $request->rg)->first();

          if ($pacienteBancoRg != null) {
            // erro CNS já existe no banco de dados;
            $resposta = 8;
            return back()->withInput()->with('resposta', $resposta);
            // return Response::json($resposta);
          }
        }

        $dataAtual = date('Y-m-d');
        $dataNasc = $request->data_nascimento;
        if ($dataNasc >= $dataAtual) {
          // erro data invalida, a data tem que ser menor ou igual em relacao a dataAtual;
          $resposta = 3;
          return back()->withInput()->with('resposta', $resposta);
          // return Response::json($resposta);
        }

        //parte que vai gravar no banco de dados:
        $telefone = Telefone::create($request->all());
        $paciente = new Paciente();
        $paciente->nome_paciente = strtoupper($request->nome_paciente);
        $paciente->sexo = strtoupper($request->sexo);
        $paciente->data_nascimento = $request->data_nascimento;
        $paciente->numero_cns = $request->numero_cns;
        $paciente->cpf = $request->cpf;
        $paciente->rg = $request->rg;
        $paciente->nome_mae = strtoupper($request->nome_mae);
        $paciente->nome_pai = strtoupper($request->nome_pai);
        // $paciente = new Paciente($request->all());
        $paciente->telefone_id = $telefone->id;

        // return $paciente;

        $estado = Estado::create($request->all());
        $cidade = new Cidade($request->all());
        $cidade->estado_id = $estado->id;

        $cidadeCreate = Cidade::create(['nome_cidade' => strtoupper($cidade->nome_cidade),
                                        'cep' => $cidade->cep,
                                        'estado_id' => $cidade->estado_id, ]);
        $endereco = new Endereco($request->all());

        $endereco->cidade_id = $cidadeCreate->id;

        $enderecoCreate = Endereco::create(['rua' => strtoupper($endereco->rua),
                                        'numero' => $endereco->numero,
                                        'complemento' => strtoupper($endereco->complemento),
                                        'bairro' => strtoupper($endereco->bairro),
                                        'cidade_id' => $endereco->cidade_id, ]);
        $paciente->endereco_id = $enderecoCreate->id;

        if ($paciente->save()) {
          //tudo feito com sucesso;
          $sucesso = '1';
          $idPaciente = $paciente->id;
          $request->session()->flash('sucesso', $sucesso);
          $request->session()->flash('idPaciente', $idPaciente);

          return redirect()->action('ConsultaController@agendarConsulta')->with(compact('sucesso', 'idPaciente'));
        } else {
          // erro ao salvar no banco de dados;
          $resposta = 4;
          return back()->withInput()->with('resposta', $resposta);
          // return Response::json($resposta);
        }

    } else {
      // erro: todos os campos devem ser preenchidos:
      $resposta = 1;
      return back()->withInput()->with('resposta', $resposta);
      // return Response::json($resposta);
    }

  }

  public function pesquisarPacientes(Request $request) {
    if ($request->session()->has('erro')) {
      $erro = $request->session()->get('erro');
      $pacientes = DB::table('pacientes')
          ->orderBy('pacientes.created_at', 'desc')
          ->paginate($this->totalPage);

      return view('paciente.pesquisar-pacientes')->with(compact('erro', 'pacientes'));
    }

    $pacientes = DB::table('pacientes')
        ->orderBy('pacientes.created_at', 'desc')
        ->paginate($this->totalPage);

    return view('paciente.pesquisar-pacientes')->with(compact('pacientes'));
  }
  

  public function filtrarPacientes(Request $request) {
    if ($request->session()->has('data_nascimento')) {
      $data_nascimento = $request->session()->get('data_nascimento');

      $pacientes = DB::table('pacientes')->where('data_nascimento', '=', $data_nascimento)
                                         ->orderBy('pacientes.created_at', 'desc')
                                         ->paginate($this->totalPage);

      $request->session()->reflash();
      $pacientes->withPath('/operador/filtrar-pacientes');
      return view('paciente.filtragem-pacientes')->with('pacientes', $pacientes);
      // return redirect()->action('PacienteController@pesquisarPacientes')->with('pacientes', $pacientes);
    } else {
      $type = $request->search_type;
      if ($type == 1) {
        $numero_cns = $request->numero_cns;
        if ($numero_cns != null) {
          if (strlen($numero_cns) == 15) {
            $paciente = Paciente::where('numero_cns', $numero_cns)->first();
            if ($paciente == null) {
              $request->session()->flash('erro', 2);
              return redirect()->action('PacienteController@pesquisarPacientes');
            } else {
              return view('paciente.filtragem-pacientes')->with('paciente', $paciente);
              // return redirect()->action('PacienteController@pesquisarPacientes')->with('paciente', $paciente);
            }
          } else {
            //tamanho incorreto:
            $request->session()->flash('erro', 1);
            return redirect()->action('PacienteController@pesquisarPacientes');
          }
        } else {
          //campo null
          $request->session()->flash('erro', 1);
          return redirect()->action('PacienteController@pesquisarPacientes');
        }
      } else {
        if ($type == 2) {
          $cpf = $request->cpf;

          if ($cpf != null) {
            if (strlen($cpf) == 11) {
              $paciente = Paciente::where('cpf', $cpf)->first();

              if ($paciente == null) {
                $request->session()->flash('erro', 2);
                return redirect()->action('PacienteController@pesquisarPacientes');
              } else {
                return view('paciente.filtragem-pacientes')->with('paciente', $paciente);
                // return redirect()->action('PacienteController@pesquisarPacientes')->with('paciente', $paciente);
              }
            } else {
              //tamanho incorreto:
              $request->session()->flash('erro', 1);
              return redirect()->action('PacienteController@pesquisarPacientes');
            }
          } else {
            //campo null
            $request->session()->flash('erro', 1);
            return redirect()->action('PacienteController@pesquisarPacientes');
          }

        } else {
          if ($type == 3) {
            $data_nascimento = $request->data_nascimento;
            if ($data_nascimento != null) {
              $pacientes = DB::table('pacientes')->where('data_nascimento', '=', $data_nascimento)
                                                 ->orderBy('pacientes.created_at', 'desc')
                                                 ->paginate($this->totalPage);

              $request->session()->flash('data_nascimento', $data_nascimento);

              $pacientes->withPath('/operador/filtrar-pacientes');
              return view('paciente.filtragem-pacientes')->with('pacientes', $pacientes);
              // return redirect()->action('PacienteController@pesquisarPacientes')->with('pacientes', $pacientes);
            } else {
              //campo null
              $request->session()->flash('erro', 1);
              return redirect()->action('PacienteController@pesquisarPacientes');
            }
          }
        }
      }

    }

  }

  public function alterarPaciente() {
    return view('paciente.alterar-paciente');
  }

  public function pacienteParaAlterarPost(Request $request) {
    $id_paciente = $request->input('paciente_id');

    $paciente = DB::table('pacientes')
        ->join('enderecos', 'pacientes.endereco_id', '=', 'enderecos.id')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id')
        ->join('telefones', 'pacientes.telefone_id', '=', 'telefones.id')
        ->select('pacientes.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('pacientes.id', '=', $id_paciente)
        ->first();
    $paciente->id = $id_paciente;

    return redirect('operador/alterar-paciente')->with('paciente', $paciente);
  }

  public function pacienteParaAlterarGet(Request $request, $numero_cns) {
    $status = $request->session()->get('stat');

    $paciente = DB::table('pacientes')
        ->join('enderecos', 'pacientes.endereco_id', '=', 'enderecos.id')
        ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id')
        ->join('estados', 'cidades.estado_id', '=', 'estados.id')
        ->join('telefones', 'pacientes.telefone_id', '=', 'telefones.id')
        ->select('pacientes.*', 'enderecos.*', 'cidades.*', 'estados.*', 'telefones.*')
        ->where('pacientes.numero_cns', '=', $numero_cns)
        ->first();

    $paciente_id = DB::table('pacientes')->where('numero_cns', '=', $numero_cns)->first();

    $paciente->id = $paciente_id->id;

    return redirect('operador/alterar-paciente')->with('paciente', $paciente)->with('stat', $status);
  }

  public function alterandoPaciente(Request $request) {
    $paciente_id = $request->input('paciente_id');
    $numero_cns = $request->input('numero_cns');
    $endereco_id = $request->input('endereco_id');
    $cidade_id = $request->input('cidade_id');
    $estado_id = $request->input('estado_id');
    $telefone_id = $request->input('telefone_id');

    if ($request->nome_paciente != null && $request->sexo != null &&
      $request->data_nascimento != null && $request->numero_cns != null &&
      $request->nome_mae != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null ) {

        $paciente = Paciente::find($paciente_id);
        $endereco = Endereco::find($endereco_id);
        $cidade = Cidade::find($cidade_id);
        $estado = Estado::find($estado_id);
        $telefone = Telefone::find($telefone_id);

        if ($request->cpf != null) {
          if ($paciente->cpf != null) {
            if ($paciente->cpf != $request->cpf) {
              $request->session()->flash('stat', '3');
              return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
            }
          } else {
            $cpfBanco = Paciente::where('cpf', $request->cpf)->get()->first();
            if ($cpfBanco != null) {
              $request->session()->flash('stat', '3');
              return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
            }
          }
        }

        if ($request->rg != null) {
          if ($paciente->rg != null) {
            if ($paciente->rg != $request->rg) {
              $request->session()->flash('stat', '4');
              return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
            }
          } else {
            $rgBanco = Paciente::where('rg', $request->rg)->get()->first();
            if ($rgBanco != null) {
              $request->session()->flash('stat', '4');
              return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
            }
          }
        }

        if ($paciente != null && $endereco != null && $cidade != null &&
            $estado != null && $telefone != null) {

              $paciente->nome_paciente = strtoupper($request->nome_paciente);
              $paciente->sexo = strtoupper($request->sexo);
              $paciente->data_nascimento = strtoupper($request->data_nascimento);
              $paciente->numero_cns = $request->numero_cns;
              $paciente->cpf = $request->cpf;
              $paciente->rg = $request->rg;

              $paciente->nome_mae = strtoupper($request->nome_mae);
              $paciente->nome_pai = strtoupper($request->nome_pai);

              $endereco->rua = strtoupper($request->rua);
              $endereco->numero = strtoupper($request->numero);
              $endereco->bairro = strtoupper($request->bairro);
              $endereco->complemento = strtoupper($request->complemento);

              $cidade->nome_cidade = strtoupper($request->nome_cidade);
              $cidade->cep = $request->cep;

              $estado->nome_estado = strtoupper($request->nome_estado);

              $telefone->telefone_um = $request->telefone_um;
              $telefone->telefone_dois = $request->telefone_dois;

              if ($paciente->save() && $endereco->save() && $cidade->save()
                  && $estado->save() && $telefone->save()) {
                $erro = 3;
                return redirect()->action('PacienteController@pesquisarPacientes')->with('erro', $erro);
              } else {
                $erro = '2';
                return redirect()->action('PacienteController@pesquisarPacientes')->with('erro', $erro);
              }

        } else {
          //erro na busca no banco de dados:
          $erro = '2';
          return redirect()->action('PacienteController@pesquisarPacientes')->with('erro', $erro);

        }

    } else {
      return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
    }
  }


}
