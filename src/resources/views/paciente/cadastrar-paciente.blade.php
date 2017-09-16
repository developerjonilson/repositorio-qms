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
					<div class="row">
						<div class="col-md-12">
							@if (session('status'))
								@if (session('status') === '1')
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Por favor preencha todos os campos corretamente!
									</div>
								@endif
								@if (session('status') === '2')
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de CNS já foi registrado no sistema!
									</div>
								@endif
								@if (session('status') === '3')
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Data de Nascimento do paciente Inválida!
									</div>
								@endif
								@if (session('status') === '4')
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Erro insperado, tente mais tarde!
									</div>
								@endif
								@if (session('status') === '5')
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Paciente cadastrado com sucesso!
									</div>
								@endif

							@endif
						</div>
					</div>
					<form class="" action="{{ action('PacienteController@createPaciente') }}" method="post" id="form-create-paciente">
						{{ csrf_field() }}
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4>Informações Pessoais</h4>
							</div>
							<div class="col-md-12 form-group">
								<label>Nome do paciente:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="nome_paciente" id="nome-paciente" value="Ana das Neves Silva" placeholder="Paulo da Costa Silva">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Sexo:<span class="vermelho">*</span></label>
								<select class="form-control" name="sexo" id="sexo">
									<option value="0">Selecione</option>
									<option value="masculino" selected>Masculino</option>
									<option value="feminino">Feminino</option>
								</select>
							</div>
							<div class="col-md-4 form-group">
								<label>Data de Nascimento:<span class="vermelho">*</span></label>
								<input class="form-control" type="date" name="data_nascimento" id="data-nascimento" value="2010-09-15">
							</div>
							<div class="col-md-4 form-group">
								<label>Número do CNS:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="numero_cns" id="numero_cns" value="2154123498909893" placeholder="2000.1234.9890.9893">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Nome da Mãe:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="nome_mae" id="nome-mae" value="Ana das Neves" placeholder="Maria da Silva Pereira">
							</div>
							<div class="col-md-6 form-group">
								<label>Nome da Pai (Opcional):</label>
								<input class="form-control" type="text" name="nome_pai" id="nome-pai" value="Francisco Paulo Silva" placeholder="Francisco Pereira">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-12">
								<h4>Endereco</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 form-group">
								<label>Rua:<span class="vermelho">*</span></label>
								<input type="text" name="rua" id="rua"  class="form-control" value="Rua 7 de Setembro" placeholder="Rua 7 de Setembro">
							</div>
							<div class="col-md-4 form-group">
								<label>Número:<span class="vermelho">*</span></label>
								<input type="text" name="numero" id="numero" placeholder="777" value="779" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" placeholder="Casa A" value="Casa B" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Bairro:<span class="vermelho">*</span></label>
								<input type="text" name="bairro" id="bairro" placeholder="Centro" value="Centro" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Cidade:<span class="vermelho">*</span></label>
								<input type="text" name="nome_cidade" id="cidade" placeholder="Milagres" class="form-control" value="Milagres">
							</div>
							<div class="col-md-4 form-group">
								<label>CEP:<span class="vermelho">*</span></label>
								<input type="text" name="cep" id="cep" placeholder="63250-000" class="form-control" value="63250000">
							</div>
							<div class="col-md-2 form-group">
								<label>Estado:<span class="vermelho">*</span></label>
								<input type="text" name="nome_estado" id="estado" placeholder="CE" value="CE" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-12">
								<h4>Telefones</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Telefone Principal (Opicional):</label>
								<input type="text" name="telefone_um" id="telefone-um" placeholder="(88)99999-9988" value="999999955" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Telefone Adicional (Opicional):</label>
								<input type="text" name="telefone_dois" id="telefone-dois" placeholder="(88)99999-9988" value="999999934" class="form-control">
							</div>
						</div>
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="col-md-3">
								<button type="submit" class="btn btn-success" id="btn-cadastrar-paciente"><i id="icone-btn-cadastro-paciente" class="fa fa-check-circle"></i> Cadastrar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
