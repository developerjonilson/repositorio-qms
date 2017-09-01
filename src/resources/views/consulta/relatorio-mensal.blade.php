@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Relatório Mensal de Consultas Médicas</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          Informe o mês e ano desejado
        </div>
        <div class="panel-body">
          <form class="" action="#" method="post">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Mês*</label>
                <select class="form-control" name="local">
                  <option value="1" selected>Janeiro</option>
                  <option value="2">Fevereiro</option>
                  <option value="3">Março</option>
                  <option value="4">Abril</option>
                  <option value="5">Maio</option>
                  <option value="6">Junho</option>
                  <option value="7">Julho</option>
                  <option value="8">Agosto</option>
                  <option value="9">Setembro</option>
                  <option value="10">Outubro</option>
                  <option value="11">Novembro</option>
                  <option value="12">Dezembro</option>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Ano*</label>
                <select class="form-control" name="local">
                  <option value="2017" selected>2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                  <option value="2035">2035</option>
                  <option value="2036">2036</option>
                  <option value="2037">2037</option>
                  <option value="2038">2038</option>
                  <option value="2039">2039</option>
                  <option value="2040">2040</option>
                </select>
              </div>
            </div>

            <div class="col-sm-4 form-group">
              <div class="form-group">
                <label>Filtrar </label>
                <button type="submit" class="btn btn-success"> Filtrar</button>
              </div>
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

@endsection
