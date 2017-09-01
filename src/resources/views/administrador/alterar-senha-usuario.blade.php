@extends('layout.layout-administrador')

@section('conteudo')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Alterar Senha de Usuário</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="row">
    <label class="col-sm-1"></label>
    <div class="col-sm-10">
      <!-- alertas e mensagens -->
    </div>
    <label class="col-sm-1"></label>
  </div>

  <div class="row">
    <label class="col-sm-3"></label>
    <div class="col-sm-6">
      <form class="" action="#" method="post">
          <div class="panel panel-warning">
            <div class="panel-heading">
              Formulário para alteração de senha
            </div>
            <div class="panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" class="form-control" name="senha" value="" placeholder="Senha Usada Atualmente" autofocus>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                    <label>Nova Senha</label>
                    <input type="password" class="form-control" name="novaSenha" value="" placeholder="Nova Senha">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label>Confirmar Nova Senha</label>
                  <input type="password" class="form-control" name="confirmarNovaSenha" value="" placeholder="Confirme a Nova Senha">
                </div>
              </div>

              <div class="col-sm-5">
                <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>  Confirmar Alteração</button>
              </div>

              <div class="col-sm-5">
                <a href="#" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>  Cancelar</a>
              </div>
            </div>
          </div>
      </form>

    </div>
    <label class="col-sm-3"></label>
  </div>
  <!-- /.row -->

  </div>
  <!-- /#page-wrapper -->
@endsection
