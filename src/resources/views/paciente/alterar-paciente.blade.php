@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Cadastro de pacientes</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Alterar Dados do Pacientes</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">

							@if (Session::has('paciente'))
								<form class="" action="{{ action('PacienteController@alterandoPaciente') }}" method="post" id="form-alteracao-paciente">
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
											<input class="form-control" type="text" name="nome_paciente" id="nome-paciente" value="{{ Session::get('paciente')->nome_paciente }}">
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
											<input class="form-control" type="date" name="data_nascimento" id="data-nascimento" value="{{ date('Y-m-d', strtotime(Session::get('paciente')->data_nascimento)) }}">
										</div>
										<div class="col-md-4 form-group">
											<label>Número do CNS:<span class="vermelho">*</span></label>
											<input class="form-control" type="text" name="numero_cns" id="numero_cns" value="{{ Session::get('paciente')->numero_cns }}" disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Nome da Mãe:<span class="vermelho">*</span></label>
											<input class="form-control" type="text" name="nome_mae" id="nome-mae" value="{{ Session::get('paciente')->nome_mae }}">
										</div>
										<div class="col-md-6 form-group">
											<label>Nome da Pai (Opcional):</label>
											<input class="form-control" type="text" name="nome_pai" id="nome-pai" value="{{ Session::get('paciente')->nome_pai }}">
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
											<input type="text" name="rua" id="rua"  class="form-control" value="">
										</div>
										<div class="col-md-4 form-group">
											<label>Número:<span class="vermelho">*</span></label>
											<input type="text" name="numero" id="numero" class="form-control" value="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Complemento:</label>
											<input type="text" name="complemento" id="complemento" class="form-control" value="">
										</div>
										<div class="col-md-6 form-group">
											<label>Bairro:<span class="vermelho">*</span></label>
											<input type="text" name="bairro" id="bairro" class="form-control" value="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label>Cidade:<span class="vermelho">*</span></label>
											<input type="text" name="nome_cidade" id="cidade" class="form-control" value="">
										</div>
										<div class="col-md-4 form-group">
											<label>CEP:<span class="vermelho">*</span></label>
											<input type="text" name="cep" id="cep" class="form-control" value="">
										</div>
										<div class="col-md-2 form-group">
											<label>Estado:<span class="vermelho">*</span></label>
											<input type="text" name="nome_estado" id="estado" class="form-control" value="">
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
											<input type="text" name="telefone_um" id="telefone-um" class="form-control" value="">
										</div>
										<div class="col-md-6 form-group">
											<label>Telefone Adicional (Opicional):</label>
											<input type="text" name="telefone_dois" id="telefone-dois" class="form-control" value="">
										</div>
									</div>
									<div class="row">
										<hr>
									</div>
									<div class="row">
										<div class="col-md-3">
											<button type="submit" class="btn btn-success" id="btn-agendar"><i id="icone_btn_agendar" class="fa fa-check-circle"></i>  Salvar Alterações</button>
										</div>
										<div class="col-md-3">
											<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
										</div>
									</div>
								</div>
							</form>
							@else
								<div class="alert alert-danger alert-dismissible" role="alert">
									<i class="fa fa-times-circle"></i> Nenhum paciente foi selecionado para alterar seus dados cadastrados, selecione o paciente aqui:
									<a href="/operador/buscar-paciente" class="btn btn-default">Buscar Paciente Agora</a>
								</div>
							@endif

						</div>
					</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	  Teste modal
	</button>

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
	        <button type="button" class="btn btn-success"><i id="icone_btn_agendar" class="fa fa-check-circle"></i>  Salvar Alterações</button>
					{{-- <button type="button" class="btn btn-danger" data-dismiss="modal"><i id="icone-btn-cancelar" class="fa fa-times"></i>Cancelar</button> --}}
					<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
	      </div>
	    </div>
	  </div>
	</div>

@endsection
