@extends('layouts.layout-operador')

@section('conteudo')

	<div class="row">
		<div class="col-md-12">
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<a href="/operador" class="btn btn-info"><i class="fa fa-reply"></i>  Voltar</a>
					<hr>
					<h3 class="panel-title">Cadastro de pacientes</h3>
					<p class="panel-subtitle"><span class="vermelho">(*) Campos Obrigatórios</span></p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12" id="status">
							@isset($resposta)
								@if ($resposta === 1)
									<div class="alert alert-danger alert-dismissible" role="alert">
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			              <i class="fa fa-times-circle"></i> Por favor preencha todos os campos corretamente!
		              </div>
								@else
									@if ($resposta === 2)
										<div class="alert alert-danger alert-dismissible" role="alert">
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				              <i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de CNS já foi registrado no sistema!
			              </div>
									@else
										@if ($resposta === 3)
											<div class="alert alert-danger alert-dismissible" role="alert">
					              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					              <i class="fa fa-times-circle"></i> Data de Nascimento do paciente Inválida!
				              </div>
										@else
											@if ($resposta === 4)
												<div class="alert alert-danger alert-dismissible" role="alert">
					              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					              <i class="fa fa-times-circle"></i> Erro insperado, tente mais tarde!
					              </div>
											@else
												@if ($resposta === 6)
													<div class="alert alert-danger alert-dismissible" role="alert">
							              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							              <i class="fa fa-times-circle"></i> O número do Cartão Nacional da Saúde (CNS) deve ter 15 digitos!
						              </div>
												@else
													@if ($resposta === 7)
														<div class="alert alert-danger alert-dismissible" role="alert">
								              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								              <i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de <b>CPF</b> já foi registrado no sistema!
							              </div>
													@else
														@if ($resposta === 8)
															<div class="alert alert-danger alert-dismissible" role="alert">
									              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								              	<i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de <b>RG</b> já foi registrado no sistema!
								              </div>
														@endif
													@endif
												@endif
											@endif
										@endif
									@endif
								@endif
							@endisset
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
								placeholder="Pedro da Silva" title="Informe neste campo o nome completo do paciente" value="{{ old('nome_paciente') }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Sexo:<span class="vermelho">*</span></label>
								<select class="form-control campo" name="sexo" id="sexo" title="Selecione o sexo do paciente que está sendo cadastrado">
									<option value="" disabled selected>SELECIONE...</option>
									<option value="MASCULINO" @if (old('sexo') === 'MASCULINO') selected="selected" @endif >MASCULINO</option>
									<option value="FEMININO" @if (old('sexo') === 'FEMININO') selected="selected" @endif >FEMININO</option>
								</select>
							</div>
							<div class="col-md-4 form-group">
								<label>Data de Nascimento:<span class="vermelho">*</span></label>
								<input class="form-control" type="date" name="data_nascimento" id="data_nascimento" title="Informe a data de nascimento do paciente"  value="{{ old('data_nascimento') }}">
							</div>
							<div class="col-md-4 form-group">
								<label>Número do CNS:<span class="vermelho">*</span></label>
								<input class="form-control campo" type="text" name="numero_cns" id="numero_cns" placeholder="000.1234.9890.9893" title="Informe a numeração do Cartão Nacional da Saúde"  value="{{ old('numero_cns') }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>CPF (Opcional):</label>
								<input class="form-control" type="text" name="cpf" id="cpf" placeholder="000.123.890-98" title="Se o paciente estiver com CPF em mãos, por favor informe a numeração presente no mesmo (CPF)!"  value="{{ old('cpf') }}">
							</div>
							<div class="col-md-6 form-group">
								<label>RG (Opcional):</label>
								<input class="form-control" type="text" name="rg" id="rg" placeholder="2007147335" title="Se o paciente estiver com RG em mãos, por favor informe a numeração presente no mesmo (RG)!"  value="{{ old('rg') }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Nome da Mãe:<span class="vermelho">*</span></label>
								<input class="form-control campo" type="text" name="nome_mae" id="nome_mae" placeholder="Maria da Silva Pereira"  value="{{ old('nome_mae') }}">
							</div>
							<div class="col-md-6 form-group">
								<label>Nome da Pai (Opcional):</label>
								<input class="form-control campo" type="text" name="nome_pai" id="nome_pai" placeholder="Francisco Pereira"  value="{{ old('nome_pai') }}">
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
								<input type="text" name="rua" id="rua" class="form-control campo" placeholder="Rua 7 de Setembro"  value="{{ old('rua') }}">
							</div>
							<div class="col-md-4 form-group">
								<label>Número:<span class="vermelho">*</span></label>
								<input type="text" name="numero" id="numero" placeholder="777" class="form-control"  value="{{ old('numero') }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" placeholder="Casa A" class="form-control campo"  value="{{ old('complemento') }}">
							</div>
							<div class="col-md-6 form-group">
								<label>Bairro:<span class="vermelho">*</span></label>
								<input type="text" name="bairro" id="bairro" placeholder="Centro" class="form-control campo"  value="{{ old('bairro') }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Cidade:<span class="vermelho">*</span></label>
								<input type="text" name="nome_cidade" id="cidade" placeholder="Milagres" class="form-control campo"  @if (old('cidade') != null) value="{{old('cidade')}}" @else Value="Milagres" @endif>
							</div>
							<div class="col-md-4 form-group">
								<label>CEP:<span class="vermelho">*</span></label>
								<input type="text" name="cep" id="cep" placeholder="63250-000" class="form-control campo" @if (old('cep') != null) value="{{old('cep')}}" @else value="63250000" @endif>
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
								<input type="text" name="telefone_um" id="telefone_um" placeholder="(88)99999-9988" class="form-control" value="{{ old('telefone_um')}}">
							</div>
							<div class="col-md-6 form-group">
								<label>Telefone Adicional (Opicional):</label>
								<input type="text" name="telefone_dois" id="telefone_dois" placeholder="(88)99999-9988" class="form-control"  value="{{ old('telefone_dois')}}">
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
							<span class="col-md-1"></span>
							<div class="col-md-3">
								<a href="/operador" class="btn btn-danger"><i class="fa fa-times"></i>  Cancelar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>

	</div>

@endsection
