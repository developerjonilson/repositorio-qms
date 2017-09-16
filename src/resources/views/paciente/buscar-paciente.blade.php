@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Buscar paciente</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Buscar paciente</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) O campo abaixo é obrigatório</span></p>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						@if (session('status'))
							@if (session('status') === '1')
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-times-circle"></i> Por favor preencha o campo corretamente!
								</div>
							@endif
							@if (session('status') === '2')
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-times-circle"></i> O número do Cartão Nacional da Saúde deve ter 15 digitos!
								</div>
							@endif
							@if (session('status') === '3')
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-times-circle"></i> Paciente não cadastro no sistema, se desejar cadastrá-lo agora clique:
									<a href="/operador/cadastrar-paciente" class="btn btn-default">Cadastrar Paciente Agora</a>
								</div>
							@endif
						@endif
					</div>
					<div class="row">
						<div class="col-md-5">

							<h4>Informe o CNS:<span class="vermelho">*</span></h4>
							<form class="" action="{{ action('PacienteController@searchPaciente') }}" method="post" id="search-paciente">
								{{ csrf_field() }}
								<div class="input-group">
									<input type="text" class="form-control" name="numero_cns" id="numero_cns" value="123456789123456">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-primary" id="btn-search-paciente"><i class="fa fa-search" id="icone-btn-search-paciente"></i>    Buscar</button>
									</span>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>

			@if (Session::has('paciente'))
				<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Resumo de Informações do Paciente</h3>
					</div>
					<div class="panel-body">
						<hr>
						<div class="row">
							<div class="col-md-4">
								<form class="" action="{{ action('ConsultaController@agendamentoConsulta') }}" method="post" id="form-para-agendar-consulta">
									{{ csrf_field() }}
									<input type="hidden" name="paciente_id" value="{{ Session::get('paciente')->id }}">
									<button type="submit" class="btn btn-success" id="btn-agendar"><i id="icone-btn-agendar" class="fa fa-calendar"></i>  Agendar consulta para esse paciente </button>
								</form>
							</div>
							<div class="col-md-4">
								<form class="" action="{{ action('PacienteController@pacienteParaAlterar') }}" method="post" id="form-para-alterar-paciente">
									{{ csrf_field() }}
									<input type="hidden" name="paciente_id" value="{{ Session::get('paciente')->id }}">
									<button type="submit" class="btn btn-warning" id="btn-aterar"><i id="icone-btn-alterar" class="fa fa-pencil-square-o"></i>  Alterar dados do paciente </button>
								</form>
							</div>
						</div>
						<hr>

						<div class="row">
							<div class="col-md-7 form-group">
								<label>Nome do paciente:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="nome_paciente" id="nome-paciente" value="{{ Session::get('paciente')->nome_paciente }}"  disabled>
							</div>
							<div class="col-md-3 form-group">
								<label>Sexo:<span class="vermelho">*</span></label>
								{{-- <input class="form-control" type="date" name="sexo" id="sexo" value="{{ date('d/m/Y', strtotime(Session::get('paciente')->data_nascimento)) }}"> --}}
								<input class="form-control" type="date" name="sexo" id="sexo" value="{{ date('Y-m-d', strtotime(Session::get('paciente')->data_nascimento)) }}" disabled>
							</div>
							<div class="col-md-2 form-group">
								<label>Sexo:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="sexo" id="sexo" value="{{ Session::get('paciente')->sexo }}" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Número do CNS:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="numero_cns" id="numero_cns" value="{{ Session::get('paciente')->numero_cns }}" disabled>
							</div>
							<div class="col-md-8 form-group">
								<label>Nome da Mãe:<span class="vermelho">*</span></label>
								<input class="form-control" type="text" name="nome_mae" id="nome-mae" value="{{ Session::get('paciente')->nome_mae }}" disabled>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3"  id="local-btn-salvar">

							</div>



							<form class="" action="{{ action('PacienteController@searchPaciente') }}" method="post" id="cancelar-alteracao-paciente">
								{{ csrf_field() }}
								<input type="hidden" name="numero_cns" id="numero_cns" value="{{ Session::get('paciente')->numero_cns }}">
								<div class="col-md-3" id="local-btn-cancelar">

								</div>
							</form>

							</div>


					</div>
				</div>
			@endif


	</div>
</div>

@endsection
