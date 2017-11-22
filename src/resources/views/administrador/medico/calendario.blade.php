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
      @isset($sucesso)
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-check-square-o"></i> <b>Sucesso!</b> Todas as informações abaixo foram salvas com sucesso. <br><br>
              @foreach ($sucesso as $success)
                <i class="fa fa-angle-double-right"></i>
                Data do Atendimento: <b>{{ date('d/m/Y', strtotime($success['data'])) }}</b> -
                Período do Atendimento: <b>{{ $success['periodo'] }}</b>. <br>
              @endforeach
            </div>
          </div>
        </div>
      @endisset
      @isset($erro_list_datas)
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> <b>Erro!</b> As informações abaixo não foram salvas,
                pois esse médico já possui atendimentos agendados para o dia e periodo informado. <br><br>
                @foreach ($erro_list_datas as $erro_date)
                  <i class="fa fa-angle-double-right"></i>
                  Data do Atendimento: <b>{{ date('d/m/Y', strtotime($erro_date['data'])) }}</b> -
                  Período do Atendimento: <b>{{ $erro_date['periodo'] }}</b>. <br>
                @endforeach
              </div>
            </div>
          </div>
      @endisset

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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#model_new_atendimento">
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  id="model_new_atendimento" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close btn_cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastrar Novo Atendimento</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="medico_id" id="medico_id" value="{{ $medico->id_medico }}">
            <div class="row">
              <div class="col-md-12">
                <p><span class="vermelho">Campos Obrigatórios (*)</span></p>
              </div>
            </div>
            <hr>
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
                <label for="nome_especialidade">Especialidade<span class="vermelho">*</span></label>
                <select class="form-control" name="especialidade" id="especialidade_nome" required>
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
                    <td><b>Data do Atendimento<span class="vermelho">*</span></b></td>
                    <td><b>Período do Atendimento<span class="vermelho">*</span></b></td>
                    <td><b>Total de Pacientes<span class="vermelho">*</span></b></td>
                    <td><b>Ações</b></td>
                  </thead>
                  <tbody>
                    <input type="hidden" name="number_fields" id="number_fields" value="0">
                    <tr>
                      <td>
                        <input type="date" class="form-control start" value="" name="start[]" min="{{ date('Y-m-d', strtotime('+1 days')) }}" max="{{ date('Y-m-d', strtotime('+100 years')) }}" required>
                      </td>
                      <td>
                        <select class="form-control" name="periodo[]" id="periodo" required>
                          <option value="" disabled selected>Selecione...</option>
                          <option value="Manhã">Manhã</option>
                          <option value="Tarde">Tarde</option>
                          <option value="Noite">Noite</option>
                        </select>
                      </td>
                      <td>
                        <input type="number" name="total_consultas[]" id="total_consultas" value="" class="form-control" min="1" required>
                      </td>
                      <td><button type="button" class="btn btn-primary" name="add" id="add"><i class="fa fa-plus"></i>   Adicionar</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="local">Local<span class="vermelho">*</span></label>
                <select class="form-control" name="local" id="local" required>
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
            <button type="button" class="btn btn-danger btn_cancel" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Cancelar</button>
          </div>
        </div>
      </div>
    </div>

  </form>

  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ModalAtendimento"  id="atendimento" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btn_cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalhes do Atendimento</h4>
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
              <label for="nome_especialidade">Especialidade<span class="vermelho">*</span></label>
              <input type="text" name="" id="nome_especialidade" value="" class="form-control" disabled>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <label for="data">Data</label>
              <input type="date" name="start" id="start"  value="" class="form-control" disabled>
            </div>
            <div class="col-md-4">
              <label for="periodo">Período</label>
              <input type="periodo" name="periodo" id="periodo" value="" class="form-control" disabled>
            </div>
            <div class="col-md-4">
              <label for="total_consultas">Total de Pacientes</label>
              <input type="number" name="total_consultas" id="total_consultas" value="" class="form-control" disabled>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="nome_fantasia">Local<span class="vermelho">*</span></label>
              <input type="text" name="nome_fantasia" id="nome_fantasia" value="" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="btn_delete" value=""><i class="fa fa-trash-o"></i>  Excluir</button>
          <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Cancelar</button>
        </div>
      </div>
    </div>
  </div>

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
    events: path_calendar + medico_id,
    eventClick: function (event, jsEvent, view) {
      let start = moment(event.start).format("YYYY-MM-DD")

      $('#atendimento #nome_especialidade').val(event.nome_especialidade);
      $('#atendimento #start').val(start);
      $('#atendimento #periodo').val(event.nome);
      $('#atendimento #total_consultas').val(event.total_consultas);
      $('#atendimento #nome_fantasia').val(event.nome_fantasia);
      $('#atendimento #btn_delete').val(event.id_periodo);

      $('#atendimento').modal('show');
    }

  });

//adicionar campos com data e periodo:
  var i = 0;
  var max = 14;
  var num_one = 1;

  $('#add').click(function () {
    let number_fields = $('#number_fields').val();
    if (number_fields < max) {
      i++;

      let number = parseInt($('#number_fields').val());
      let new_number = number + num_one;

      $('#number_fields').val(new_number);
      $('#dynamic_fields').append(
        '<tr id="row'+i+'">'+
        '<td>'+
          '<input type="date" class="form-control start" value="" name="start['+i+']" min="{{ date('Y-m-d') }}" required>'+
        '</td>'+
        '<td>'+
          '<select class="form-control" name="periodo['+i+']" id="periodo" required>'+
            '<option value="" disabled selected>Selecione...</option>'+
            '<option value="Manhã">Manhã</option>'+
            '<option value="Tarde">Tarde</option>'+
            '<option value="Noite">Noite</option>'+
          '</select>'+
        '</td>'+
        '<td>'+
          '<input type="number" name="total_consultas['+i+']" id="total_consultas" value="{{ old('total_consultas') }}" class="form-control"  min="1" required>'+
        '</td>'+
        '<td><button type="button" class="btn btn-danger btn_remove" name="remove" id="'+i+'"><i class="fa fa-minus"></i>   Remove</button></td>'+
      '</tr>');
    } else {
      swal({
        title: 'Desculpe!',
        text: 'Mas você só pode cadastrar até 15 atendimentos por vez!',
        type: 'info',
        confirmButtonText: 'Ok. Já entendi...'
      });
    }
  });

  $(document).on('click', '.btn_remove', function () {
    var button_id = $(this).attr('id');
    $('#row'+button_id+'').remove();
    let number = parseInt($('#number_fields').val());
    let new_number = number - num_one;
    $('#number_fields').val(new_number);
  });

  $('.btn_cancel').click(function () {
    var num = i;
    while (num > 0) {
      $('#row'+num+'').remove();
      num--;
    }
    i = 0;
    $('#cadastrar_atendimento')[0].reset();
    $('#number_fields').val(i);
  });

  $('#cadastrar_atendimento').submit(function () {
    $('.loading').fadeOut(700).removeClass('hidden');
  });

  @isset($erro)
    $('#model_new_atendimento').modal('show');
  @endisset

  $('#btn_delete').click(function () {
    let id_periodo = $(this).val();

    swal({
      title: 'Excluir Atendimento?',
      text: "Você tem certeza que deseja excluir esse atendimento?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5cb85c',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
    }).then(function (result) {
      if (result.value) {
        $('.loading').fadeOut(700).removeClass('hidden');

        $.post("{{ route('administrador.calendario.excluir') }}",
        {
          _token: "{{ csrf_token() }}",
           id: id_periodo
        },
        function(result) {
          if (result.menssage === 'error') {
            $('.loading').fadeOut(700).addClass('hidden');
            swal({
              title: 'Erro!',
              text: 'Ocorreu um erro ao excluir o atendimento!',
              type: 'error',
              confirmButtonText: 'Ok'
            });
          }
          if (result.menssage === 'success') {
            $('.loading').fadeOut(700).addClass('hidden');
            swal(
              'Excluído!',
              'O atendimento foi excluído com sucesso.',
              'success'
            ).then(function (result) {
              $('.loading').fadeOut(700).removeClass('hidden');
              location.reload(true)
            })
          }
        }, "json");

      }
    })

  });

});


</script>
@endsection
