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
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<h4>Informe o CNS:<span class="vermelho">*</span></h4>
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary"><i class="lnr lnr-checkmark-circle"></i>    Buscar</button>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Paciente:</h4><div class="form-control">Carlos Henrique Matias</div>
						</div>
						<div class="col-md-3">
							<h4>CNS:</h4><div class="form-control">1234-1234-1234-1234</div>
						</div>
						<div class="col-md-3">
							<h4>CPF:</h4><div class="form-control">123.456.789-10</div>
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<table class="table">
							<thead>
								<tr>
									<th>ID da consulta</th>
									<th>Data da consulta</th>
									<th>Médico</th>
									<th>Status</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>25/10/2017</td>
									<td>Cícero Pereira</td>
									<td>Em aberto</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>05/08/2017</td>
									<td>Carlos Pedro</td>
									<td>Encerrada</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td>02/02/2017</td>
									<td>Paulo Matias</td>
									<td>Encerrada</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td>02/02/2017</td>
									<td>Paulo Matias</td>
									<td>Encerrada</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>
</div>

@endsection
