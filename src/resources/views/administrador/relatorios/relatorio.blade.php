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
                      <label for="especialidade">Especialidade</label>
                      <select class="form-control" name="especialidade_id">
                        <option disabled selected>Selecione...</option>
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
                      <label for="especialidade">Médico</label>
                      <select class="form-control" name="medico_id">
                        <option disabled selected>Selecione...</option>
                        <option value="1">José</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="especialidade">Período</label>
                      <select class="form-control" name="periodo_id">
                        <option disabled selected>Selecione...</option>
                        <option value="1">Manhã</option>
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
            <a href="#" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Imprimir</a>
          </div>
        </div>


        <div class="row">
          <!-- Table -->
          <table class="table" id="queries_table">

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

  var oTable = $('#queries_table').DataTable({
      dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
          "<'row'<'col-xs-12't>>"+
          "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
      processing: true,
      serverSide: true,
      ajax: {
          {{-- url: 'https://datatables.yajrabox.com/fluent/custom-filter-data', --}}
          url: '{{ route('administrador.relatorio_filter') }}',
          data: function (d) {
              d.especialidade = $('input[name="especialidade"]').val();
              d.medico = $('input[name="medico"]').val();
              d.periodo = $('input[name="periodo"]').val();
          }
      },
      columns: [
          {data: 'id', name: 'Código'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'}
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

@endsection
