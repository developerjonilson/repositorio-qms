<!doctype html>
<html lang="pt-br">

<head>
	<title>Painel de Controle | QMS - Administrador</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">1</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>Altere sua senha agora</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Bem-Vindo ao QMS</a></li>
								<li><a href="#" class="more">Ver Todas as Notificações</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Ajuda</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Manual de Usuário</a></li>
								<li><a href="#">Falar com Administrador</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/user.png" class="img-circle" alt="Avatar"> <span>Fábio</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="perfil.html"><i class="lnr lnr-user"></i> <span>Meu Perfil</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Mensagens</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Configurações</span></a></li>
								<li><a href="#"><i class="lnr lnr-exit"></i> <span>Sair</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<!-- meus itens meu -->
						<li><a href="index.html" class="active"><i class="lnr lnr-home"></i> <span>Painel de Controle</span></a></li>

						<li>
							<a href="#subPaciente" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Paciente</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPaciente" class="collapse ">
								<ul class="nav">
									<li><a href="cadastrar-paciente.html" class="">Cadastrar Paciente</a></li>
									<li><a href="pesquisar-paciente.html" class="">Pesquisar Paciente</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subConsulta" data-toggle="collapse" class="collapsed"><i class="fa fa-stethoscope"></i> <span>Consultas</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subConsulta" class="collapse ">
								<ul class="nav">
									<li><a href="agendar-consulta.html" class="">Agendar Consulta Médica</a></li>
									<li><a href="pesquisar-consultas.html" class="">Pesquisar Consultas</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subRelatorio" data-toggle="collapse" class="collapsed"><i class="lnr lnr-list"></i> <span>Relatórios</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subRelatorio" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Diário</a></li>
									<li><a href="page-profile.html" class="">Mensal</a></li>
									<li><a href="page-profile.html" class="">Personalizado</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

					@yield('conteudo')

				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<!-- <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p> -->
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="/vendor/jquery/jquery.min.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="/vendor/chartist/js/chartist.min.js"></script>
	<script src="/scripts/klorofil-common.js"></script>

</body>

</html>
