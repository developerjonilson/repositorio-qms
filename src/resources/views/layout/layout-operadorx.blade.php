<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Query Management System</title>

    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/estilos.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"> <i class="fa fa-stethoscope fa-1x"></i>  QMS - Query Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ action('OperadorController@perfil') }}"><i class="fa fa-user fa-fw"></i> Meu Perfil</a>
                        </li>
                        <li><a href="{{ action('OperadorController@alterarSenha') }}"><i class="fa fa-gear fa-fw"></i> Alterar Senha</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Sair </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ action('OperadorController@index') }}"><i class="fa fa-th fa-fw"></i>  Início</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-male fa-fw"></i> Pacientes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ action('PacienteController@cadastrarPaciente') }}">Cadastrar Paciente</a>
                                </li>
                                <li>
                                    <a href="{{ action('PacienteController@buscarPaciente') }}">Buscar Paciente</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-stethoscope fa-fw"></i> Consultas Médicas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ action('ConsultaController@agendarConsulta') }}">Agendar Consulta Médica</a>
                                </li>
                                <li>
                                    <a href="{{ action('ConsultaController@buscarConsulta') }}">Pesquisar Consultas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Relatórios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ action('ConsultaController@relatorioDiario') }}">Diário</a>
                                </li>
                                <li>
                                    <a href="{{ action('ConsultaController@relatorioMensal') }}">Mensal</a>
                                </li>
                                <li>
                                    <a href="{{ action('ConsultaController@relatorioPersonalizado') }}">Personalizado</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ action('SistemaController@manualOperador') }}"><i class="fa fa-file-pdf-o fa-fw"></i> Manual do QMS</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

          @yield('conteudo')

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/vendor/raphael/raphael.min.js"></script>
    <script src="/vendor/morrisjs/morris.min.js"></script>
    <script src="/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/dist/js/sb-admin-2.js"></script>

</body>

</html>
