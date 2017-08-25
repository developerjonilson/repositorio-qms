@extends('layout.layout-operador')

@section('conteudo')

	<h3 class="page-title">Relatório mensal</h3>
	{{-- <div class="panel-heading">
		<p class="panel-subtitle">Selecione o mês e o ano desejado, ao término clique no botão "Gerar relatório".</p>
	</div> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Dados para o relatório</h3>
					<p class="panel-subtitle">Todos os campos abaixo são obrigatórios</p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<h4>Mês:</h4><select class="form-control">
								<option value="cheese">Selecione</option>
								<option value="tomatoes">Janeiro</option>
								<option value="mozarella">Fevereiro</option>
								<option value="tomatoes">Março</option>
								<option value="mozarella">Abril</option>
								<option value="tomatoes">Maio</option>
								<option value="mozarella">Junho</option>
								<option value="tomatoes">Julho</option>
								<option value="mozarella">Agosto</option>
								<option value="tomatoes">Setembro</option>
								<option value="mozarella">Outubro</option>
								<option value="tomatoes">Novembro</option>
								<option value="mozarella">Dezembro</option>
							</select>
						</div>

						<div class="col-md-2">
							<h4>Ano</h4>
							<input class="form-control" type="text" name="" value="" placeholder="2017">
						</div>
						<div class="col-md-1">

						</div>
						<div class="col-md-2">
							<h4>Ação</h4>
							<button type="button" class="btn btn-primary"><i class="fa fa-line-chart"></i> Gerar Relatório</button>
						</div>
					</div>

					<br>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Consultas do mês selecionado</h3>
				</div>
				<div class="panel-body">
					<div class="row">
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
								<button type="button" class="btn btn-success"><i class="fa fa-line-chart"></i> Imprimir Relatório Completo</button>
							</div>
						</div>

					</div>

					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
