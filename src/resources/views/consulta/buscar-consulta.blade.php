@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Checar consulta</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Buscar consultas por paciente</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) O campo abaixo é obrigatório</span></p>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<h4>Informe o CNS:<span class="vermelho">*</span></h4>
							<form class="" action="{{ action('ConsultaController@buscarConsulta') }}" method="post" id="search-paciente">
								{{ csrf_field() }}
								<div class="input-group">
									<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="123456789012345">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-primary" id="btn-search-paciente"><i class="fa fa-search" id="icone-btn-search-paciente"></i>    Buscar</button>
									</span>
								</div>
							</form>

						</div>
					</div>

					@isset($consultas)
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4>Paciente:</h4>
								<input type="text" class="form-control" value="{{$paciente->nome_paciente}}" readonly>
							</div>
							<div class="col-md-3">
								<h4>CNS:</h4>
								<input type="text" class="form-control" value="{{$paciente->numero_cns}}" readonly>
							</div>
							<div class="col-md-3">
								<h4>CPF:</h4>
								<input type="text" class="form-control" value="{{$paciente->cpf}}" readonly>
							</div>
						</div>
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<table class="table table-striped">
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
									@foreach ($consultas as $consulta)
											<tr>

												<td>{{ $consulta->codigo_consulta }}</td>
												<td>{{ $consulta->nome_paciente }}</td>
												<td>{{ $consulta->nome_especialidade }}</td>
												<td>{{ $consulta->nome_medico }}</td>
												<td>{{ date('d/m/Y', strtotime($consulta->data)) }}</td>
												<td>{{ $consulta->nome }}</td>  {{--Periodo --}}
												<td>
													<a href="/operador/buscar-uma-consulta/{{$consulta->codigo_consulta}}" class="btn btn-info btn-xs"><i class="lnr lnr-eye"></i>  Ver</a>
													{{-- <button type="button" class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i>   Editar</button> --}}
													<a href="/operador/consultas/gerar-pdf/{{$consulta->codigo_consulta}}" class="btn btn-success btn-xs" target='_blank'><i class="lnr lnr-printer"></i>   Gerar PDF</a>
												</td>
											</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="row"  id="navigation">
							{{ $consultas->links() }}
						</div>

				</div>

					@endisset
			<!-- END PANEL HEADLINE -->
		</div>

	</div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="myModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Visualização de Consulta Agendada</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-md-8 form-group">
						<label>Nome do Paciente</label>
						<input type="text" class="form-control" name="nome_paciente" id="nome_paciente" value="" readonly>
					</div>
					<div class="col-md-4 form-group">
						<label>Número CNS</label>
						<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="" readonly>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Especialidade:</label>
						<input type="text" class="form-control" name="especialidade" id="especialidade" value="" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Medico:</label>
						<input type="text" class="form-control" name="medico" id="medico" value="" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label>Data da consulta:</label>
						<input type="text" class="form-control" name="data_consulta" id="data_consulta" value="" disabled>
					</div>
					<div class="col-md-6 form-group">
						<label>Periodo:</label>
						<input type="text" class="form-control" name="periodo" id="periodo" value="" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Local:</label>
						<input type="text" class="form-control" name="local_nome_fantasia" id="local_nome_fantasia" value="" disabled>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="lnr lnr-cross-circle"></i>  Fechar</button>
				<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
				<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
