@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Buscar Paciente</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="well">

    <div class="row">
      <form class="" action="#" method="post">
        <div class="col-sm-12">

          <div class="panel panel-primary">
            <div class="panel-heading">
              Informações para Buscar Paciente
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
            <div class="panel-footer">
              Preencha um dos campos acima corretamente para realizar a pesquisa.
            </div>
          </div>

        </div>
      </form>
    </div>
    <!-- /.row -->


  </div>
@endsection
