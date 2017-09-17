@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Agendar consulta</h3> --}}
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
						@if (Session::has('paciente'))
							<div class="col-md-8 form-group">
								<label>Nome do Paciente</label>
								<input type="text" class="form-control" name="nome_paciente" id="nome_paciente" value="{{ Session::get('paciente')->nome_paciente }}" disabled>
							</div>
							<div class="col-md-4 form-group">
								<label>Número CNS</label>
								<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="{{ Session::get('paciente')->numero_cns }}" disabled>
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
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Informações da consulta</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h4>Período:<span class="vermelho">*</span></h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="manha">Manhã</option>
								<option value="tarde">Tarde</option>
								<option value="noite">Noite</option>
							</select>
						</div>
						<div class="col-md-3">
							<h4>Data da consulta:<span class="vermelho">*</span></h4>
							<input class="form-control" type="date" name="" value="">
						</div>
						<div class="col-md-6">
							<h4>Especialidade:<span class="vermelho">*</span></h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="1"></option>
								<option value="2"></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Nome do médico:<span class="vermelho">*</span></h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="1"></option>
								<option value="2"></option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-calendar-check-o"></i>   Agendar consulta</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection
