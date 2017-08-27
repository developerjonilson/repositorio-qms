@extends('layout.layout-administrador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Alterar senha de usuário</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Todos os campos abaixo são obrigatórios</span></p>
					<p class="panel-subtitle">A nova senha deve conter no mínimo de 6 caracteres</p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<h4>Senha atual:<span class="vermelho">*</span></h4>
							<input class="form-control" type="password" name="" value="" placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Nova senha:<span class="vermelho">*</span></h4>
							<input class="form-control" type="password" name="" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Confirmar nova senha:<span class="vermelho">*</span></h4>
							<input class="form-control" type="password" name="" value="" placeholder="">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-2">
							<button type="button" class="btn btn-success"><i class="lnr lnr-checkmark-circle"></i> Salvar alterações</button>
						</div>
					</div>
				</div><br>

				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
