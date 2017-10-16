@extends('layouts.layout-operador')

@section('conteudo')

	{{-- <h3 class="page-title">Cadastro de pacientes</h3> --}}
	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Cadastro de pacientes</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" id="status">
							{{-- div para as respostas do servidor --}}
						</div>
					</div>
					<form class="" action="{{ action('PacienteController@createPaciente') }}" method="post" id="form-create-paciente">
						{{ csrf_field() }}
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4>Informações Pessoais</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Nome do paciente:<span class="vermelho">*</span></label>
								<input class="form-control campo" type="text" name="nome_paciente" id="nome_paciente"
								value="" placeholder="Pedro da Silva" title="Informe neste campo o nome completo do paciente">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Sexo:<span class="vermelho">*</span></label>
								<select class="form-control campo" name="sexo" id="sexo" title="Selecione o sexo do paciente que está sendo cadastrado">
									<option value="" disabled selected>SELECIONE...</option>
									<option value="MASCULINO">MASCULINO</option>
									<option value="FEMININO">FEMININO</option>
								</select>
							</div>
							<div class="col-md-4 form-group">
								<label>Data de Nascimento:<span class="vermelho">*</span></label>
								<input class="form-control" type="date" name="data_nascimento" id="data_nascimento" value="" title="Informe a data de nascimento do paciente">
							</div>
							<div class="col-md-4 form-group">
								<label>Número do CNS:<span class="vermelho">*</span></label>
								<input class="form-control campo" type="text" name="numero_cns" id="numero_cns" value="" placeholder="000.1234.9890.9893" title="Informe a numeração do Cartão Nacional da Saúde">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>CPF (Opcional):</label>
								<input class="form-control" type="text" name="cpf" id="cpf" value="" placeholder="000.123.890-98" title="Se o paciente estiver com CPF em mãos, por favor informe a numeração presente no mesmo (CPF)!">
							</div>
							<div class="col-md-6 form-group">
								<label>RG (Opcional):</label>
								<input class="form-control" type="text" name="rg" id="rg" value="" placeholder="2007147335" title="Se o paciente estiver com RG em mãos, por favor informe a numeração presente no mesmo (RG)!">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Nome da Mãe:<span class="vermelho">*</span></label>
								<input class="form-control campo" type="text" name="nome_mae" id="nome_mae" value="" placeholder="Maria da Silva Pereira">
							</div>
							<div class="col-md-6 form-group">
								<label>Nome da Pai (Opcional):</label>
								<input class="form-control campo" type="text" name="nome_pai" id="nome_pai" value="" placeholder="Francisco Pereira">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-12">
								<h4>Endereco</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 form-group">
								<label>Rua:<span class="vermelho">*</span></label>
								<input type="text" name="rua" id="rua" class="form-control campo" placeholder="Rua 7 de Setembro">
							</div>
							<div class="col-md-4 form-group">
								<label>Número:<span class="vermelho">*</span></label>
								<input type="text" name="numero" id="numero" placeholder="777" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" placeholder="Casa A" class="form-control campo">
							</div>
							<div class="col-md-6 form-group">
								<label>Bairro:<span class="vermelho">*</span></label>
								<input type="text" name="bairro" id="bairro" placeholder="Centro" value="" class="form-control campo">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Cidade:<span class="vermelho">*</span></label>
								<input type="text" name="nome_cidade" id="cidade" placeholder="Milagres" class="form-control campo" value="Milagres">
							</div>
							<div class="col-md-4 form-group">
								<label>CEP:<span class="vermelho">*</span></label>
								<input type="text" name="cep" id="cep" placeholder="63250-000" class="form-control campo" value="63250000">
							</div>
							<div class="col-md-2 form-group">
								<label>Estado:<span class="vermelho">*</span></label>
								{{-- <input type="text" name="nome_estado" id="nome_estado" placeholder="CE" value="CEARÁ" class="form-control campo"> --}}
								<select name="nome_estado" id="nome_estado" class="form-control">
									<option value="ACRE">ACRE</option>
									<option value="ALAGOAS">ALAGOAS</option>
									<option value="AMAPÁ">AMAPÁ</option>
									<option value="AMAZONAS">AMAZONAS</option>
									<option value="BAHIA">BAHIA</option>
									<option value="CEARÁ" selected>CEARÁ</option>
									<option value="DISTRITO FEDEREAL">DISTRITO FEDEREAL</option>
									<option value="ESPÍRITO SANTO">ESPÍRITO SANTO</option>
									<option value="GOIÁS">GOIÁS</option>
									<option value="MARANHÃO">MARANHÃO</option>
									<option value="MATO GROSSO">MATO GROSSO</option>
									<option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
									<option value="MINAS GEREAIS">MINAS GEREAIS</option>
									<option value="PARÁ">PARÁ</option>
									<option value="PARAÍBA">PARAÍBA</option>
									<option value="PARANÁ">PARANÁ</option>
									<option value="PERNAMBUCO">PERNAMBUCO</option>
									<option value="PIAUÍ">PIAUÍ</option>
									<option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
									<option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
									<option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
									<option value="RONDÔNIA">RONDÔNIA</option>
									<option value="RORAIMA">RORAIMA</option>
									<option value="SANTA CATARINA">SANTA CATARINA</option>
									<option value="SÃO PAULO">PAULO</option>
									<option value="SERGIPE">SERGIPE</option>
									<option value="TOCANTINS">TOCANTINS</option>
							</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-12">
								<h4>Telefones</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Telefone Principal (Opicional):</label>
								<input type="text" name="telefone_um" id="telefone_um" placeholder="(88)99999-9988" value="" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Telefone Adicional (Opicional):</label>
								<input type="text" name="telefone_dois" id="telefone_dois" placeholder="(88)99999-9988" value="" class="form-control">
							</div>
						</div>
						<div class="row">
							<hr>
						</div>
						<div class="row">
							<div class="col-md-3">
								<button type="submit" class="btn btn-success" id="btn-cadastrar-paciente" title="Salvar todos os dados preenchidos acima no sistema QMS">
									<i id="icone-btn-cadastro-paciente" class="fa fa-check-circle"></i>
									Cadastrar
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
