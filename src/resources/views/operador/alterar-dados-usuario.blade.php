@extends('layouts.layout-operador')

@section('conteudo')
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Atualizar Informações do Perfil de Usuário</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

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

      <form class="" action="#" method="post">
        <div class="col-sm-12">
          <div class="panel panel-warning">
            <div class="panel-heading">
              Endereço
            </div>
            <div class="panel-body">
              <div class="col-sm-9">
                <div class="form-group">
                    <label>Rua</label>
                    <input type="text" class="form-control" name="rua" value="" placeholder="Francisco Pedro Silva">
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                    <label>Número</label>
                    <input type="text" class="form-control" name="numero" value="" placeholder="000">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" class="form-control" name="bairro" value="" placeholder="Bela Vista">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" class="form-control" name="cidade" value="Milagres">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control">
                        <option value="Acre">Acre</option>
                        <option value="Alagoas">Alagoas</option>
                        <option value="Amapa">Amapa</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Bahia">Bahia</option>
                        <option value="Ceara" selected>Ceara</option>
                        <option value="Distrito Federal">Distrito Federal</option>
                        <option value="Espirito Santo">Espirito Santo</option>
                        <option value="Goias">Goias</option>
                        <option value="Maranhao">Maranhao</option>
                        <option value="Mato Grosso">Mato Grosso</option>
                        <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                        <option value="Minas Gerais">Minas Gerais</option>
                        <option value="Para">Para</option>
                        <option value="Paraiba">Paraiba</option>
                        <option value="Parana">Parana</option>
                        <option value="Pernambuco">Pernambuco</option>
                        <option value="Piaui">Piaui</option>
                        <option value="Rio de Janeiro">Rio de Janeiro</option>
                        <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                        <option value="Rondonia">Rondonia</option>
                        <option value="Roraima">Roraima</option>
                        <option value="Santa Catarina">Santa Catarina</option>
                        <option value="Sao Paulo">Sao Paulo</option>
                        <option value="Sergipe">Sergipe</option>
                        <option value="Tocantins">Tocantins</option>
                    </select>
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
                    <input type="text" class="form-control" name="email" value="" placeholder="email@mail.com">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" class="form-control" name="telefone1" value="" placeholder="(88)99999-9999">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label>Telefone Alternativo</label>
                  <input type="text" class="form-control" name="telefone2" value="" placeholder="(88)99999-9999">
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="col-sm-3">
              <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>  Confirmar Atualização</button>
            </div>
            <div class="col-sm-4">
              <a href="#" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>  Cancelar</a>
            </div>
          </div>
          <label></label>
        </div>
      </form>


  </div>
  <!-- /.row -->

  </div>
  <!-- /#page-wrapper -->
@endsection
