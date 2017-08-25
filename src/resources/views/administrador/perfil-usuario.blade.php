@extends('layout.layout-administrador')

@section('conteudo')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Perfil de Usuário</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-sm-12">
      <a href="{{ action('AdministradorController@alterarUsuario') }}" class="btn btn-primary">Desejo alterar informações</a>
    </div>
  </div>

  <br>
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-warning">
        <div class="panel-heading">
          Informações Pessoais
        </div>
        <div class="panel-body">
          <div class="col-sm-6">
            <div class="form-group">
                <label>Nome Completo</label>
                <label class="form-control">Nome</label>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
                <label>CPF</label>
                <label class="form-control">000.000.000-00</label>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
                <label>RG</label>
                <label class="form-control">00000000000</label>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
                <label>Data de Nascimento</label>
                <label class="form-control">01/01/2000</label>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div class="col-sm-12">
        <div class="panel panel-warning">
          <div class="panel-heading">
            Endereço
          </div>
          <div class="panel-body">
            <div class="col-sm-9">
              <div class="form-group">
                  <label>Rua</label>
                  <label class="form-control">Francisco Pedro Silva</label>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                  <label>Número</label>
                  <label class="form-control">00</label>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                  <label>Bairro</label>
                  <label class="form-control">Bela Vista</label>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                  <label>Cidade</label>
                  <label class="form-control">Milagres</label>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                  <label>Estado</label>
                  <label class="form-control">Ceará</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="panel panel-warning">
          <div class="panel-heading">
            Informações para Contato
          </div>
          <div class="panel-body">
            <div class="col-lg-12">
              <div class="form-group">
                  <label>E-mail</label>
                  <label class="form-control">email@mail.com</label>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label>Telefone</label>
                <label class="form-control">(88)99999-9999</label>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label>Telefone Alternativo</label>
                <label class="form-control">(88)99999-9999</label>
              </div>
            </div>
          </div>
        </div>

        <label></label>
      </div>


  </div>
  <!-- /.row -->

@endsection
