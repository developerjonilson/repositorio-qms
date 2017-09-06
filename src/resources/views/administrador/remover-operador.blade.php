@extends('layouts.layout-administrador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Remover Operador</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">

    <div class="col-sm-12">
      <div class="panel panel-danger">
          <div class="panel-heading">
            Por favor,informe os dados correspondentes para remoção
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <form class="" action="" method="post">
              <div class="col-lg-3">
                <div class="form-group">
                    <label>CPF</label>
                    <input class="form-control" name="cpf" placeholder="000.000.000-00">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""></label>
                    <button class="btn btn-success" type="button" name="button"><i class="fa fa-search fa-fw"></i>Buscar</button>
                </div>
              </div>

              <div class="col-lg-9">
                <div class="form-group">
                  <label>Operador:</label>
                  <label for="" class="form-control">Nome do Operador</label>
                </div>
              </div>

                <div class="col-lg-9">
                  <div class="form-group">
                      <label>E-mail</label>
                      <label class="form-control" name="email">Email do operador</label>
                  </div>
                </div>

                <div class="col-lg-5">
                  <div class="form-group">
                      <button class="btn btn-success" type="button" name="button"><i class="fa fa-times fa-fw"></i>Excluir</button>
                  </div>
                </div>
              </form>
            </div>
    <!-- /#page-wrapper -->
      </div>
    </div>
  </div>


@endsection
