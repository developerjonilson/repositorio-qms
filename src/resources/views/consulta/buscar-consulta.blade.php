@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Pesquisa de Consultas Médicas</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="well">

    <div class="row">
      <form class="" action="index.html" method="post">
        <div class="col-sm-12">

          <div class="panel panel-green">
            <div class="panel-heading">
              Por favor preencha um dos campos com os dados do paciente para a pesquisa
            </div>
            <div class="panel-body">

              <div class="col-sm-6">
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" class="form-control" name="cpf" value="" placeholder="000.000.000-00">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                    <label>Número do Cartão do SUS</label>
                    <input type="text" class="form-control" name="cartaoSus" value="" placeholder="0000.0000.0000.0000">
                </div>
              </div>

              <div class="col-sm-2">
                <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i>  Pesquisar</button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.row -->


  </div>
@endsection
