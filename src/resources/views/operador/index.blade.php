@extends('layout.layout-operador')

@section('conteudo')

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Painel de Controle</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->

  <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-male fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">26</div>
                          <div>Pacientes</div>
                      </div>
                  </div>
              </div>
              <a href="{{ action('PacienteController@cadastrarPaciente') }}">
                  <div class="panel-footer">
                      <span class="pull-left">Cadastrar Paciente</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-stethoscope fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">12</div>
                          <div>Consultas Agendadas</div>
                      </div>
                  </div>
              </div>
              <a href="{{ action('ConsultaController@agendarConsulta') }}">
                  <div class="panel-footer">
                      <span class="pull-left">Agendar Consulta</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-calendar fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">28</div>
                          <div>Calendário Médico</div>
                      </div>
                  </div>
              </div>
              <a href="#">
                  <div class="panel-footer">
                      <span class="pull-left">Ver Horários</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-file-pdf-o fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">1</div>
                          <div>Manual do Sistema</div>
                      </div>
                  </div>
              </div>
              <a href="{{ action('SistemaController@manualOperador') }}">
                  <div class="panel-footer">
                      <span class="pull-left">Visualizar Manual</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <i class="fa fa-bell fa-fw"></i> Painel de Notificações
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <ul class="timeline">
                      <li>
                          <div class="timeline-badge success"><i class="fa fa-check"></i>
                          </div>
                          <div class="timeline-panel">
                              <div class="timeline-heading">
                                  <h4 class="timeline-title">Seja Bem-Vindo!</h4>
                                  <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 horas atrás</small>
                                  </p>
                              </div>
                              <div class="timeline-body">
                                  <p>Seja bem-vindo ao QMS - Query Management System, o novo sistema de gerenciamento de consultas médicas da Secretária de Saúde de Milagres - CE.</p>
                              </div>
                          </div>
                      </li>
                  </ul>
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-8 -->
  </div>
  <!-- /.row -->


@endsection
