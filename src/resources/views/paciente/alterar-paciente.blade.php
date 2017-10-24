@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Cadastro de pacientes</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					@if (Session::has('paciente'))
						<a href="/operador/ver-paciente/{{ Session::get('paciente')->id }}" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					@else
						<a href="/operador/pesquisar-pacientes" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					@endif
					<hr>
					<h3 class="panel-title">Alterar Dados do Paciente</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<div class="row">
						@if (Session::has('stat') && Session::get('stat') === '1')
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Por favor preencha todos os campos obrigatórios!
							</div>
						@endif
						@if (Session::has('stat') && Session::get('stat') === '3')
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Esse número de <b>CPF</b> já está cadastrado!
							</div>
						@endif
						@if (Session::has('stat') && Session::get('stat') === '4')
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i> Esse número de <b>RG</b> já está cadastrado!
							</div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-12">

							@if (Session::has('paciente'))
								<form class="" action="{{ action('PacienteController@alterandoPaciente') }}" method="post" id="form-alteracao-paciente" name="form-alteracao-paciente">
									{{ csrf_field() }}
									<input type="hidden" name="paciente_id" id="paciente_id" value="{{ Session::get('paciente')->id }}">
									<input type="hidden" name="endereco_id" id="endereco_id" value="{{ Session::get('paciente')->endereco_id }}">
									<input type="hidden" name="cidade_id" id="cidade_id" value="{{ Session::get('paciente')->cidade_id }}">
									<input type="hidden" name="estado_id" id="estado_id" value="{{ Session::get('paciente')->estado_id }}">
									<input type="hidden" name="telefone_id" id="telefone_id" value="{{ Session::get('paciente')->telefone_id }}">
									<div class="row">
										<hr>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h4>Informações Pessoais</h4>
										</div>
										<div class="col-md-12 form-group">
											<input class="form-control campo" type="text" name="nome_paciente" id="nome_paciente"
											title="Informe neste campo o nome completo do paciente" value="{{ Session::get('paciente')->nome_paciente }}">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 form-group">
											<label>Sexo:<span class="vermelho">*</span></label>
											@if (Session::get('paciente')->sexo === 'masculino' || Session::get('paciente')->sexo === 'MASCULINO' || Session::get('paciente')->sexo === 'Masculino')
												<select class="form-control" name="sexo" id="sexo" title="Selecione o sexo do paciente que está sendo cadastrado">
													<option value="" disabled>SELECIONE...</option>
													<option value="MASCULINO" selected>MASCULINO</option>
													<option value="FEMININO">FEMININO</option>
												</select>
											@else
												<select class="form-control" name="sexo" id="sexo" title="Selecione o sexo do paciente que está sendo cadastrado">
													<option value="" disabled>SELECIONE...</option>
													<option value="MASCULINO">MASCULINO</option>
													<option value="FEMININO" selected>FEMININO</option>
												</select>
											@endif

										</div>
										<div class="col-md-4 form-group">
											<label>Data de Nascimento:<span class="vermelho">*</span></label>
											<input class="form-control" type="date" name="data_nascimento" id="data_nascimento" value="{{ date('Y-m-d', strtotime(Session::get('paciente')->data_nascimento)) }}" title="Informe a data de nascimento do paciente">
										</div>
										<div class="col-md-4 form-group">
											<label>Número do CNS:<span class="vermelho">*</span></label>
											<input class="form-control" type="text" name="numero_cns" id="numero_cns" title="Informe a numeração do Cartão Nacional da Saúde"  value="{{ Session::get('paciente')->numero_cns }}" readonly>
										</div>
									</div>
									<div class="row">
										@if ( Session::get('paciente')->cpf != null)
											<div class="col-md-6 form-group">
												<label>CPF (Opcional):</label>
												<input class="form-control" type="text" name="cpf" id="cpf" value="{{ Session::get('paciente')->cpf }}" readonly>
											</div>
										@else
											<div class="col-md-6 form-group">
												<label>CPF (Opcional):</label>
												<input class="form-control" type="text" name="cpf" id="cpf" title="Se o paciente estiver com CPF em mãos, por favor informe a numeração presente no mesmo (CPF)!" placeholder="000.123.890-98">
											</div>
										@endif
										@if (Session::get('paciente')->rg != null)
											<div class="col-md-6 form-group">
												<label>RG (Opcional):</label>
												<input class="form-control" type="text" name="rg" id="rg" value="{{ Session::get('paciente')->rg }}" readonly>
											</div>
										@else
											<div class="col-md-6 form-group">
												<label>RG (Opcional):</label>
												<input class="form-control" type="text" name="rg" id="rg" placeholder="2007147335" title="Se o paciente estiver com RG em mãos, por favor informe a numeração presente no mesmo (RG)!">
											</div>
										@endif

									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Nome da Mãe:<span class="vermelho">*</span></label>
											<input class="form-control campo" type="text" name="nome_mae" id="nome_mae" value="{{ Session::get('paciente')->nome_mae }}">
										</div>
										<div class="col-md-6 form-group">
											<label>Nome da Pai (Opcional):</label>
											<input class="form-control campo" type="text" name="nome_pai" id="nome_pai" placeholder="Não Preenchido" value="{{ Session::get('paciente')->nome_pai }}">
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
											<input class="form-control campo" type="text" name="rua" id="rua" value="{{ Session::get('paciente')->rua }}">
										</div>
										<div class="col-md-4 form-group">
											<label>Número:<span class="vermelho">*</span></label>
											<input class="form-control" type="text" name="numero" id="numero" value="{{ Session::get('paciente')->numero }}">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Complemento:</label>
											<input class="form-control campo" type="text" name="complemento" id="complemento" value="{{ Session::get('paciente')->complemento }}"  placeholder="Em Branco">
										</div>
										<div class="col-md-6 form-group">
											<label>Bairro:<span class="vermelho">*</span></label>
											<input class="form-control campo" type="text" name="bairro" id="bairro" value="{{ Session::get('paciente')->bairro }}">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Cidade:<span class="vermelho">*</span></label>
											<input class="form-control campo" type="text" name="nome_cidade" id="cidade" value="{{ Session::get('paciente')->nome_cidade }}">
										</div>
										<div class="col-md-4 form-group">
											<label>CEP:<span class="vermelho">*</span></label>
											<input class="form-control" type="text" name="cep" id="cep" value="{{ Session::get('paciente')->cep }}">
										</div>
										<div class="col-md-2 form-group">
											<label>Estado:<span class="vermelho">*</span></label>
											<input class="form-control campo" type="text" name="nome_estado" id="estado" value="{{ Session::get('paciente')->nome_estado }}" readonly>
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
											<input type="text" name="telefone_um" id="telefone_um" class="form-control" value="{{ Session::get('paciente')->telefone_um }}" placeholder="Em Branco">
										</div>
										<div class="col-md-6 form-group">
											<label>Telefone Adicional (Opicional):</label>
											<input type="text" name="telefone_dois" id="telefone_dois" class="form-control" value="{{ Session::get('paciente')->telefone_dois }}"  placeholder="Em Branco">
										</div>
									</div>
									<div class="row">
										<hr>
									</div>
									<div class="row">
										<div class="col-md-3">
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
												<i id="icone_btn_agendar" class="fa fa-check-circle"></i>  Salvar Alterações
											</button>
										</div>
										<span class="col-md-1"></span>
										<div class="col-md-3">
											<a href="{{ action('PacienteController@pesquisarPacientes') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
										</div>
									</div>
								</div>
							</form>
							@else
								<div class="alert alert-danger alert-dismissible" role="alert">
									<i class="fa fa-times-circle"></i> Nenhum paciente foi selecionado para alterar seus dados cadastrados, selecione o paciente aqui:
									<a href="/operador/pesquisar-pacientes" class="btn btn-default">Buscar Paciente Agora</a>
								</div>
							@endif

						</div>
					</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Confirmação</h4>
	      </div>
	      <div class="modal-body">
	        Tem certeza que deseja alterar os dados desse paciente?
	      </div>
	      <div class="modal-footer">
	        <button type="submit" form="form-alteracao-paciente" class="btn btn-success" id="btn-salvar-alteracao"><i id="icone_btn_agendar" class="fa fa-check-circle"></i>  Salvar Alterações</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>

@endsection
