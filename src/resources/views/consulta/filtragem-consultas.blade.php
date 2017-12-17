@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('OperadorController@index') }}">Operador</a></li>
      <li class="active">Resultado de Pesquisa de Consultas</li>
    </ol>
  </div>

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="{{ action('ConsultaController@listagemConsultas') }}" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar </a>
					<br>

					<hr>
					<h3 class="panel-title">Resultado da Pesquisa de Consultas</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<table class="table table-striped table-bordered table-responsive table-hover table-condensed">
							<thead>
								<tr>
									<th>Código</th>
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
