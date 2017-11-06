@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li><a href="{{ action('AdministradorController@medicos') }}">Médicos</a></li>
      <li class="active">Calendário</li>
    </ol>
  </div>

  <div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Calendário de Atendimento Médico</h3>
      <hr>
		</div>
		<div class="panel-body">
			<div class="row">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_calendario">
          <i class="fa fa-plus-square-o"></i> Adicionar Atendimento
        </button>
        <hr>
			</div>

      <div class="row">
        <div class="" id="calendar"> </div>
      </div>
		</div>
	</div>


  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  id="new_calendario" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Cadastrar Novo Atendimento</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            teste!
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" form="" id=""><i class="fa fa-check-circle"></i>  Confirmar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id=""><i class="fa fa-times-circle"></i>  Cancelar</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('pos-script')
<script>

$(document).ready(function() {
  let dataHoje = moment().format("YYYY-MM-DD");
  // alert(dataHoje);

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    // defaultDate: '2017-10-12',
    defaultDate: dataHoje,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: [
      {
        title: 'All Day Event',
        start: '2017-11-05'
      },
      {
        title: 'Long Event',
        start: '2017-11-05',
        end: '2017-11-10'
      },
      {
        id: 999,
        title: 'Repeating Event',
        start: '2017-10-09T16:00:00'
      },
      {
        id: 999,
        title: 'Repeating Event',
        start: '2017-10-16T16:00:00'
      },
      {
        title: 'Conference',
        start: '2017-10-11',
        end: '2017-10-13'
      },
      {
        title: 'Meeting',
        start: '2017-10-12T10:30:00',
        end: '2017-10-12T12:30:00'
      },
      {
        title: 'Lunch',
        start: '2017-10-12T12:00:00'
      },
      {
        title: 'Meeting',
        start: '2017-10-12T14:30:00'
      },
      {
        title: 'Happy Hour',
        start: '2017-10-12T17:30:00'
      },
      {
        title: 'Dinner',
        start: '2017-10-12T20:00:00'
      },
      {
        title: 'Birthday Party',
        start: '2017-10-13T07:00:00'
      },
      {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2017-10-28'
      }
    ]
  });

});

</script>
@endsection
