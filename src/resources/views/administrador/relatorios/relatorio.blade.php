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
            <li role="presentation"><a href="#personalizado" aria-controls="personalizado" role="tab" data-toggle="tab"><b>Relatório Personalizado</b></a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="diario">
              {{-- diario --}}

            </div>

            <div role="tabpanel" class="tab-pane fade" id="mensal">
              {{-- mensal --}}
            </div>

            <div role="tabpanel" class="tab-pane fade" id="personalizado">
              {{-- personalizado --}}
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Steve</td>
                <td>Jobs</td>
                <td>@steve</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Simon</td>
                <td>Philips</td>
                <td>@simon</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
  {{-- $('#my_tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  }) --}}

  {{-- $('#my_tabs a[href="#personalizado"]').tab('show')  --}}

@endsection
