@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Cadastro de pacientes</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Cadastro de pacientes</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<form class="" action="index.html" method="post">

					</form>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Nome do paciente:<span class="vermelho">*</span></h4>
							<input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h4>Sexo:<span class="vermelho">*</span></h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="masculino">Masculino</option>
								<option value="feminino">Feminino</option>
							</select>
						</div>
						<div class="col-md-4">
							<h4>Data de nascimento:<span class="vermelho">*</span></h4>
							<input class="form-control" type="date" name="" value="">
						</div>
						<div class="col-md-4">
								<h4>Número do CNS:<span class="vermelho">*</span></h4>
								<input class="form-control" type="number" name="" value="" placeholder="Nome completo">
						</div>
					</div>
					{{-- isso só deve aparecer se o paciente for menor de 18 anos --}}
					{{-- <div class="row">
						<div class="col-md-12">
							<h4>Responsável pelo paciente:</h4><input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
					</div> --}}
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6">
								<h4>Nome da Mãe:<span class="vermelho">*</span></h4>
								<input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
						<div class="col-md-6">
								<h4>Nome da Pai:</h4>
								<input class="form-control" type="text" name="" value="" placeholder="Nome completo">
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-8">
							<h4>Rua:<span class="vermelho">*</span></h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
						<div class="col-md-4">
							<h4>Número:<span class="vermelho">*</span></h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Complemento:</h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
						<div class="col-md-6">
							<h4>Bairro:<span class="vermelho">*</span></h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Cidade:<span class="vermelho">*</span></h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
						<div class="col-md-4">
							<h4>Estado:<span class="vermelho">*</span></h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Telefone Principal:</h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
						<div class="col-md-6">
							<h4>Telefone Adicional:</h4>
							<input type="text" name="rua" placeholder="Teste" class="form-control">
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="lnr lnr-checkmark-circle"></i> Cadastrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
