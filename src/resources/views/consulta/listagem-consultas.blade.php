@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="/operador" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					<hr>
					<h3 class="panel-title">Listar Consultas</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
					<hr>
				</div>
				<div class="panel-body">
					@if (isset($falha))
						<div class="row">
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> {{$falha}}
							</div>
						</div>
					@endif
					@if (isset($sucesso))
						<div class="row">
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{$sucesso}}
							</div>
						</div>
					@endif
					<div>
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#filtro_cns" aria-controls="filtro_cns" role="tab" data-toggle="tab">Listar Por CNS</a></li>
					    <li role="presentation"><a href="#filtro_completo" aria-controls="filtro_completo" role="tab" data-toggle="tab">Listar por Atendimento Médico</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="filtro_cns">
								<form class="" action="{{ action('ConsultaController@filtrarConsultas') }}" method="get" id="search-paciente">
									{{-- {{ csrf_field() }} --}}
									<div class="form-group col-md-6">
										<label>Informe o Número do CNS:<span class="vermelho">*</span></label>
										<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="123456789012345">
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary" id="btn-search-paciente"><i class="fa fa-search" id="icone-btn-search-paciente"></i>    Buscar</button>
									</div>
								</form>
							</div>
					    <div role="tabpanel" class="tab-pane" id="filtro_completo">
								<form class="" action="{{ action('ConsultaController@filtrarConsultas')}}" method="get" id="form-filtro">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Especialidade:<span class="vermelho">*</span></label>
												<select class="form-control" name="especialidade" id="especialidade">
													<option value="" disabled selected>Selecione...</option>
													@foreach ($especialidades as $especialidade)
														<option value="{{$especialidade->id_especialidade}}"> {{$especialidade->nome_especialidade}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Nome do médico:<span class="vermelho">*</span></label>
												<select class="form-control" name="medico" id="medico" disabled>
													<option value="0">Selecione</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Data da consulta:<span class="vermelho">*</span></label>
												<select class="form-control" name="data_consulta" id="data_consulta" disabled>
													<option value="0">Selecione</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label>Período:<span class="vermelho">*</span></label>
											<select class="form-control" name="periodo" id="periodo" disabled>
												<option value="0">Selecione</option>
											</select>
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
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Consultas</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<table class="table table-striped table-bordered table-responsive table-hover table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Paciente</th>
									<th>Especialidade</th>
									<th>Médico</th>
									<th>Data</th>
									<th>Período</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>

								@if (isset($consultas))
									@if ($consultas->total() < 1)
										<tr>
											<td colspan="7">Nenhum registro encontrado!</td>
										</tr>
									@else
										@foreach ($consultas as $consulta)
												<tr>
													<td>{{ $consulta->codigo_consulta }}</td>
													<td>{{ $consulta->nome_paciente }}</td>
													<td>{{ $consulta->nome_especialidade }}</td>
													<td>{{ $consulta->nome_medico }}</td>
													<td>{{ date('d/m/Y', strtotime($consulta->data)) }}</td>
													<td>{{ $consulta->nome }}</td>  {{-- periodo --}}
													<td>
														<a href="/operador/ver-consulta/{{$consulta->codigo_consulta}}" class="btn btn-info btn-xs"><i class="lnr lnr-eye"></i>  Ver</a>
														<a href="/operador/consultas/gerar-pdf/{{$consulta->codigo_consulta}}" class="btn btn-success btn-xs" target='_blank' id="btn_gerar_pdf"><i class="lnr lnr-printer"></i>   Gerar PDF</a>
													</td>
												</tr>
										@endforeach
									@endif
								@endif
							</tbody>
						</table>
					</div>

					</div>

					@if (isset($consultas))
						@if ($consultas->total() > $consultas->perPage())
							<div class="panel-footer">
								<ul class="pager">
									<li class="previous"><a href="?page=1"><i class="fa fa-arrow-left"></i> Primeira Página</a></li>
									{{ $consultas->links() }}
									<li class="next"><a href="?page={{$consultas->lastPage()}}">Última Página <i class="fa fa-arrow-right"></i></a></li>
								</ul>
							</div>
						@endif
					@endif
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
