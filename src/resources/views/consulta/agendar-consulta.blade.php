@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Agendamento de Consulta Médica</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<hr>
						{{-- @if (isset($paciente)) --}}
						@if (Session::has('paciente'))
							<div class="col-md-8 form-group">
								<label>Nome do Paciente</label>
								<input type="text" class="form-control" name="nome_paciente" id="nome_paciente" value="{{ Session::get('paciente')->nome_paciente }}" readonly>
							</div>
							<div class="col-md-4 form-group">
								<label>Número CNS</label>
								<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="{{ Session::get('paciente')->numero_cns }}" readonly>
							</div>
						@else
							<div class="alert alert-danger alert-dismissible" role="alert">
								<i class="fa fa-times-circle"></i> Nenhum paciente foi selecionado, selecione o paciente aqui:
								<a href="/operador/buscar-paciente" class="btn btn-default">Buscar Paciente Agora</a>
							</div>
						@endif
					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
			@if (Session::has('paciente'))
				<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Informações da consulta</h3>
						<p class="panel-subtitle"><span class="vermelho">(*) Campo Obrigatório</span></p>
					</div>
					<div class="panel-body">
						<form class="" action="#" method="post" id="form-especialidade-consulta" name="form-especialidade-consulta">
							<input type="hidden" name="paciente_id" value="{{ Session::get('paciente')->id }}">
							<div class="row">
								<hr>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Especialidade:<span class="vermelho">*</span></label>
									<select class="form-control" name="nome_especialidade" id="nome_especialidade">
										@foreach (session('especialidades') as $especialidade)
											<option value="{{ $especialidade->id }}">{{ $especialidade->nome_especialidade }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Nome do médico:<span class="vermelho">*</span></label>
									<select class="form-control" name="nome_medico" id="nome_medico" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Data da consulta:<span class="vermelho">*</span></label>
									<select class="form-control" name="data_consulta" id="data_consulta" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
								<div class="col-md-6 form-group">
									<label>Período:<span class="vermelho">*</span></label>
									<select class="form-control" name="periodo" id="periodo" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Local:<span class="vermelho">*</span></label>
									<input class="form-control" type="text" name="nome_fantasia" id="nome_fantasia" readonly>
									</select>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
										<i id="icone_btn_agendar" class="fa fa-calendar-check-o"></i>  Agendar consulta
									</button>
								</div>
								<div class="col-md-3">
									<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			@endif
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
	        Tem certeza que deseja agendar essa consulta?
	      </div>
	      <div class="modal-footer">
	        <button type="submit" form="form-agendar-consulta" class="btn btn-success"><i id="icone_btn_agendar" class="fa fa-check-circle"></i>  Salvar Alterações</button>
					<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
	      </div>
	    </div>
	  </div>
	</div>


@endsection

@section('post-script')
	<script type="text/javascript">
		$('#')
	</script>
@endsection
