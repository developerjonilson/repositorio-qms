@extends('layout.layout-administrador')

@section('conteudo')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Cadastrar Horário</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">

    <div class="col-sm-12">
      <div class="panel panel-success">
          <div class="panel-heading">
            Informações
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <form class="" action="" method="post">
              <div class="col-lg-3">
                <div class="form-group">
                    <label>CRM</label>
                    <input class="form-control" name="cpf" placeholder="000.000.000-00" >
                </div>
              </div>

              <div class="col-sm-9">
                <div class="form-group">
                    <label>Nome Completo*</label>
                    <input type="text" class="form-control" name="nome" value="Nome do médico" placeholder="">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""></label>
                    <button class="btn btn-success" type="button" name="button"><i class="fa fa-search fa-fw"></i>Buscar</button>
                </div>
              </div>

                <div class="col-lg-3">
                  <div class="form-group">
                      <label>Data*</label>
                      <input type="date" class="form-control" name="data" value="">
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                      <label>Horário Entrada*</label>
                      <input type="time" class="form-control" name="time" value="">
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                      <label>Horário Saída*</label>
                      <input type="time" class="form-control" name="time" value="">
                  </div>
                </div>

                <div class="col-lg-10">
                  <div class="form-group">
                    <button class="btn btn-success" type="button" name="button"><i class="fa fa-check fa-fw"></i>Cadastrar</button>
                  </div>
                </div>
                </form>
              </div>
            <!-- /#page-wrapper -->
            </div>
        </div>
      </div>
    </div>
<!-- /#row -->
@endsection
