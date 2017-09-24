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
						@isset($erro)
							@if ($erro === '1')
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-times-circle"></i> Por favor preencha todos os campos corretamente!
								</div>
							@else
								@if ($erro === '2')
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Já foi agendada uma consulta para esse paciente nesse mesmo dia e periodo!
									</div>
								@else
									@if ($erro === '3')
										<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<i class="fa fa-times-circle"></i> Erro ao agendar consulta, não tem mais vagas disponiveis!
										</div>
									@else
										<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<i class="fa fa-times-circle"></i> Erro ao agendar consulta, por favor tente em instantes!
										</div>
									@endif
								@endif
							@endif
						@endisset
					</div>
					<div class="row">
						<hr>
						@if (isset($paciente))
							<div class="col-md-8 form-group">
								<label>Nome do Paciente</label>
								<input type="text" class="form-control" name="nome_paciente" id="nome_paciente" value="{{$paciente->nome_paciente }}" readonly>
							</div>
							<div class="col-md-4 form-group">
								<label>Número CNS</label>
								<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="{{ $paciente->numero_cns }}" readonly>
							</div>
						@else
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
									<a href="/operador/buscar-paciente" class="btn btn-default"><i class="fa fa-search"></i> Buscar Paciente Agora</a>
								</div>
							@endif
						@endif
					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
			@if (isset($paciente))
				<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Informações da consulta</h3>
						<p class="panel-subtitle"><span class="vermelho">(*) Campo Obrigatório</span></p>
					</div>
					<div class="panel-body">
						<form class="" action="{{ action('ConsultaController@agendandoConsulta') }}" method="post" id="form-agendar-consulta" name="form-agendar-consulta">
							{{ csrf_field() }}
							<input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
							<div class="row">
								<hr>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Especialidade:<span class="vermelho">*</span></label>
									<select class="form-control" name="especialidade" id="especialidade">
										<option value="" disabled selected>Selecione...</option>
										@foreach ($especialidades as $especialidade)
											<option value="{{ $especialidade->id }}">{{ $especialidade->nome_especialidade }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Nome do médico:<span class="vermelho">*</span></label>
									<select class="form-control" name="medico" id="medico" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 form-group">
									<label>Data da consulta:<span class="vermelho">*</span></label>
									<select class="form-control" name="data_consulta" id="data_consulta" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
								<div class="col-md-5 form-group">
									<label>Período:<span class="vermelho">*</span></label>
									<select class="form-control" name="periodo" id="periodo" disabled>
										<option value="0">Selecione</option>
									</select>
								</div>
								<div class="col-md-2 form-group">
									<label>Vagas Disponiveís:</label>
									<input type="text" class="form-control" name="vagas" id="vagas" value="" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<input type="hidden" name="local_id" id="local_id" value="">
									<label>Local:</label>
									<input class="form-control" type="text" name="local_nome_fantasia" id="local_nome_fantasia" value="" disabled>
									</select>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-3 col-xs-12 col-sm-12">
									<button type="submit" class="btn btn-success" ><i id="icone_btn_agendar" class="fa fa-calendar-check-o"></i>  Agendar consulta</button>
								</div>
								<div class="col-md-3  col-xs-12 col-sm-12">
									<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			@else
				@if (Session::has('paciente'))
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Informações da consulta</h3>
							<p class="panel-subtitle"><span class="vermelho">(*) Campo Obrigatório</span></p>
						</div>
						<div class="panel-body">

							<form class="" action="{{ action('ConsultaController@agendandoConsulta') }}" method="post" id="form-agendar-consulta" name="form-agendar-consulta">
								{{ csrf_field() }}
								<input type="hidden" name="paciente_id" value="{{ Session::get('paciente')->id }}">
								<div class="row">
									<hr>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Especialidade:<span class="vermelho">*</span></label>
										<select class="form-control" name="especialidade" id="especialidade">
											<option value="" disabled selected>Selecione...</option>
											@foreach (session('especialidades') as $especialidade)
												<option value="{{ $especialidade->id }}">{{ $especialidade->nome_especialidade }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Nome do médico:<span class="vermelho">*</span></label>
										<select class="form-control" name="medico" id="medico" disabled>
											<option value="0">Selecione</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 form-group">
										<label>Data da consulta:<span class="vermelho">*</span></label>
										<select class="form-control" name="data_consulta" id="data_consulta" disabled>
											<option value="0">Selecione</option>
										</select>
									</div>
									<div class="col-md-5 form-group">
										<label>Período:<span class="vermelho">*</span></label>
										<select class="form-control" name="periodo" id="periodo" disabled>
											<option value="0">Selecione</option>
										</select>
									</div>
									<div class="col-md-2 form-group">
										<label>Vagas Disponiveís:</label>
										<input type="text" class="form-control" name="vagas" id="vagas" value="" disabled>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<input type="hidden" name="local_id" id="local_id" value="">
										<label>Local:</label>
										<input class="form-control" type="text" name="local_nome_fantasia" id="local_nome_fantasia" value="" disabled>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-3 col-xs-12 col-sm-12">
										<button type="submit" class="btn btn-success" ><i id="icone_btn_agendar" class="fa fa-calendar-check-o"></i>  Agendar consulta</button>
									</div>
									<div class="col-md-3  col-xs-12 col-sm-12">
										<a href="{{ action('PacienteController@buscarPaciente') }}" class="btn btn-danger" id="btn-cancelar"><i id="icone-btn-cancelar" class="fa fa-times"></i>  Cancelar</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endif
			@endif
		</div>

	</div>


@endsection
