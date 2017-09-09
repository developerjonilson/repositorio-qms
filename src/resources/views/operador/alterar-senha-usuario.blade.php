@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Alterar senha de usuário</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Todos os campos abaixo são obrigatórios</span></p>
					<p class="panel-subtitle"><label>A nova senha deve conter no mínimo de 6 caracteres</label></p>
				</div>
				<div class="panel-body">
					<div class="mensagens">
						{{-- <div class="alert alert-success" role="alert">
							alguma coisa
						</div> --}}
					</div>

					<form class="" action="#" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Senha atual:<span class="vermelho">*</span></label>
									<input class="form-control campo" type="password" name="senha_atual" id="senha_atual" placeholder="******" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nova senha:<span class="vermelho">*</span></label>
									<input class="form-control campo" type="password" name="nova_senha" id="nova_senha" placeholder="******" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Confirmar nova senha:<span class="vermelho">*</span></label>
									<input class="form-control campo" type="password" name="confirma_nova_senha" id="confirma_nova_senha" placeholder="******" required>
								</div>
							</div>
						 </div><br>
						 <div class="row">
							 <div class="col-md-2">
								 <button id="enviar" type="submit" class="btn btn-success"><i id="icone-btn" class="fa fa-check-circle"></i> Salvar alterações</button>
							 </div>
						 </div>
					</form>					
				</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

@endsection
