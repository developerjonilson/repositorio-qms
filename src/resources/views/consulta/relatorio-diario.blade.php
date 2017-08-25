@extends('layout.layout-operador')

@section('conteudo')

	<h3 class="page-title">Relatório diário de consultas</h3>
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Consultas do dia</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Paciente</th>
								<th>Especialidade</th>
								<th>Médico</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>João Carlos</td>
								<td>Ortopedia</td>
								<td>Cícero Pereira</td>
								<td>
									<button type="button" class="btn btn-default btn-sm">Ver</button>
									<button type="button" class="btn btn-danger btn-sm">Editar</button>
									<button type="button" class="btn btn-success btn-sm">Imprimir</button>
								</td>
							</tr>
							<tr>
								<td>Antônio Pedro</td>
								<td>Pediatria</td>
								<td>Marcos Paulo</td>
								<td>
									<button type="button" class="btn btn-default btn-sm">Ver</button>
									<button type="button" class="btn btn-danger btn-sm">Editar</button>
									<button type="button" class="btn btn-success btn-sm">Imprimir</button>
								</td>
							</tr>
							<tr>
								<td>Cícero Santos</td>
								<td>Cardiologia</td>
								<td>Paulo Matias</td>
								<td>
									<button type="button" class="btn btn-default btn-sm">Ver</button>
									<button type="button" class="btn btn-danger btn-sm">Editar</button>
									<button type="button" class="btn btn-success btn-sm">Imprimir</button>
								</td>
							</tr>
							<tr>
								<td>Leonardo da Silva</td>
								<td>Anestesiologia</td>
								<td>Henrique Cardoso</td>
								<td>
									<button type="button" class="btn btn-default btn-sm">Ver</button>
									<button type="button" class="btn btn-danger btn-sm">Editar</button>
									<button type="button" class="btn btn-success btn-sm">Imprimir</button>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-line-chart"></i> Gerar relatório</button>
						</div>
					</div>

			</div>
			<!-- END PANEL HEADLINE -->
		</div>
	</div>
</div>

@endsection
