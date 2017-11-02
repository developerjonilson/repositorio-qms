@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="/operador/pesquisar-pacientes" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					<hr>
					<h3 class="panel-title">Informações do Paciente</h3>
				</div>
				<div class="panel-body">
					@if (!isset($paciente))
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="alert alert-danger alert-dismissible" role="alert">
								<i class="fa fa-times-circle"></i> Nenhum paciente foi selecionado para alterar seus dados cadastrados, selecione o paciente aqui:
								<a href="/operador/pesquisar-pacientes" class="btn btn-default">Selecionar Paciente</a>
							</div>
						</div>
					@else
							<div class="row">
								<hr>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Informações Pessoais</h4>
								</div>
								<div class="col-md-12 form-group">
									<input class="form-control campo" type="text" name="nome_paciente" id="nome_paciente" value="{{ $paciente->nome_paciente }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label>Sexo:</label>
									<input class="form-control campo" type="text" name="sexo" id="sexo" value="{{$paciente->sexo}}" disabled>
								</div>
								<div class="col-md-4 form-group">
									<label>Data de Nascimento:</label>
									<input class="form-control" type="date" name="data_nascimento" id="data_nascimento" value="{{ date('Y-m-d', strtotime($paciente->data_nascimento)) }}" disabled>
								</div>
								<div class="col-md-4 form-group">
									<label>Número do CNS:</label>
									<input class="form-control" type="text" name="numero_cns" id="numero_cns" value="{{ $paciente->numero_cns }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>CPF:</label>
									<input class="form-control" type="text" name="cpf" id="cpf" value="{{ $paciente->cpf }}" disabled>
								</div>
								<div class="col-md-6 form-group">
									<label>RG:</label>
									<input class="form-control" type="text" name="rg" id="rg" value="{{ $paciente->rg }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Nome da Mãe:</label>
									<input class="form-control campo" type="text" name="nome_mae" id="nome_mae" value="{{ $paciente->nome_mae }}" disabled>
								</div>
								<div class="col-md-6 form-group">
									<label>Nome da Pai:</label>
									<input class="form-control campo" type="text" name="nome_pai" id="nome_pai" value="{{ $paciente->nome_pai }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-12">
									<h4>Endereco</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 form-group">
									<label>Rua:</label>
									<input class="form-control campo" type="text" name="rua" id="rua" value="{{ $paciente->rua }}" disabled>
								</div>
								<div class="col-md-4 form-group">
									<label>Número:</label>
									<input class="form-control" type="text" name="numero" id="numero" value="{{ $paciente->numero }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Complemento:</label>
									<input class="form-control campo" type="text" name="complemento" id="complemento" value="{{ $paciente->complemento }}" disabled>
								</div>
								<div class="col-md-6 form-group">
									<label>Bairro:</label>
									<input class="form-control campo" type="text" name="bairro" id="bairro" value="{{ $paciente->bairro }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Cidade:</label>
									<input class="form-control campo" type="text" name="nome_cidade" id="cidade" value="{{ $paciente->nome_cidade }}" disabled>
								</div>
								<div class="col-md-4 form-group">
									<label>CEP:</label>
									<input class="form-control" type="text" name="cep" id="cep" value="{{ $paciente->cep }}" disabled>
								</div>
								<div class="col-md-2 form-group">
									<label>Estado:<span class="vermelho">*</span></label>
									<input class="form-control campo" type="text" name="nome_estado" id="estado" value="{{ $paciente->nome_estado }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-12">
									<h4>Telefones</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Telefone Principal:</label>
									<input type="text" name="telefone_um" id="telefone_um" class="form-control" value="{{ $paciente->telefone_um }}" disabled>
								</div>
								<div class="col-md-6 form-group">
									<label>Telefone Adicional:</label>
									<input type="text" name="telefone_dois" id="telefone_dois" class="form-control" value="{{ $paciente->telefone_dois }}" disabled>
								</div>
							</div>
							<div class="row">
								<hr>
							</div>
							<div class="row">
								<div class="col-md-3">
									<form class="" action="{{ action('ConsultaController@pacienteParaAgendarConsulta') }}" method="post" id="form-para-agendar-consulta">
										{{ csrf_field() }}
										<input type="hidden" name="paciente_id" id="paciente_id" value="{{ $paciente->id_paciente }}">
										<button type="submit" class="btn btn-success btn-block" id="btn-agendar"><i id="icone-btn-agendar" class="fa fa-calendar"></i>  Agendar consulta </button>
									</form>
								</div>
								<span class="col-md-1"></span>
								<div class="col-md-4">
									<form class="" action="{{ action('PacienteController@pacienteParaAlterarPost') }}" method="post" id="form-para-alterar-paciente">
										{{ csrf_field() }}
										<input type="hidden" name="paciente_id" value="{{ $paciente->id_paciente }}">
										<button type="submit" class="btn btn-warning btn-block" id="btn-aterar"><i id="icone-btn-alterar" class="fa fa-pencil-square-o"></i>  Alterar Informações do Paciente</button>
									</form>
								</div>
							</div>
					@endif
			</div>
			<!-- END PANEL HEADLINE -->
		</div>
	</div>


@endsection
