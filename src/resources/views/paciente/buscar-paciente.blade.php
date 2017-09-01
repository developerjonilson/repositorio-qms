@extends('layout.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Buscar paciente</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Buscar paciente</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) O campo abaixo é obrigatório</span></p>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<h4>Informe o CNS:<span class="vermelho">*</span></h4>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary"><i class="lnr lnr-magnifier"></i>    Buscar</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Dados do Paciente</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						<h4>Paciente:</h4>
						<div class="form-control">Carlos Henrique Matias</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Sexo:</h4>
						<div class="form-control">
							Masculino
						</div>
					</div>
					<div class="col-md-4">
						<h4>Data de nascimento:</h4>
						<div class="form-control">
							28/01/1997
						</div>
					</div>
				</div>
				<div class="row">
					<hr>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-success"><i class="lnr lnr-checkmark-circle"></i>      Agendar Consulta</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection
