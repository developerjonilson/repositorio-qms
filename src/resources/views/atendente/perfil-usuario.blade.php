@extends('layouts.layout-atendente')

@section('conteudo')

	<div class="panel panel-profile">
		<div class="clearfix">
			<!-- LEFT COLUMN -->
			<div class="profile-left">
				<!-- PROFILE HEADER -->
				<div class="profile-header">
					<div class="overlay"></div>
					<div class="profile-main">
						<i class="fa fa-user-circle fa-5x"></i>
					</div>
				</div>
				<!-- END PROFILE HEADER -->
				<!-- PROFILE DETAIL -->
				<div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Informações Pessoais</h4>
						<ul class="list-unstyled list-justify">
							<li>
								<div class="form-group">
									<label>CPF</label>
									<input type="text" name="cpf" id="cpf" value="{{ Auth::user()->cpf }}" class="form-control" disabled>
								</div>
							</li>
							<li>
								<div class="form-group">
									<label>RG</label>
									<input type="text" name="rg" id="rg" value="{{ Auth::user()->rg }}" class="form-control" disabled>
								</div>
							</li>
							<li>
								<div class="form-group">
									<label>Data de Nascimento</label>
									<input type="text" name="data_nascimento" id="data_nascimento" value="{{ date('d/m/Y', strtotime(Auth::user()->data_nascimento)) }}" class="form-control" disabled>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- END PROFILE DETAIL -->
			</div>
			<!-- END LEFT COLUMN -->
			<!-- RIGHT COLUMN -->
			<div class="profile-right">
				<h4 class="heading">{{ Auth::user()->name }}</h4>
				@if (isset($status) && $status === 1)
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> Informações foram alteradas com sucesso!
					</div>
				@else
					@if (isset($status) && $status === 2)
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-times-circle"></i> Erro inesperado, por favor tente em instantes!
						</div>
					@endif
				@endif
				<div class="text-center">
					<div class="hidden" id="riquired-fields">
						<span class="vermelho">(*) Os campos abaixos são obrigatórios</span>
					</div>
					<button type="button" name="button" id="btn-edit-profile" class="btn btn-primary">
						<i class="fa fa-pencil-square-o"></i>  Editar Perfil
					</button>
				</div>
				<!-- TABBED CONTENT -->
				<form class="" action="{{ action('AtendenteController@alterProfile')}}" method="post" id="edit-profile">
					{{ csrf_field() }}
					<input type="hidden" name="telefone_id" id="telefone_id" value="{{ $telefone->id_telefone }}">
					<input type="hidden" name="endereco_id" id="endereco_id" value="{{ $endereco->id_endereco }}">
					<div class="custom-tabs-line tabs-line-bottom left-aligned">
						<ul class="nav" role="tablist">
							<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Contato</a></li>
							<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Endereço </a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab-bottom-left1">
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Telefone<span class="vermelho hidden riquired-fields">*</span></label>
									<input type="text" name="telefone_um" id="telefone_um" class="form-control" value="{{ $telefone->telefone_um }}" placeholder="Em Branco" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Telefone Adicional</label>
									<input type="text" name="telefone_dois" id="telefone_dois" class="form-control" value="{{ $telefone->telefone_dois }}"  placeholder="Em Branco" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Email</label>
									<input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" disabled>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="tab-bottom-left2">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Rua<span class="vermelho hidden riquired-fields">*</span></label>
										<input type="text" id="rua" name="rua" class="form-control campo" value="{{ $endereco->rua }}" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Número<span class="vermelho hidden riquired-fields">*</span></label>
										<input type="text" id="numero" name="numero" class="form-control" value="{{ $endereco->numero }}" disabled>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label>Bairro<span class="vermelho hidden riquired-fields">*</span></label>
										<input type="text" id="bairro" name="bairro" class="form-control campo" value="{{ $endereco->bairro }}" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Complemento</label>
										<input type="text" id="complemento" name="complemento" class="form-control campo" value="{{ $endereco->complemento }}" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Cidade<span class="vermelho hidden riquired-fields">*</span></label>
										<input type="text" id="cidade" name="cidade" class="form-control campo" value="{{ $cidade->nome_cidade }}" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Estado<span class="vermelho hidden riquired-fields">*</span></label>
										<input type="text" id="estado" name="estado" class="form-control campo" value="{{ $estado->nome_estado }}" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row hidden" id="buttons-edit">
						<span class="col-md-1"></span>
						<div class="col-md-5">
							<button type="submit" id="edit-confirmation" class="btn btn-success">
								 <i class="fa fa-check-circle"></i>  Salvar Alterações
							 </button>
						</div>
						<span class="col-md-1"></span>
						<div class="col-md-5">
							<a class="btn btn-danger" id="cancel" href="/atendente/perfil">
								<i class="fa fa-times"></i>  Cancelar
							</a>
						</div>
					</div>
				</form>
				<!-- END TABBED CONTENT -->
			</div>
			<!-- END RIGHT COLUMN -->
		</div>
	</div>

@endsection
