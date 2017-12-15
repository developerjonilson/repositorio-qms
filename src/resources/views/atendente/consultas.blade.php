@extends('layouts.layout-atendente')

@section('conteudo')

	<div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AtendenteController@index') }}">Atendente</a></li>
      <li class="active">Consultas</li>
    </ol>
  </div>

	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Buscar Hoje</h3>
			<hr>
		</div>
		<div class="panel-body">
			<form action="{{ route('atendente.listar_atendimentos') }}" method="post" id="buscar_hoje">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="especialidade">Especialidade</label>
							<select class="form-control" name="especialidade">
								<option selected disabled>Selecione...</option>
								@isset($especialidades)
									@foreach ($especialidades as $especialidade)
										<option value="{{ $especialidade->id_especialidade }}">{{ $especialidade->nome_especialidade }}</option>
									@endforeach
								@endisset
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="medico">Médico</label>
							<select class="form-control" name="medico" disabled>
								<option selected disabled>Selecione...</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="periodo">Período</label>
							<select class="form-control" name="periodo" disabled>
								<option selected disabled>Selecione...</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>  Buscar</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	@isset($consultas)
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Consultas</h3>
				<hr>
			</div>
			<div class="panel-body">
				<form class="" action="{{ route('atendente.gerar_pdf') }}" method="post" target="_blank" id="atendente_pdf" name="atendente_pdf">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-4">
							<label>Especialidade</label>
							<input type="hidden" name="especialidade_num" value="{{ $especialidade_atual->id_especialidade }}">
							<input type="text" name="nome_especialidade" value="{{ $especialidade_atual->nome_especialidade }}" class="form-control" disabled>
						</div>
						<div class="col-md-4">
							<label>Médico</label>
							<input type="hidden" name="medico_num" value="{{ $medico->id_medico }}">
							<input type="text" name="nome_medico" value="{{ $medico->nome_medico }}" class="form-control" disabled>
						</div>
						<div class="col-md-4">
							<label>Período</label>
							<input type="hidden" name="periodo_num" value="{{ $periodo->id_periodo }}">
							<input type="text" name="nome_medico" value="{{ $periodo->nome }}" class="form-control" disabled>
						</div>
					</div>
					<hr>
				</form>

				<form class="" action="{{ route('atendente.listar_atendimentos') }}" method="post" id="refresh" name="atendente_pdf">
					{{ csrf_field() }}
					<input type="hidden" name="especialidade" value="{{ $especialidade_atual->id_especialidade }}">
					<input type="hidden" name="medico" value="{{ $medico->id_medico }}">
					<input type="hidden" name="periodo" value="{{ $periodo->id_periodo }}">
				</form>

				<div class="row">
					<div class="col-md-12">
						<!-- Table -->
						<table class="table" id="">
							<thead>
								<tr>
									<th>Código</th>
									<th>Paciente</th>
									<th>Número CNS</th>
									<th>Data de Nascimento</th>
									<th>Nome da Mãe</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($consultas as $consulta)
									<tr>
										<td>{{ $consulta->codigo_consulta }}</td>
										<td>{{ $consulta->nome_paciente }}</td>
										<td>{{ $consulta->numero_cns }}</td>
										<td>{{ date('d/m/Y', strtotime($consulta->data_nascimento)) }}</td>
										<td>{{ $consulta->nome_mae }}</td>
										<td>
											<input value="{{ $consulta->id_consulta }}" name="status_atendimento" type="checkbox" data-toggle="toggle"
											data-on="Atendido" data-off="Não Atendido" data-onstyle="success" data-offstyle="danger"
											onclick="status(this.value)"
											@if ($consulta->status_atendimento === 'true')
												checked
											@endif>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" form="atendente_pdf">
							<i class="fa fa-print" aria-hidden="true"></i>  Imprimir Lista Completa</a>
						</button>
					</div>
				</div>

			</div>
		</div>
	@endisset

@endsection

@section('scripts')
	$('#home').removeClass('active');
	$('#consultas').addClass('active');

	$('select[name="especialidade"]').change(function () {
    let idEspecialidade = $(this).val();

    if (idEspecialidade == '') {
      $('select[name="medico"]').empty();
      $('select[name="medico"]').append('<option value="">TODOS</option>');
      $('select[name="medico"]').attr('disabled', true);
    } else {
      $.get('/atendente/get-medicos/' + idEspecialidade, function (medicos) {
        $('select[name="medico"]').empty();
        $('select[name="medico"]').append('<option selected disabled>Selecione...</option>');
        $.each(medicos, function (key, medico) {
          $('select[name="medico"]').append('<option value="'+medico.id_medico+'">'+medico.nome_medico+'</option>');
        });
        $('select[name="medico"]').attr('disabled', false);
      });
    }
		$('select[name="periodo"]').empty();
		$('select[name="periodo"]').append('<option value="" disabled selected>Selecione...</option>');
		$('select[name="periodo"]').prop("disabled", true);
  });

	$('select[name="medico"]').change(function () {
    var idEspecialidade = $('select[name="especialidade"]').val();
    var idMedico = $(this).val();

    $.get('/atendente/especialidade/'+idEspecialidade+'/medico/'+idMedico, function (periodos) {
      $('select[name="periodo"]').empty();
      $('select[name="periodo"]').append('<option value="" disabled selected>Selecione...</option>');
      $.each(periodos, function (key, periodo) {
        $('select[name="periodo"]').append('<option value="'+periodo.id_periodo+'">'+periodo.nome+'</option>');
      });
      $('select[name="periodo"]').prop("disabled", false);
    });
  });

	$(function() {
		$('input[name="status_atendimento"]').change(function () {
			idConsulta = $(this).val();
			especialidade_id = $('input[name="especialidade_num"]').val();
			medico_id = $('input[name="medico_num"]').val();
			periodo_id = $('input[name="periodo_num"]').val();

			swal({
				position: 'top',
				title: 'Status do Atendimento',
				text: "O paciente já foi realmente atendido?",
				type: 'info',
				showCancelButton: true,
				confirmButtonColor: '#5cb85c',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim',
				cancelButtonText: 'Não',
				allowOutsideClick: false
			}).then(function (result) {
				if (result.value) {
					$('.loading').fadeOut(700).removeClass('hidden');

					$.post("{{ route('atendente.status') }}",
					{
						_token: "{{ csrf_token() }}",
						 id: idConsulta
					},
					function(result) {
						if (result.menssage === 'error') {
							$('.loading').fadeOut(700).addClass('hidden');
							swal({
								position: 'top',
							  title: 'Erro!',
								text: 'Ocorreu um erro ao modificar o status, tente em instantes!',
								type: 'error',
								confirmButtonText: 'Ok',
								allowOutsideClick: false
							}).then((result) => {
							  if (result.value) {
									$('.loading').fadeOut(700).removeClass('hidden')
									$("#refresh").submit()
							  }
							})
						}

						if (result.menssage === 'success') {
							$('.loading').fadeOut(700).addClass('hidden');
							swal({
								position: 'top',
								title: 'Sucesso!',
								text: 'O status do atendimento foi alterado com sucesso!',
								type: 'success',
								allowOutsideClick: false
							}).then(function (result) {
								$('.loading').fadeOut(700).removeClass('hidden')
								$("#refresh").submit()
							})
						}
					}, "json");

				} else {
					$('.loading').fadeOut(700).removeClass('hidden')
					$("#refresh").submit()
				}
		})


	})

	});
@endsection
