<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;
use \qms\Paciente;
use \qms\Endereco;
use \qms\Cidade;
use \qms\Estado;
use \qms\Telefone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PacienteController extends Controller {
  public function __construct() {
      $this->middleware('auth');
      $this->middleware('\qms\Http\Middleware\AutorizacaoMiddlewareOperador::class');
  }

  public function cadastrarPaciente() {
    return view('paciente.cadastrar-paciente');
  }

  public function createPaciente(Request $request) {

    if ($request->nome_paciente != null && $request->sexo != null &&
      $request->data_nascimento != null && $request->numero_cns != null &&
      $request->nome_mae != null && $request->rua != null &&
      $request->numero != null && $request->bairro != null &&
      $request->nome_cidade != null && $request->cep != null &&
      $request->nome_estado != null ) {
//        return "deu certo!";
        $pacienteBanco = Paciente::where('numero_cns', $request->numero_cns)->first();
        // $pacienteBanco = null;
        // $pacienteBanco = DB::table('pacientes')->where('numero_cns', $request->numero_cns)->first();

        if ($pacienteBanco != null) {
          // erro CNS já existe no banco de dados;
          return back()->withInput()->with('status', '2');
        }

        $dataAtual = date('Y-m-d');
        $dataNasc = $request->data_nascimento;
        if ($dataNasc >= $dataAtual) {
          // erro data invalida, a data tem que ser menor ou igual em relacao a dataAtual;
          return back()->withInput()->with('status', '3');
        }

        //parte que vai gravar no banco de dados:
        $telefone = Telefone::create($request->all());
        $paciente = new Paciente($request->all());
        $paciente->telefone_id = $telefone->id;

        $estado = Estado::create($request->all());
        $cidade = new Cidade($request->all());
        $cidade->estado_id = $estado->id;

        $cidadeCreate = Cidade::create(['nome_cidade' => $cidade->nome_cidade,
                                        'cep' => $cidade->cep,
                                        'estado_id' => $cidade->estado_id, ]);
        $endereco = new Endereco($request->all());

        $endereco->cidade_id = $cidadeCreate->id;

        $enderecoCreate = Endereco::create(['rua' => $endereco->rua,
                                        'numero' => $endereco->numero,
                                        'complemento' => $endereco->complemento,
                                        'bairro' => $endereco->bairro,
                                        'cidade_id' => $endereco->cidade_id, ]);
        $paciente->endereco_id = $enderecoCreate->id;

        $pacienteNome = $paciente->nome_paciente;

        if ($paciente->save()) {
          //tudo feito com sucesso;
          return back()->withInput()->with('status', '5');
        } else {
          // erro ao salvar no banco de dados;
          return back()->withInput()->with('status', '4');
        }

    } else {
      // erro: todos os campos devem ser preenchidos:
      return back()->withInput()->with('status', '1');
    }

  }

  public function buscarPaciente() {
    return view('paciente.buscar-paciente');
  }
}
