@extends('layout.layout-operador')

@section('conteudo')

	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Visão Geral</h3>
			<p class="panel-subtitle">Período: Desde da implantação do QMS</p>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-users"></i></span>
						<p>
							<span class="number">12</span>
							<span class="title">Pacientes</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-stethoscope 5x"></i></span>
						<p>
							<span class="number">20</span>
							<span class="title">Consultas</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-calendar-check-o"></i></span>
						<p>
							<span class="number">10</span>
							<span class="title">Calendários</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-user-md"></i></span>
						<p>
							<span class="number">10</span>
							<span class="title">Médicos</span>
						</p>
					</div>
				</div>
			</div>
			<div class="row">

				colocar alguma coisa aqui
			</div>
		</div>
	</div>

@endsection
