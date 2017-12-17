@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Buscar paciente</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Manual de Operador do QMS</h3>
					<p class="panel-subtitle">Aqui abaixo você pode ver o manual de utilização do sistema QMS</p>
					<hr>
				</div>
				<div class="panel-body">
					<div class="container">
						<div class="row">

							<div class="center" align="center">
								<iframe class="manual" src="/docs/manual_atendente.pdf" width="1000" height="500" style="border: none;" align="middle"></iframe>
							</div>
							
						</div>
					</div>
				</div>
			</div>

	</div>
</div>

@endsection
