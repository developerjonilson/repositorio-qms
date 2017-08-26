@extends('layout.layout-operador')

@section('conteudo')

	<h3 class="page-title">Editar informações</h3>
	<div class="panel-heading">
		<p class="panel-subtitle">Ao término das alterações clique no botão <i class="fa fa-database"></i> salvar alterações</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Pessoal</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h4>Nome do Operador:</h4><div class="form-control">Carlos Henrique Matias</div>
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
					<h3 class="panel-title">Endereço</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-10">
							<h4>Rua:</h4><input class="form-control" type="text" name="" value="" placeholder="">
						</div>
						<div class="col-md-4">
							<h4>Bairro:</h4><input class="form-control" type="text" name="" value="" placeholder="">
						</div>
						<div class="col-md-2">
							<h4>Número:</h4><input class="form-control" type="text" name="" value="" placeholder="">
						</div>
						<div class="col-md-2">
							<h4>Cidade:</h4><input class="form-control" type="text" name="" value="" placeholder="">
						</div>
						<div class="col-md-2">
							<h4>Estado:</h4><select class="form-control">
								<option value="cheese">Selecione</option>
								<option value="tomatoes">CE</option>
								<option value="mozarella">PB</option>
								<option value="tomatoes">SP</option>
								<option value="mozarella">PR</option>
							</select>
						</div>
					</div>

					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Contato</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-10">
								<h4>Telefone fixo:</h4><input class="form-control" type="number" name="" value="" placeholder="Ex: (00)0000-0000">
							</div>
							<div class="col-md-4">
								<h4>Celular:</h4><input class="form-control" type="text" name="" value="" placeholder="Ex: (00)00000-0000">
							</div>
							<div class="col-md-2">
								<h4>Email:</h4><input class="form-control" type="email" name="" value="" placeholder="Ex: exemplo@email.com">
							</div>
						</div><br>
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-database"></i> Salvar alterações</button>
						</div>
					</div>
			</div>
		</div>

		</div>

@endsection
