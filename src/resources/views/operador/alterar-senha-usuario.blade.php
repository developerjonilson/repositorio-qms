@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Alterar senha de usuário</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Todos os campos abaixo são obrigatórios</span></p>
					<p class="panel-subtitle"><label>A nova senha deve conter no mínimo de 8 caracteres</label></p>
				</div>
				<div class="panel-body">
					<div class="mensagens">
						@if ($errors->has('equal-password'))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> A nova senha não pode ser igual a anterior!
							</div>
		        @endif
						@if ($errors->has('min-password'))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Senhas menores que o mínimo permitido!
							</div>
		        @endif
						@if ($errors->has('password'))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Senha atual incorreta ou as novas senhas não coincidem!
							</div>
		        @endif
						@if ($errors->has('less-password'))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Erro inesperado, por favor entre em contato com algum Administrador do sistema QMS!
							</div>
		        @endif
					</div>
					<form class="" action="{{ action('OperadorController@updateSenha') }}" method="post" id="form-change-password">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Senha atual:<span class="vermelho">*</span></label>
									<input class="form-control campo" type="password" name="senha_atual" id="senha_atual" placeholder="******" required autofocus>
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
