@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li><a href="{{ action('AdministradorController@medicos') }}">Médicos</a></li>
      <li class="active">Calendário de Atendimento</li>
    </ol>
  </div>

  <div class="panel panel-headline">
		<div class="panel-heading">
      <a href="{{ route('administrador.medicos') }}" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
      <hr>
			<h3 class="panel-title">Calendário de Atendimento Médico</h3>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <label for="numero_crm">Número do CRM</label>
          <label for="" class="form-control disable">{{ $medico->numero_crm }}</label>
        </div>
        <div class="col-md-6">
          <label for="numero_crm">Nome do Médico</label>
          <label for="" class="form-control disable">{{ $medico->nome_medico }}</label>
        </div>
      </div>
		</div>
		<div class="panel-body">
			<div class="row">
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_atendimento">
          <i class="fa fa-plus-square-o"></i> Adicionar Atendimento
        </button>
        <hr>
			</div>

      <div class="row">
        <div class="" id="calendar"> </div>
      </div>
		</div>
	</div>

  <form class="" action="{{ route('administrador.calendario.cadastrar') }}" method="post" id="cadastrar_atendimento" name="cadastrar_atendimento">
    {{ csrf_field() }}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  id="new_atendimento" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastrar Novo Atendimento</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="medico_id" id="medico_id" value="{{ $medico->id_medico }}">
            <div class="row">
              <div class="form-group col-md-2">
                <label for="numero_crm">Número CRM</label>
                <input type="text" name="numero_crm" id="numero_crm" value="{{ $medico->numero_crm }}" class="form-control" disabled>
              </div>
              <div class="form-group col-md-10">
                <label for="nome_medico">Médico</label>
                <input type="text" name="nome_medico" id="nome_medico" value="{{ $medico->nome_medico }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="nome_especialidade">Especialidade</label>
                <select class="form-control" name="especialidade" id="especialidade">
                  <option value="" disabled selected>Selecione...</option>
                  @foreach ($especialidades as $especialidade)
                    <option value="{{ $especialidade->id_especialidade }}">{{ $especialidade->nome_especialidade }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-hover" id="dynamic_fields">
                  <thead>
                    <td><b>Data do Atendimento</b></td>
                    <td><b>Período do Atendimento</b></td>
                    <td><b>Ações</b></td>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="date" class="form-control start" value="" name="start[]"></td>
                      <td>
                        <select class="form-control" name="periodo" id="periodo">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                      </select>
                    </td>
                      <td><button type="button" class="btn btn-success" name="add" id="add">Adicionar Mais</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              {{-- <div class="col-md-5">
                <label for="start">Data do Atendimento</label>
                <div class="input-group date">
                  <input type="text" id="start" name="start" class="form-control">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label for="periodo">Periodo de Atendimento</label>
                <select class="form-control" name="periodo" id="periodo">
                  <option value="" disabled selected>Selecione...</option>
                  <option value="Manhã">Manhã</option>
                  <option value="Tarde">Tarde</option>
                  <option value="Noite">Noite</option>
                </select>
              </div>
              <div class="col-md-2">
                <label>Mais</label>
                <button type="button" class="btn btn-primary" title="Adicionar mais um atendimento" id="novo_atendimento"><i class="fa fa-plus"></i>  Adicionar Atedimento</button>
              </div> --}}
            </div>
            <div class="row" id="new_fields">

            </div>
            <hr>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="total_consultas">Número de Pacientes a serem atendidos</label>
                <input type="number" name="total_consultas" id="total_consultas" value="{{ old('total_consultas') }}" class="form-control">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="local">Local</label>
                <select class="form-control" name="local" id="local">
                  <option value="" disabled selected>Selecione...</option>
                  @foreach ($locals as $local)
                    <option value="{{ $local->id_local }}">{{ $local->numero_cnes }} - {{ $local->nome_fantasia }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="enviar"><i class="fa fa-check-circle"></i>  Cadastrar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id=""><i class="fa fa-times-circle"></i>  Cancelar</button>
          </div>
        </div>
      </div>
    </div>

  </form>
@endsection
@section('pos-script')
<script>

$(document).ready(function() {
  let path = window.location.pathname.split('/')
  let medico_id = path[4]
  let path_calendar = '/administrador/medicos/calendario-atendimento/ver/'

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },

    themeSystem: 'bootstrap3',
    backgroundColor: '#F5F5F5',
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    events: path_calendar + medico_id
  });

  $('.start').datepicker({
    format: 'yyyy-mm-dd',
    orientation: "bottom right",
    startDate: '-0d',
    language: 'pt-BR',
    daysOfWeekHighlighted: "0",
    daysOfWeekDisabled: "0",
    todayHighlight: true,
  });

  $('#datepicker').on('changeDate', function() {
    $('#start').val(
        $('#datepicker').datepicker('getFormattedDate')
    );
});

//adicionar campos com data e periodo:
  var i = 1;
  var max = 10;

  $('#add').click(function () {
    if (i <= max) {
      i++;
      $('#dynamic_fields').append(
        '<tr id="row'+i+'">'+
        '<td><input type="date" class="form-control start" value="" name="start['+i+']"></td>'+
        '<td>'+
          '<select class="form-control" name="periodo" id="periodo">'+
            '<option value="" disabled selected>Selecione...</option>'+
            '<option value="Manhã">Manhã</option>'+
            '<option value="Tarde">Tarde</option>'+
            '<option value="Noite">Noite</option>'+
          '</select>'+
        '</td>'+
        '<td><button type="button" class="btn btn-danger btn_remove" name="remove" id="'+i+'">Remove</button></td>'+
      '</tr>');
    }
  });

  $(document).on('click', '.btn_remove', function () {
    var button_id = $(this).attr('id');
    $('#row'+button_id+'').remove();
  });

  $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('.start').attr('min', maxDate);
});

});
</script>
@endsection
