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

        if (strlen($request->numero_cns) != 15) {
          // erro CNS incorreto tem que ter 15 caracteres;
          return back()->withInput()->with('status', '6');
        }

        $pacienteBanco = Paciente::where('numero_cns', $request->numero_cns)->first();

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

  public function searchPaciente(Request $request) {
    $numero_cns = $request->numero_cns;

    if ($numero_cns != null) {

      if (strlen($numero_cns) == 15) {
        $paciente = DB::table('pacientes')->where('numero_cns', '=', $numero_cns)->first();

        if ($paciente != null) {
          //deu certo  aqui p paciente é enviado para a view:
          return back()->withInput()->with('paciente', $paciente);
        } else {
          //erro: paciente não cadastrado;
          return back()->withInput()->with('status', '3');
        }
        return "deu certo";
      } else {
        //erro: tamanho do numero não é igual a 15:
        return back()->withInput()->with('status', '2');
      }
    } else {
      // erro: todos os campos devem ser preenchidos:
      return back()->withInput()->with('status', '1');
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

  public function pacienteParaAlterarGet($numero_cns) {
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

    return redirect('operador/alterar-paciente')->with('paciente', $paciente)->with('stat', '1');;
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

        if ($paciente != null && $endereco != null && $cidade != null &&
            $estado != null && $telefone != null) {

              $paciente->nome_paciente = $request->nome_paciente;
              $paciente->sexo = $request->sexo;
              $paciente->data_nascimento = $request->data_nascimento;
              $paciente->numero_cns = $request->numero_cns;
              $paciente->nome_mae = $request->nome_mae;
              $paciente->nome_pai = $request->nome_pai;

              $endereco->rua = $request->rua;
              $endereco->numero = $request->numero;
              $endereco->bairro = $request->bairro;
              $endereco->complemento = $request->complemento;

              $cidade->nome_cidade = $request->nome_cidade;
              $cidade->cep = $request->cep;

              $estado->nome_estado = $request->nome_estado;

              $telefone->telefone_um = $request->telefone_um;
              $telefone->telefone_dois = $request->telefone_dois;

              if ($paciente->save() && $endereco->save() && $cidade->save()
                  && $estado->save() && $telefone->save()) {
                return redirect()->action('PacienteController@buscarPaciente')->with('stat', '2');
              } else {
                return redirect()->action('PacienteController@buscarPaciente')->with('stat', '1');
              }

        } else {
          //erro na busca no banco de dados:
          return redirect()->action('PacienteController@buscarPaciente')->with('stat', '1');
        }

    } else {
      return redirect()->action('PacienteController@pacienteParaAlterarGet', $numero_cns);
    }
  }


}
