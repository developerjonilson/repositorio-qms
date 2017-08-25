@extends('layout.layout-administrador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Cadastrar Operador</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">

  <div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
          Informações
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <form class="" action="" method="post">
              <div class="col-sm-9">
                <div class="form-group">
                    <label>Nome Completo*</label>
                    <input type="text" class="form-control" name="nome" value="" placeholder="Pedro da Silva Santos">
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                    <label>CPF*</label>
                    <input type="text" class="form-control" name="cpf" value="" placeholder="000.000.000-00">
                </div>
              </div>

              <div class="col-lg-9">
                <div class="form-group">
                    <label>E-mail*</label>
                    <input type="email" class="form-control" name="email" value="" placeholder="exemplo@mail.com">
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label>Tipo de Usuário</label>
                  <select class="form-control">
                      <option value="0">Administrador</option>
                      <option value="1">Operador</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <button class="btn btn-success" type="button" name="button"><i class="fa fa-check fa-fw"></i>Cadastrar</button>
                </div>
              </div>
          </form>
        </div>
        <!-- /#panel-body -->
      </div>
    </div>

  </div>
  <!-- /#row -->


@endsection
