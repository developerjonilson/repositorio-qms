@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li class="active">Relatórios</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Relatórios</h3>
        <hr>
      </div>

      <div class="panel-body">
        <div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-justified" role="tablist" id="my_tabs">
            <li role="presentation" class="active"><a href="#diario" aria-controls="diario" role="tab" data-toggle="tab"><b>Relatório Diário</b></a></li>
            <li role="presentation"><a href="#mensal" aria-controls="mensal" role="tab" data-toggle="tab"><b>Relatório Mensal</b></a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="diario">
              {{-- diario --}}
              <form action="" method="post" id="search-form">
                <div class="row">
                  <div class="col-md-8">
                    <h4>Filtar Por</h4>
                  </div>
                  <div class="col-md-4 pull-right">
                    <a href="{{ route('administrador.relatorio') }}" class="btn btn-danger pull-right" id="btn_limpar"><i class="fa fa-eraser"></i>   Limpar Filtros</a>
                  </div>
                </div>
                <hr>
                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="perido">Período</label>
                      <select class="form-control" name="periodo">
                        <option value="">Todos</option>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="especialidade">Especialidade</label>
                      <select class="form-control" name="especialidade">
                        <option value="">TODOS</option>
                        {{-- <option disabled selected>Selecione...</option> --}}
                        @isset($especialidades)
                          @foreach ($especialidades as $esp)
                            <option value="{{ $esp->id_especialidade }}">{{ $esp->nome_especialidade}}</option>
                          @endforeach
                        @endisset
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="medico">Médico</label>
                      <select class="form-control" name="medico" disabled>
                        <option value="">TODOS</option>
                        {{-- <option disabled selected>Selecione...</option> --}}
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

            <div role="tabpanel" class="tab-pane fade" id="mensal">
              {{-- mensal --}}
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="pull-right">
            <form class="" action="{{ route('administrador.relatorio_diario_pdf') }}" method="post" target='_blank'>
              {{ csrf_field() }}
              <input type="text" name="periodo" value="">
              <input type="text" name="especialidade" value="">
              <input type="text" name="medico" value="">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-print" aria-hidden="true"></i>  Imprimir</a>
              </button>
              {{-- <input type="submit" name="" value="Imprimir" class="btn btn-success"> --}}
            </form>
            {{-- <a id="pdf" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Imprimir</a> --}}
          </div>
        </div>


        <div class="row">
          <!-- Table -->
          <table class="table" id="queries_table">
            <thead>
              <tr>
                <th>Código</th>
                <th>Paciente</th>
                <th>Especialidade</th>
                <th>Médico</th>
                <th>Período</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
  $('#btn_limpar').click(function (){
    $('.loading').fadeOut(700).removeClass('hidden');
  });

  $('select[name="periodo"]').change(function () {
    let valor = $(this).val();
    $('input[name="periodo"]').val(valor);
  });

  $('select[name="especialidade"]').change(function () {
    let valor = $(this).val();
    $('input[name="especialidade"]').val(valor);
  });

  $('select[name="medico"]').change(function () {
    let valor = $(this).val();
    $('input[name="medico"]').val(valor);
  });

  $('select[name="especialidade"]').change(function () {
    let idEspecialidade = $(this).val();

    if (idEspecialidade == '') {
      $('select[name="medico"]').empty();
      $('select[name="medico"]').append('<option value="">TODOS</option>');
      $('select[name="medico"]').attr('disabled', true);
    } else {
      $.get('/administrador/get-medicos/' + idEspecialidade, function (medicos) {
        $('select[name="medico"]').empty();
        $('select[name="medico"]').append('<option value="">TODOS</option>');
        $.each(medicos, function (key, medico) {
          $('select[name="medico"]').append('<option value="'+medico.id_medico+'">'+medico.nome_medico+'</option>');
        });
        $('select[name="medico"]').attr('disabled', false);
      });
    }

  });

  var oTable = $('#queries_table').DataTable({
      oLanguage: {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      },
      dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
          "<'row'<'col-xs-12't>>"+
          "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
      processing: true,
      serverSide: true,
      ajax: {
          {{-- url: 'https://datatables.yajrabox.com/fluent/custom-filter-data', --}}
          url: '{{ route('administrador.relatorio_filter') }}',
          data: function (d) {
              d.especialidade = $('select[name="especialidade"]').val();
              d.medico = $('select[name="medico"]').val();
              d.periodo = $('select[name="periodo"]').val();
          }
      },
      columns: [
          {data: 'codigo_consulta', name: 'codigo_consulta'},
          {data: 'nome_paciente', name: 'nome_paciente'},
          {data: 'nome_especialidade', name: 'nome_especialidade'},
          {data: 'nome_medico', name: 'nome_medico'},
          {data: 'nome', name: 'nome'}
      ]
  });

  $('#search-form').on('submit', function(e) {
      oTable.draw();
      e.preventDefault();
  });

  {{-- $('#my_tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  }) --}}

  {{-- $('#my_tabs a[href="#personalizado"]').tab('show')  --}}

  $('#pdf').click(function () {
    $('.loading').fadeOut(700).removeClass('hidden');

    $.post("{{ route('administrador.relatorio_diario_pdf') }}",
    {
      _token: "{{ csrf_token() }}",
       especialidade: $('select[name="especialidade"]').val(),
       medico: $('select[name="medico"]').val(),
       periodo: $('select[name="periodo"]').val()
    });
  });

@endsection
