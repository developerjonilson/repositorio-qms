@extends('layout.layout-administrador')

@section('conteudo')

	<div class="panel panel-profile">
		<div class="clearfix">
			<!-- LEFT COLUMN -->
			<div class="profile-left">
				<!-- PROFILE HEADER -->
				<div class="profile-header">
					<div class="overlay"></div>
					<div class="profile-main">
						<img src="/img/user-medium.png" class="img-circle" alt="Avatar">
						<h3 class="name">Admin</h3>
					</div>
				</div>
				<!-- END PROFILE HEADER -->
				<!-- PROFILE DETAIL -->
				<div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Informações Pessoais</h4>
						<ul class="list-unstyled list-justify">
							<li>CPF <span> 123.456.789-01</span></li>
							<li>RG <span>2349234</span></li>
							<li>Data de Nascimento <span>15/08/1990</span></li>
						</ul>
					</div>
				</div>
				<!-- END PROFILE DETAIL -->
			</div>
			<!-- END LEFT COLUMN -->
			<!-- RIGHT COLUMN -->
			<div class="profile-right">
				<h4 class="heading">Administrador</h4>
				<div class="text-center"><a href="#" class="btn btn-primary">Editar Perfil</a></div>
				<!-- TABBED CONTENT -->
				<div class="custom-tabs-line tabs-line-bottom left-aligned">
					<ul class="nav" role="tablist">
						<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Contato</a></li>
						<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Endereço </a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab-bottom-left1">
						<div class="row">
							<div class="col-md-12">
								<label>Telefone</label>
								<input type="text" class="form-control" name="" value="(88) 98234-9235" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Telefone Adicional</label>
								<input type="text" class="form-control" name="" value="(88) 98234-9234" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Email</label>
								<input type="text" class="form-control" name="" value="thiago@mail.com" disabled>
							</div>
						</div>
						<br><br><br><br>
					</div>
					<div class="tab-pane fade" id="tab-bottom-left2">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Rua</label>
									<input type="text" class="form-control" value="Francisco da Rocha" disabled >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Número</label>
									<input type="text" class="form-control" value="50" disabled >
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label>Bairro</label>
									<input type="text" class="form-control" value="Centro" disabled >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Complemento</label>
									<input type="text" class="form-control" value="" disabled >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Cidade</label>
									<input type="text" class="form-control" value="Milagres" disabled >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Estado</label>
									<input type="text" class="form-control" value="Ceará" disabled >
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END TABBED CONTENT -->
			</div>
			<!-- END RIGHT COLUMN -->
		</div>
	</div>

@endsection
