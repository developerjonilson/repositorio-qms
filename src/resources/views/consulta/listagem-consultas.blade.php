@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Listagem de Consultas</h3>
					<hr>
					<h4 class="">Filtrar Por</h4>
				</div>
				<div class="panel-body">
					<form class="" action="{{ action('ConsultaController@filtrarConsultas')}}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Especialidade:</label>
									<select class="form-control" name="especialidade" id="especialidade">
										@foreach ($especialidades as $especialidade)
											<option value="{{$especialidade->id}}"> {{$especialidade->nome_especialidade}} </option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Data:</label>
									<input type="date" name="data" id="data" value="" class="form-control">
								</div>
							</div>
							{{-- <div class="col-sm-6">
								<div class="form-group">
									<label>Médico:</label>
									<select class="form-control" name="medico">
											<option value="Pedro" selected>Pedro</option>
											<option value="Paulo">Paulo Francisco</option>
									</select>
								</div>
							</div> --}}
						</div>

						{{-- <div class="row">


							 <div class="col-sm-6">
								<div class="form-group">
									<label>Periodo:</label>
									<select class="form-control" name="especialidade">
											<option value="pediatria" selected>Pediatria</option>
											<option value="ortopedia e traumatologia">Ortopedia e Traumatologia</option>
									</select>
								</div>
							</div>
						</div>  --}}

						<div class="row">
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>

	{{-- <div class="row">
		<div class="container">
	    @foreach ($pacientes as $paciente)
	        {{ $paciente->nome_paciente }}
	    @endforeach
		</div>

		{{ $pacientes->links() }}
	</div> --}}

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Consultas</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<table class="table">
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
											<td>{{ $consulta->nome }}</td>  {{-- periodo --}}
											<td>
												<a href="/operador/buscar-uma-consulta-dois/{{$consulta->codigo_consulta}}" class="btn btn-info btn-xs"><i class="lnr lnr-eye"></i>  Ver</a>
												{{-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="lnr lnr-eye"></i>  Ver</button> --}}
												{{-- <button type="button" class="btn btn-info btn-xs"><i class="lnr lnr-eye"></i>   Ver</button> --}}
												{{-- <button type="button" class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i>   Editar</button> --}}
												<a href="/operador/consultas/gerar-pdf/{{$consulta->codigo_consulta}}" class="btn btn-success btn-xs" target='_blank'><i class="lnr lnr-printer"></i>   Gerar PDF</a>
											</td>
										</tr>
								@endforeach



							</tbody>
						</table>
					</div>

					</div>
					<div class="panel-footer">
						<div class=""  id="navigation">
							{{ $consultas->links() }}
						</div>
					</div>

				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>


		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
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
