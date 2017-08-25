@extends('layout.layout-administrador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Cadastrar Médico</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">

    <div class="col-sm-12">
      <div class="panel panel-primary">
          <div class="panel-heading">
            Informações Pessoais
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <form class="" action="" method="post">
                <div class="col-sm-8">
                  <div class="form-group">
                      <label>Nome Completo*</label>
                      <input type="text" class="form-control" name="nome" value="" placeholder="Pedro da Silva Santos">
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                      <label>CRM*</label>
                      <input type="text" class="form-control" name="crm" value="" placeholder="000.000.000-00">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Telefone*</label>
                      <input type="text" class="form-control" name="telefone" value="" placeholder="(88)99999-9999">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Telefone Alternativo*</label>
                      <input type="text" class="form-control" name="telefoneAlternativo" value="" placeholder="(88)99999-9999">
                  </div>
                </div>

                <div class="col-lg-3">
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
