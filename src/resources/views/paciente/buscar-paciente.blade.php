@extends('layout.layout-operador')

@section('conteudo')

	<h3 class="page-title">Buscar paciente</h3>
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Dados do paciente</h3>
					<p class="panel-subtitle">O campo abaixo é obrigatórios</p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<h4>Informe o CNS:</h4><input class="form-control" type="number" name="" value="" placeholder="">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h4>Paciente:</h4><div class="form-control">Carlos Henrique Matias</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h4>Sexo:</h4>
							<div class="form-control">
								Masculino
							</div>
						</div>
						<div class="col-md-3">
							<h4>Data de nascimento:</h4>
							<div class="form-control">
								28/01/1997
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<h4>Número de consultas agendadas:</h4>
							<div class="form-control">
								2
							</div>
						</div>
					</div>

			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>
</div>

@endsection
