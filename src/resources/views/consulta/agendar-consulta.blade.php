@extends('layout.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Agendar consulta</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Agendar consulta</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Paciente:</h4><div class="form-control">Carlos Henrique Matias</div>
						</div>
						<div class="col-md-3">
							<h4>CNS:</h4><div class="form-control">1234-1234-1234-1234</div>
						</div>
						<div class="col-md-3">
							<h4>CPF:</h4><div class="form-control">123.456.789-10</div>
						</div>
					</div>
					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h4>Data da consulta:</h4><input class="form-control" type="date" name="" value="">
						</div>
						<div class="col-md-8">
							<h4>Especialidade:</h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="1"></option>
								<option value="2"></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Nome do médico:</h4>
							<select class="form-control">
								<option value="0">Selecione</option>
								<option value="1"></option>
								<option value="2"></option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-success"><i class="fa fa-calendar"></i>   Agendar consulta</button>
						</div>
					</div>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
