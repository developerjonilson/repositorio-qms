@extends('layout.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Relatórios Personalizados</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Relatórios Personalizados</h3>
					<p class="panel-subtitle">Todos os campos abaixo são obrigatórios</p>
				</div>
				<div class="panel-body">
					<div class="row">
						<form class="" action="#" method="post">

	            <div class="col-sm-3">
	              <div class="form-group">
	                <label>Data*</label>
	                <input type="date" name="data" class="form-control">
	              </div>
	            </div>

	            <div class="col-sm-3">
	              <div class="form-group">
	                  <label>Especialidade*</label>
	                  <select class="form-control" name="especialidade">
	                      <option value="pediatria" selected>Pediatria</option>
	                      <option value="ortopedia e traumatologia">Ortopedia e Traumatologia</option>
	                  </select>
	              </div>
	            </div>

	            <div class="col-sm-6">
	              <div class="form-group">
	                  <label>Médico*</label>
	                  <select class="form-control" name="medico">
	                      <option value="Pedro" selected>Pedro</option>
	                      <option value="Paulo">Paulo</option>
	                  </select>
	              </div>
	            </div>

	            <div class="col-sm-4">
	              <button type="button" class="btn btn-primary"><i class="lnr lnr-magnifier"></i> Gerar Relatório</button>
	            </div>

	          </form>
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
					<h3 class="panel-title">Consultas</h3>
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
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>Antônio Pedro</td>
									<td>Pediatria</td>
									<td>Marcos Paulo</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>Cícero Santos</td>
									<td>Cardiologia</td>
									<td>Paulo Matias</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
								<tr>
									<td>Leonardo da Silva</td>
									<td>Anestesiologia</td>
									<td>Henrique Cardoso</td>
									<td>
										<button type="button" class="btn btn-info"><i class="lnr lnr-eye"></i>   Ver</button>
										<button type="button" class="btn btn-warning"><i class="lnr lnr-pencil"></i>   Editar</button>
										<button type="button" class="btn btn-success"><i class="lnr lnr-printer"></i>   Imprimir</button>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="row">
							<div class="col-md-3">
								<button type="button" class="btn btn-success btn-lg"><i class="fa fa-line-chart"></i> Imprimir Relatório Completo</button>
							</div>
						</div>

					</div>

					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
