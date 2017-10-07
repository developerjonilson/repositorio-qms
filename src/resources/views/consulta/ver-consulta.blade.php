@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Visualização de Consulta Agendada</h3>
				</div>
				<div class="panel-body">
						<hr>
						@if (isset($consulta))
						<div class="row">
							<div class="col-md-8 form-group">
								<label>Nome do Paciente</label>
								<input type="text" class="form-control" name="nome_paciente" id="nome_paciente" value="{{$consulta->nome_paciente}}" readonly>
							</div>
							<div class="col-md-4 form-group">
								<label>Número CNS</label>
								<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="{{$consulta->numero_cns}}" readonly>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Especialidade:</label>
								<input type="text" class="form-control" name="especialidade" id="especialidade" value="{{$consulta->nome_especialidade}}" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Medico:</label>
								<input type="text" class="form-control" name="medico" id="medico" value="{{$consulta->nome_medico }}" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Data da consulta:</label>
								<input type="text" class="form-control" name="data_consulta" id="data_consulta" value="{{ date('d/m/Y', strtotime($consulta->data)) }}" disabled>
							</div>
							<div class="col-md-6 form-group">
								<label>Periodo:</label>
								<input type="text" class="form-control" name="periodo" id="periodo" value="{{ $consulta->nome }}" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Local:</label>
								<input type="text" class="form-control" name="local_nome_fantasia" id="local_nome_fantasia" value="{{ $consulta->nome_fantasia}}" disabled>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-2">
								<a href="/operador/buscar-consulta/{{$consulta->numero_cns}}" class="btn btn-primary"><i class="fa fa-reply"></i>  Voltar</a>
							</div>
							<div class="col-md-2">
								<a href="/operador/consultas/gerar-pdf/{{$consulta->codigo_consulta}}" class="btn btn-success btn-xs" target='_blank'><i class="lnr lnr-printer"></i>   Gerar PDF</a>
							</div>
						</div>
						@else
							<div class="row">
								<div class="alert alert-danger alert-dismissible" role="alert">
									<i class="fa fa-times-circle"></i> Nenhuma consulta foi agendada por favor realize um agendamento primeiro:
									<a href="/operador/buscar-paciente" class="btn btn-default"><i class="fa fa-search"></i> Buscar Paciente Agora</a>
								</div>
							</div>
						@endif

				</div>
			</div>
			<!-- END PANEL HEADLINE -->

		</div>
	</div>


@endsection
