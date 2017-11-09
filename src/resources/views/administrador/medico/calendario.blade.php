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

  <form class="" action="{{ route('administrador.calendario.cadastrar') }}" method="post">

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  id="new_atendimento" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastrar Novo Atendimento</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="campo1">Campo de Teste 1</label>
              <input type="text" name="campo1" value="{{ old('campo1') }}" class="form-control">
            </div>
            <div class="form-group">
              <label for="campo2">Campo de Teste 2</label>
              <input type="text" name="campo2" value="{{ old('campo2') }}" class="form-control">
            </div>
            <div class="form-group">
              <label for="campo3">Campo de Teste 3</label>
              <input type="text" name="campo3" value="{{ old('campo3') }}" class="form-control">
            </div>
            <div class="form-group">
              <label for="campo4">Campo de Teste 4</label>
              <input type="text" name="campo4" value="{{ old('campo4') }}" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" form="" id=""><i class="fa fa-check-circle"></i>  Cadastrar</button>
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
  // let dataHoje = moment().format("YYYY-MM-DD");
  // alert(dataHoje);
  let path = window.location.pathname.split('/')
  let medico_id = path[3]
  let path_calendar = '/administrador/calendario-atendimento/ver/'

  $('#calendar').fullCalendar({
    // header: {
    //   left: 'prev,next today',
    //   center: 'title',
    //   right: 'month,basicWeek,basicDay'
    // },

    // defaultDate: '2017-10-12',
    // defaultDate: dataHoje,
    themeSystem: 'bootstrap3',
    backgroundColor: '#F5F5F5',
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    events: path_calendar + medico_id

    // eventSources: [
    //     {
    //       url: path_calendar + medico_id,
    //       type: 'GET',
    //       // data: {
    //       //     custom_param1: 'something',
    //       //     custom_param2: 'somethingelse'
    //       // },
    //       error: function() {
    //           alert('there was an error while fetching events!');
    //       },
    //       color: 'yellow',   // a non-ajax option
    //       textColor: 'black' // a non-ajax option
    //     }
    //
    // ]

    // events: [
    //   {
    //     title: 'All Day Event',
    //     start: '2017-11-05',
    //     color: '#000000'
    //   }
    // ]
  });

});

</script>
@endsection
