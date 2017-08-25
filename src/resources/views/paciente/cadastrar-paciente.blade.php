@extends('layout.layout-operador')

@section('conteudo')

	<h3 class="page-title">Cadastro de pacientes</h3>
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Dados do paciente</h3>
					<p class="panel-subtitle">Todos os campos abaixo são obrigatórios</p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h4>Nome do paciente:</h4><input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h4>Sexo:</h4>
							<select class="form-control">
								<option value="cheese">Selecione</option>
								<option value="tomatoes">Masculino</option>
								<option value="mozarella">Feminino</option>
							</select>
						</div>
						<div class="col-md-3">
							<h4>Data de nascimento:</h4><input class="form-control" type="date" name="" value="">
						</div>
						<div class="col-md-4">
								<h4>Número do CNS:</h4><input class="form-control" type="number" name="" value="" placeholder="Nome completo">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Responsável pelo paciente:</h4><input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i> Cadastrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
