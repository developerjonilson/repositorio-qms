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
					<form class="" action="{{ action('ConsultaController@filtrarConsultas')}}" method="get">
						{{-- {{ csrf_field() }} --}}
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
						</div>

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
												<a href="/operador/consultas/gerar-pdf/{{$consulta->codigo_consulta}}" class="btn btn-success btn-xs" target='_blank' id="btn_gerar_pdf"><i class="lnr lnr-printer"></i>   Gerar PDF</a>
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

@endsection
