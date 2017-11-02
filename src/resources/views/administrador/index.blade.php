@extends('layouts.layout-administrador')

@section('conteudo')

	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Visão Geral</h3>
			<p class="panel-subtitle">Período: Desde da implantação do QMS</p>
		</div>
		<div class="panel-body">
			<div class="row">    {{-- div para mensagens de feedback para o usuario --}}
				@if (Session::has("success"))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> Senha alterada com sucesso!
					</div>
				@endif
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-user-o "></i></span>
						<p>
							<span class="number">3</span>
							<span class="title">Atendentes do QMS</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-users"></i></span>
						<p>
							<span class="number">4</span>
							<span class="title">Operadores do QMS</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-user-md"></i></span>
						<p>
							<span class="number">20</span>
							<span class="title">Médicos no QMS</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-calendar-check-o"></i></span>
						<p>
							<span class="number">20</span>
							<span class="title">Calendário Médico</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
