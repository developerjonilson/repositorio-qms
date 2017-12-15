@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('OperadorController@index') }}">Operador</a></li>
      <li class="active">Pesquisar Paciente</li>
    </ol>
  </div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="/operador" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					<hr>
					@if (isset($erro))
						@if ($erro === 1)
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Por favor preencha os campos corretamente!
							</div>
						@else
							@if ($erro === 3)
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-check-circle"></i> Paciente alterado com sucesso!
								</div>
							@else
								@if ($erro === 2)
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Nenhum registro encontrado!
									</div>
								@endif
							@endif
						@endif
					@endif
					<h3 class="panel-title">Pesquisar Pacientes</h3>
					<p class="panel-subtitle">Escolha uma opção de buscar e preencha o campo corretamente! </p>
					<hr>
				</div>
				<div class="panel-body">
					<form class="" action="{{ action('PacienteController@filtrarPacientes')}}" method="get" id="form_filtro-paciente">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Buscar Por:</label>
									<select class="form-control" name="search_type" id="search_type">
										<option value="1"> Número do CNS </option>
										<option value="2"> Número do CPF </option>
										<option value="3"> Data de Nascimento </option>
									</select>
								</div>
							</div>
							<div class="col-sm-6" id="fields_filtro">
								<div class="form-group" id="div_number_cns">
									<label>Informe o número do CNS:</label>
									<input type="text" class="form-control fields_filtrar" name="numero_cns" id="numero_cns" placeholder="012.1234.5678.9123">
								</div>
								<div class="form-group hidden" id="div_number_cpf">
									<label>Informe o número do CPF:</label>
									<input type="text" class="form-control fields_filtrar" name="cpf" id="cpf" placeholder="123.456.789-01">
								</div>
								<div class="form-group hidden" id="div_date_nasc">
									<label>Informe a data de nascimento do paciente:</label>
									<input type="date" class="form-control fields_filtrar" name="data_nascimento" id="data_nascimento">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-2">
								<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filtrar</button>
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Pacientes</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<table class="table table-striped table-bordered table-responsive table-hover table-condensed">
							<thead>
								<tr>
									<th>Número CNS</th>
									<th>Nome</th>
									<th>Data de Nascimento</th>
									<th>CPF</th>
									<th>Nome da Mãe</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>

								@if (isset($pacientes))
									@if ($pacientes->total() < 1)
										<tr>
											<td colspan="7">Nenhum registro encontrado!</td>
										</tr>
									@else
										@foreach ($pacientes as $paciente)
											<tr>
												<td>{{ $paciente->numero_cns }}</td>
												<td>{{ $paciente->nome_paciente }}</td>
												<td>{{ date('d/m/Y', strtotime($paciente->data_nascimento)) }}</td>
												<td>{{ $paciente->cpf }}</td>
												<td>{{ $paciente->nome_mae }}</td>
												<td width="30">
													<div class="col-md-12">
													<a href="/operador/ver-paciente/{{ $paciente->id_paciente }}" class="btn btn-primary btn-xs btn-block"><i class="lnr lnr-eye"></i>  Ver</a>
													</div>
													<span class="col-md-1"></span>
													<div class="col-md-12">
														<form class="" action="{{ action('ConsultaController@pacienteParaAgendarConsulta') }}" method="post" id="form-para-agendar-consulta">
															{{ csrf_field() }}
															<input type="hidden" name="paciente_id" value="{{ $paciente->id_paciente }}">
															<button type="submit" class="btn btn-success btn-xs btn-block" id="btn-agendar"><i id="icone-btn-agendar" class="fa fa-calendar"></i>  Agendar consulta </button>
														</form>
												</td>
											</tr>
										@endforeach
									@endif
								@endif

							</tbody>
						</table>
					</div>

					</div>
					@if (isset($pacientes))
						@if ($pacientes->total() > $pacientes->perPage())
							<div class="panel-footer">
								<div class=""  id="navigation">
									<ul class="pager">
										<li class="previous"><a href="?page=1"><i class="fa fa-arrow-left"></i> Primeira Página</a></li>
										{{ $pacientes->links() }}
										<li class="next"><a href="?page={{$pacientes->lastPage()}}">Última Página <i class="fa fa-arrow-right"></i></a></li>
									</ul>
								</div>
							</div>
						@endif
					@endif

				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
