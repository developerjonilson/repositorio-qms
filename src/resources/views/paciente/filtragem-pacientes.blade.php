@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="/operador/pesquisar-pacientes" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					<hr>
					<h3 class="panel-title">Pacientes</h3>
					<hr>
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

								@if (isset($paciente))
									<tr>
										<td>{{ $paciente->numero_cns }}</td>
										<td>{{ $paciente->nome_paciente }}</td>
										<td>{{ date('d/m/Y', strtotime($paciente->data_nascimento)) }}</td>
										<td>{{ $paciente->cpf }}</td>
										<td>{{ $paciente->nome_mae }}</td>
										<td width="40">
											<div class="col-md-12">
												<form class="" action="{{ action('ConsultaController@pacienteParaAgendarConsulta') }}" method="post" id="form-para-agendar-consulta">
													{{ csrf_field() }}
													<input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
													<button type="submit" class="btn btn-success btn-xs btn-block" id="btn-agendar"><i id="icone-btn-agendar" class="fa fa-calendar"></i>  Agendar consulta </button>
												</form>
											</div>
											<span class="col-md-1"></span>
											<div class="col-md-12">
												<form class="" action="{{ action('PacienteController@pacienteParaAlterarPost') }}" method="post" id="form-para-alterar-paciente">
													{{ csrf_field() }}
													<input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
													<button type="submit" class="btn btn-warning btn-xs btn-block" id="btn-aterar"><i id="icone-btn-alterar" class="fa fa-pencil-square-o"></i>  Alterar Dados</button>
												</form>
											</div>
										</td>
									</tr>
								@else
									@if (isset($pacientes))
										{{-- @if ($pacientes->total() < 1)
											<tr>
												<td colspan="6">Nenhum registro encontrado!</td>
											</tr>
										@else --}}
											@foreach ($pacientes as $paciente)
												<tr>
													<td>{{ $paciente->numero_cns }}</td>
													<td>{{ $paciente->nome_paciente }}</td>
													<td>{{ date('d/m/Y', strtotime($paciente->data_nascimento)) }}</td>
													<td>{{ $paciente->cpf }}</td>
													<td>{{ $paciente->nome_mae }}</td>
													<td width="40">
														<div class="col-md-12">
															<form class="" action="{{ action('ConsultaController@pacienteParaAgendarConsulta') }}" method="post" id="form-para-agendar-consulta">
																{{ csrf_field() }}
																<input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
																<button type="submit" class="btn btn-success btn-xs btn-block" id="btn-agendar"><i id="icone-btn-agendar" class="fa fa-calendar"></i>  Agendar consulta </button>
															</form>
														</div>
														<span class="col-md-1"></span>
														<div class="col-md-12">
															<form class="" action="{{ action('PacienteController@pacienteParaAlterarPost') }}" method="post" id="form-para-alterar-paciente">
																{{ csrf_field() }}
																<input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
																<button type="submit" class="btn btn-warning btn-xs btn-block" id="btn-aterar"><i id="icone-btn-alterar" class="fa fa-pencil-square-o"></i>  Alterar Dados</button>
															</form>
														</div>
													</td>
												</tr>
											@endforeach
										{{-- @endif --}}
									@else
										<tr>
											<td colspan="6">Nenhum registro encontrado!</td>
										</tr>
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
	</div>

@endsection
