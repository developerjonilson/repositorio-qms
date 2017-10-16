<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PDF</title>

		<style type="text/css">
		body {
		  font-family: arial, helvetica, sans-serif;
		}
		table {
			width: 100%;
		}
		.text-center {
    	text-align: center;
		}
		.text-right {
    	text-align: right;
		}
		#marcaDagua {
	    position: fixed;
			top: 3%;
	    width: 100%;
	    text-align: center;
	    opacity: .2;
	    z-index: -1000;
	  }
		.footer {
			position: fixed;
			bottom: 0px;
		}
		</style>

	</head>
	<body>
		<div class="" id="marcaDagua">
			<img src="/var/www/html/repositorio-qms/src/public/img/milagres.jpg">
		</div>

		<div class="container">
			<div class="row">
				<div class="text-center">
					<img src="/var/www/html/repositorio-qms/src/public/img/logo-prefeitura.png" width="100" height="100">
				</div>
				<h2 class="text-center"> SECRETÁRIA MUNICIPAL DE MILAGRES </h2>
				<h3 class="text-center"> CENTRAL MUNICIPAL DE REGULAÇÃO - QMS </h3>
			</div>
			<hr>
			<div class="row">
				<h4><b>Informações do Paciente</b></h4>
			</div>
			<div class="row">
				<table border="1px">
					<tr>
						<td><b>Nome do Paciente</b></td>
						<td><label>{{$consulta->nome_paciente}}</label></td>
					</tr>
					<tr>
						<td><b>Número do CNS</b></td>
						<td><label>{{$consulta->numero_cns}}</label></td>
					</tr>
					<tr>
						<td><b>Nome da Mãe</b></td>
						<td><label>{{$consulta->nome_mae}}</label></td>
					</tr>
				</table>
			</div>
			<br>
			<hr>
			<div class="row">
				<h4><b>Informações da Consulta</b></h4>
			</div>
			<div class="row">
				<table border="1px">
					<tr>
						<td><b>Especialidade</b></td>
						<td>{{$consulta->nome_especialidade}}</td>
					</tr>
					<tr>
						<td><b>Medico</b></td>
						<td>{{$consulta->numero_crm}} - {{$consulta->nome_medico}}</td>
					</tr>
					<tr>
						<td><b>Data da consulta</b></td>
						<td>{{ date('d/m/Y', strtotime($consulta->data)) }}</td>
					</tr>
					<tr>
						<td><b>Periodo / Horário</b></td>
						<td>{{ $consulta->nome }}</td>
					</tr>
				</table>
			</div>
			<br>
			<hr>
			<div class="row">
				<h4><b>Informações do Local da Consulta</b></h4>
			</div>
			<table border="1px">
				<tr>
					<td><b>Local</b></td>
					<td>{{ $consulta->nome_fantasia}}</td>
				</tr>
			</table>
		</div>

		<div class="footer">
			<hr>
			<div class="text-center">
				QMS - Query System Management   -   {{date('d/m/Y')}}
			</div>
		</div>


	</body>
</html>
