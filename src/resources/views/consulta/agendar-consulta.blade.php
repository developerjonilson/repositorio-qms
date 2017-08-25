@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Agendamento de Consulta Médica</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="well">

    <div class="row">
      <form class="" action="#" method="post">
      <div class="col-sm-12">
        <div class="panel panel-green">
          <div class="panel-heading">
            Informações do Paciente
          </div>
          <div class="panel-body">
            <div class="col-lg-6">
              <div class="form-group">
                  <label>CPF*</label>
                  <input type="text" class="form-control" name="cpf" value="" placeholder="000.000.000-00" autofocus>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                  <label>Número do Cartão do SUS*</label>
                  <input type="text" class="form-control" name="cartaoSus" value="" placeholder="0000.0000.0000.0000">
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                  <label>Nome Completo*</label>
                  <input type="text" class="form-control" name="nome" value="" disabled>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            Nessa etapa o paciente já deve estar cadastrado no sistema.
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="panel panel-green">
          <div class="panel-heading">
            Informações da Consulta
          </div>
          <div class="panel-body">
            <div class="col-sm-4">
              <div class="form-group">
                  <label>Especialidade*</label>
                  <select class="form-control" name="especialidade">
                      <option value="pediatria" selected>Pediatria</option>
                      <option value="ortopedia e traumatologia">Ortopedia e Traumatologia</option>
                  </select>
              </div>
            </div>

            <div class="col-sm-8">
              <div class="form-group">
                  <label>Médico*</label>
                  <select class="form-control" name="medico">
                      <option value="Pedro" selected>Pedro</option>
                      <option value="Paulo">Paulo</option>
                  </select>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                  <label>Data da Consulta*</label>
                  <input type="date" class="form-control" name="data">
              </div>
            </div>

            <div class="col-sm-8">
              <div class="form-group">
                  <label>Local da Consulta*</label>
                  <select class="form-control" name="local">
                      <option value="hospital" selected>Hospital Nossa Senhora dos Milagres</option>
                  </select>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                  <label>Observações</label>
                  <textarea class="form-control" rows="3" name="observacao"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="col-sm-4">
          <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>  Confirmar Agendamento de Consulta</button>
        </div>
        <div class="col-sm-4">
          <a href="#" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>  Cancelar</a>
        </div>
      </div>
      <label></label>
      </form>
    </div>
    <!-- /.row -->

  </div>

@endsection
