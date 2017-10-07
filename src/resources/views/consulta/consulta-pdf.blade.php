<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PDF</title>
	</head>
	<body>

		<div class="container">
			<div class="row">
				<h2 class="titulo"> SECRETÁRIA MUNICIPAL DE MILAGRES </h2>
				<h3 class="titulo"> CENTRAL MUNICIPAL DE REGULAÇÃO / QMS </h3>
			</div>
			<hr>
			<br>
			<div class="row">
				<label><b>Nome do Paciente:      </b></label><label>{{$consulta->nome_paciente}}</label>
				<br>
				<label><b>Número CNS:      </b></label><label>{{$consulta->numero_cns}}</label>
			</div>
			<br>
			<hr>
			<br>
			<div class="row">
				<label><b>Especialidade:      </b></label><label>{{$consulta->nome_especialidade}}</label>
			</div>
			<div class="row">
				<label><b>Medico:      </b></label><label>{{$consulta->nome_medico }}</label>
			</div>

			<div class="row">
				<label><b>Data da consulta:      </b></label><label>{{ date('d/m/Y', strtotime($consulta->data)) }}</label>
				<br>
				<label><b>Periodo:      </b></label><label>{{ $consulta->nome }}</label>
			</div>
			<br>
			<hr>
			<br>
			<div class="row">
				<label><b>Local:      </b></label><label>{{ $consulta->nome_fantasia}}</label>
			</div>
		</div>



	</body>
</html>
