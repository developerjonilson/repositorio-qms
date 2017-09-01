@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Relatório Diário de Consultas Médicas</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="well">

    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-green">
        <!-- Default panel contents -->
        <div class="panel-heading btn-right">
          <button type="button" name="relatorio" class="btn btn-primary"><i class="fa fa-print"></i>    Imprimir</button>
        </div>
        <!-- Table -->
        <table class="table table-condensed table-bordered table-striped">
          <thead>
            <tr>
              <th>Paciente</th>
              <th>Especialidade</th>
              <th>Médico</th>
              <th class="coluna-botoes">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John</td>
              <td>Ortopedia</td>
              <td>Pedro Silva</td>
              <td>
                <button type="button" name="visualizar"  class="btn btn-outline btn-info btn-sm">Visualizar</button>
                <button type="button" name="alterar"  class="btn btn-outline btn-warning btn-sm">Alterar</button>
                <button type="button" name="gerar_pdf"  class="btn btn-outline btn-success btn-sm">Gerar PDF</button>
              </td>
            </tr>
            <tr>
              <td>John</td>
              <td>Ortopedia</td>
              <td>Pedro Silva</td>
              <td>
                <button type="button" name="visualizar"  class="btn btn-outline btn-info btn-sm">Visualizar</button>
                <button type="button" name="alterar"  class="btn btn-outline btn-warning btn-sm">Alterar</button>
                <button type="button" name="gerar_pdf"  class="btn btn-outline btn-success btn-sm">Gerar PDF</button>
              </td>
            </tr>
            <tr>
              <td>John</td>
              <td>Ortopedia</td>
              <td>Pedro Silva</td>
              <td>
                <button type="button" name="visualizar"  class="btn btn-outline btn-info btn-sm">Visualizar</button>
                <button type="button" name="alterar"  class="btn btn-outline btn-warning btn-sm">Alterar</button>
                <button type="button" name="gerar_pdf"  class="btn btn-outline btn-success btn-sm">Gerar PDF</button>
              </td>
            </tr>
          </tbody>
        </table>

        </table>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </div>

@endsection
