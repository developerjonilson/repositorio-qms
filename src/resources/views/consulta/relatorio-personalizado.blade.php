@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Relatório Personalizado de Consultas Médicas</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          Informe os campos desejados para o relátorio
        </div>
        <div class="panel-body">
          <form class="" action="#" method="post">

            <div class="col-sm-3">
              <div class="form-group">
                <label>Data</label>
                <input type="date" name="data" class="form-control">
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                  <label>Especialidade*</label>
                  <select class="form-control" name="especialidade">
                      <option value="pediatria" selected>Pediatria</option>
                      <option value="ortopedia e traumatologia">Ortopedia e Traumatologia</option>
                  </select>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                  <label>Médico*</label>
                  <select class="form-control" name="medico">
                      <option value="Pedro" selected>Pedro</option>
                      <option value="Paulo">Paulo</option>
                  </select>
              </div>
            </div>

            <div class="col-sm-4">
              <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i>  Gerar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-green">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <button type="button" name="relatorio" class="btn btn-primary btn-sm btn-right">Imprimir Relatório Completo</button>
      </div>
      <!-- Table -->
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th>Paciente</th>
            <th>Especialidade</th>
            <th>Médico</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John</td>
            <td>Ortopedia</td>
            <td>Pedro Silva</td>
            <td>
              <button type="button" name="visualizar"  class="btn btn-info btn-sm">Visualizar</button>
              <button type="button" name="alterar"  class="btn btn-primary btn-sm">Alterar</button>
              <button type="button" name="gerar_pdf"  class="btn btn-success btn-sm">Gerar PDF</button>
            </td>
          </tr>
          <tr>
            <td>John</td>
            <td>Ortopedia</td>
            <td>Pedro Silva</td>
            <td>
              <button type="button" name="visualizar"  class="btn btn-info btn-sm">Visualizar</button>
              <button type="button" name="alterar"  class="btn btn-primary btn-sm">Alterar</button>
              <button type="button" name="gerar_pdf"  class="btn btn-success btn-sm">Gerar PDF</button>
            </td>
          </tr>
          <tr>
            <td>John</td>
            <td>Ortopedia</td>
            <td>Pedro Silva</td>
            <td>
              <button type="button" name="visualizar"  class="btn btn-info btn-sm">Visualizar</button>
              <button type="button" name="alterar"  class="btn btn-primary btn-sm">Alterar</button>
              <button type="button" name="gerar_pdf"  class="btn btn-success btn-sm">Gerar PDF</button>
            </td>
          </tr>
        </tbody>
      </table>

      </table>
      </div>
    </div>
  </div>
  <!-- /.row -->

@endsection
