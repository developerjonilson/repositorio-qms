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
        <div class="row pull-right">
          <a href="#" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Imprimir</a>
        </div>

        <div class="row">
          <!-- Table -->
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Especialidade</th>
                <th>Médico</th>
              </tr>
            </thead>
            <tbody>
              @isset($consultas_hoje)
                @foreach ($consultas_hoje as $consult)
                  <tr>
                    <td>{{ $consult->codigo_consulta }}</td>
                    <td>{{ $consult->nome_especialidade }}</td>
                    <td>{{ $consult->nome_medico }}</td>
                  </tr>
                @endforeach
              @endisset
            </tbody>
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

  {{-- $('#my_tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  }) --}}

  {{-- $('#my_tabs a[href="#personalizado"]').tab('show')  --}}

@endsection
