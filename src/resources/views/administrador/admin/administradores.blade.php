@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li class="active">Administradores</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Administradores</h3>
        <hr>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_create_administrador">
              <i class="fa fa-plus-square-o"></i> Adicionar Administrador
            </button>
          </div>
        </div>
        <hr>
        <table id="administradores_table" class="table table-striped table-bordered table-responsive table-hover table-condensed data-table">
          <thead>
            <tr>
              <th>Código Administrador</th>
              <th>Nome</th>
              <th>Email</th>
              <th width="150">Ações</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>

  <form class="" action="{{ route('administrador.cadastrar-administrador') }}" method="post" id="form_create_administrador" novalidate>
    {{ csrf_field() }}
    {{--           --------- Modal atendente -----------                --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalCreateAdministrador" id="modal_create_administrador" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalGeneralAdministradorTitle">Cadastrar Administrador</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <h4>Informações Pessoais</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="name">Nome<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="name" value="{{ old('name') }}" placeholder="JOSE DA SILVA FILHO">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento<span class="vermelho">*</span></label>
                  <div class="form-group">
                    <div class="input-group date" data-toggle="datepicker">
                      <input type="text" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}" placeholder="01/01/1998" onchange="revalidateDate(form.id)">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf">CPF<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="cpf" placeholder="233.140.732-09" value="{{ old('cpf') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="rg">RG<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="rg" placeholder="2007912033" value="{{ old('rg') }}">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email<span class="vermelho">*</span></label>
                  <input type="email" class="form-control" name="email" placeholder="jose@gmail.com" value="{{ old('email') }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Senha</label>
                  <input type="text" class="form-control campo" value='Será adiciona a senha padrão ( QMS12345678 ), que será obrigatório a alteração da mesma no primeiro acesso!' disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Endereço</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="rua">Rua<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="rua" placeholder="RUA FRANCISCO DA CUNHA" value="{{ old('rua') }}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="numero">Número<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="numero" placeholder="555" value="{{ old('numero') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="complemento">Complemento</label>
                  <input type="text" class="form-control campo" name="complemento" placeholder="CASA A1" value="{{ old('complemento') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="bairro">Bairro<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="bairro" placeholder="CENTRO" value="{{ old('bairro') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cidade">Cidade<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="nome_cidade" placeholder="MILAGRES" value="{{ old('nome_cidade') }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cep">CEP<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="cep" placeholder="632500-000" value="{{ old('cep') }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="estado">Estado<span class="vermelho">*</span></label>
                  <select name="nome_estado" class="form-control">
                    <option value="ACRE">ACRE</option>
                    <option value="ALAGOAS">ALAGOAS</option>
                    <option value="AMAPA">AMAPA</option>
                    <option value="AMAZONAS">AMAZONAS</option>
                    <option value="BAHIA">BAHIA</option>
                    <option value="CEARA" selected>CEARA</option>
                    <option value="DISTRITO FEDEREAL">DISTRITO FEDEREAL</option>
                    <option value="ESPIRITO SANTO">ESPIRITO SANTO</option>
                    <option value="GOIAS">GOIAS</option>
                    <option value="MARANHAO">MARANHAO</option>
                    <option value="MATO GROSSO">MATO GROSSO</option>
                    <option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
                    <option value="MINAS GEREAIS">MINAS GEREAIS</option>
                    <option value="PARA">PARA</option>
                    <option value="PARAIBA">PARAIBA</option>
                    <option value="PARANA">PARANA</option>
                    <option value="PERNAMBUCO">PERNAMBUCO</option>
                    <option value="PIAUI">PIAUI</option>
                    <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                    <option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
                    <option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
                    <option value="RONDONIA">RONDONIA</option>
                    <option value="RORAIMA">RORAIMA</option>
                    <option value="SANTA CATARINA">SANTA CATARINA</option>
                    <option value="SAO PAULO">SAO PAULO</option>
                    <option value="SERGIPE">SERGIPE</option>
                    <option value="TOCANTINS">TOCANTINS</option>
  							</select>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Contatos</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone_um">Telefone<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="telefone_um" placeholder="(88) 99900-1234" value="{{ old('telefone_um') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone_dois">Telefone (Opcional)</label>
                  <input type="text" class="form-control" name="telefone_dois" placeholder="(88) 99900-1234" value="{{ old('telefone_dois') }}">
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer" id="btn_actions_modal_create_operador">
            <button type="submit" class="btn btn-success" id="btn_save_atendente" value=""><i class="fa fa-check"></i>  Salvar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cancel_create_atendente"><i class="fa fa-times-circle"></i>  Cancelar</button>
          </div>
        </div>
        </div>
      </div>

  </form>

  <form class="" action="{{ route('administrador.editar-administrador') }}" method="post" id="form_actions_administrador" novalidate>
    <input type="hidden" name="administrador_id" value="{{ old('administrador_id') }}">
    {{ csrf_field() }}
    {{--           --------- Modal atendente -----------                --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalActionsAdministrador" id="modal_actions_administrador" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalGeneralAdministradorTitle">Detalhes do Administrador</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <h4>Informações Pessoais</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="name">Nome<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="name" value="{{ old('name') }}" placeholder="JOSE DA SILVA FILHO" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento<span class="vermelho">*</span></label>
                  <div class="form-group">
                    <div class="input-group date" data-toggle="datepicker">
                      <input type="text" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}" placeholder="01/01/1998" onchange="revalidateDate(form.id)" disabled>
                      <div class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf">CPF<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="cpf" id="cpf" placeholder="233.140.732-09" value="{{ old('cpf') }}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="rg">RG<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="rg" placeholder="2007912033" value="{{ old('rg') }}" disabled>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email<span class="vermelho">*</span></label>
                  <input type="email" class="form-control" name="email" placeholder="jose@gmail.com" value="{{ old('email') }}" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Endereço</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="rua">Rua<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="rua" placeholder="RUA FRANCISCO DA CUNHA" value="{{ old('rua') }}" disabled>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="numero">Número<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="numero" placeholder="555" value="{{ old('numero') }}" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="complemento">Complemento</label>
                  <input type="text" class="form-control campo" name="complemento" value="{{ old('complemento') }}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="bairro">Bairro<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="bairro" placeholder="CENTRO" value="{{ old('bairro') }}" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cidade">Cidade<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="nome_cidade" placeholder="MILAGRES" value="{{ old('nome_cidade') }}" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cep">CEP<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="cep" placeholder="632500-000" value="{{ old('cep') }}"disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="estado">Estado<span class="vermelho">*</span></label>
                  <select name="nome_estado" class="form-control" disabled>
                    <option value="ACRE">ACRE</option>
                    <option value="ALAGOAS">ALAGOAS</option>
                    <option value="AMAPA">AMAPA</option>
                    <option value="AMAZONAS">AMAZONAS</option>
                    <option value="BAHIA">BAHIA</option>
                    <option value="CEARA" selected>CEARA</option>
                    <option value="DISTRITO FEDEREAL">DISTRITO FEDEREAL</option>
                    <option value="ESPIRITO SANTO">ESPIRITO SANTO</option>
                    <option value="GOIAS">GOIAS</option>
                    <option value="MARANHAO">MARANHAO</option>
                    <option value="MATO GROSSO">MATO GROSSO</option>
                    <option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
                    <option value="MINAS GEREAIS">MINAS GEREAIS</option>
                    <option value="PARA">PARA</option>
                    <option value="PARAIBA">PARAIBA</option>
                    <option value="PARANA">PARANA</option>
                    <option value="PERNAMBUCO">PERNAMBUCO</option>
                    <option value="PIAUI">PIAUI</option>
                    <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                    <option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
                    <option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
                    <option value="RONDONIA">RONDONIA</option>
                    <option value="RORAIMA">RORAIMA</option>
                    <option value="SANTA CATARINA">SANTA CATARINA</option>
                    <option value="SAO PAULO">SAO PAULO</option>
                    <option value="SERGIPE">SERGIPE</option>
                    <option value="TOCANTINS">TOCANTINS</option>
                </select>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Contatos</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone_um">Telefone<span class="vermelho">*</span></label>
                  <input type="text" class="form-control" name="telefone_um" placeholder="(88) 99900-1234" value="{{ old('telefone_um') }}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone_dois">Telefone (Opcional)</label>
                  <input type="text" class="form-control" name="telefone_dois" value="{{ old('telefone_dois') }}" disabled>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer" id="btn_actions_modal_administrador">
            <div class="" id="btn_group">
              <button type="button" class="btn btn-warning" id="btn_edit_administrador" value=""><i class="fa fa-pencil-square-o"></i>  Editar</button>
              <button type="button" class="btn btn-danger" id="btn_delete_administrador" value=""><i class="fa fa-trash-o"></i>  Excluir</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Fechar</button>
            </div>
          </div>
        </div>
        </div>
      </div>

  </form>

@endsection

@section('scripts')

  $(function() {
    $('#administradores_table').DataTable({
        "oLanguage": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('administrador.get-administradores') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],

    });
  });

  function editing(id) {
    $('#btn_group').addClass('hidden');

    $('#btn_actions_modal_administrador').append(
      '<div class="" id="btn_group_edit">'+
      '<button type="submit" class="btn btn-success" id="btn_edit_administrador" value=""><i class="fa fa-check"></i>  Salvar Alterações</button>'+
      '<button type="button" class="btn btn-danger" data-dismiss="modal" id=""><i class="fa fa-times-circle"></i>  Cancelar</button>'+
      '</div>'
    );
    enabledForm('#form_actions_administrador')
  };

  @isset($erro)
    swal({
      position: 'top',
      title: 'Erro!',
      text: '{{ $erro }}',
      type: 'error'
    });
    $('#modal_create_administrador').modal('show');
  @endisset

  @isset($sucesso)
    swal({
      position: 'top',
      title: 'Sucesso!',
      text: '{{ $sucesso }}',
      type: 'success',
      timer: 4000
    });
  @endisset

  @isset($erroExcluir)
    swal({
      position: 'top',
      title: 'Erro!',
      text: '{{ $erroExcluir }}',
      type: 'error'
    });
  @endisset

  @isset($erroEdit)
    let id = $('input[name="administrador_id"]').val();
    swal({
      position: 'top',
      title: 'Erro!',
      text: '{{ $erroEdit }}',
      type: 'error'
    });

    editing(id);

    $('#modal_actions_administrador').modal('show');
  @endisset

  function detalhesAdministrador(id) {
    $('.loading').fadeOut(700).removeClass('hidden');

    $.get('/administrador/ver-administrador/' + id, function (administrador) {

      $('#form_actions_administrador input[name="administrador_id"]').attr('value', administrador.id);
      $('#form_actions_administrador input[name="name"]').attr('value', administrador.name);
      $('#form_actions_administrador input[name="data_nascimento"]').attr('value', moment(administrador.data_nascimento).format('DD/MM/YYYY'));
      $('#form_actions_administrador input[name="cpf"]').attr('value', administrador.cpf).trigger('input');
      $('#form_actions_administrador input[name="rg"]').attr('value', administrador.rg).trigger('input');
      $('#form_actions_administrador input[name="email"]').attr('value', administrador.email);
      $('#form_actions_administrador input[name="rua"]').attr('value', administrador.rua);
      $('#form_actions_administrador input[name="numero"]').attr('value', administrador.numero);
      $('#form_actions_administrador input[name="complemento"]').attr('value', administrador.complemento);
      $('#form_actions_administrador input[name="bairro"]').attr('value', administrador.bairro);
      $('#form_actions_administrador input[name="nome_cidade"]').attr('value', administrador.nome_cidade);
      $('#form_actions_administrador input[name="cep"]').attr('value', administrador.cep).trigger('input');
      $('#form_actions_administrador select[name="nome_estado"]').attr('value', administrador.nome_estado);
      $('#form_actions_administrador input[name="telefone_um"]').attr('value', administrador.telefone_um).trigger('input');
      $('#form_actions_administrador input[name="telefone_dois"]').attr('value', administrador.telefone_dois).trigger('input');

      disabledForm('#form_actions_administrador')

      $('#btn_delete_administrador').attr('value', administrador.id);

      $('#modal_actions_administrador').modal('show');
    });
    $('.loading').fadeOut(700).addClass('hidden');

  };


  $('#btn_delete_administrador').click(function () {
    let administrador_id = $(this).val();

    swal({
      position: 'top',
      title: 'Excluir Administrador',
      text: "Você tem certeza que deseja excluir esse Administrador?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5cb85c',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
    }).then(function (result) {
      if (result.value) {
        $('.loading').fadeOut(700).removeClass('hidden');

        $.post("{{ route('administrador.excluir-administrador') }}",
        {
          _token: "{{ csrf_token() }}",
           id: administrador_id
        },
        function(result) {
          if (result.menssage === 'error') {
            swal({
              position: 'top',
              title: 'Erro!',
              text: 'Ocorreu um erro ao excluir o administrador, tente em instantes!',
              type: 'error',
              confirmButtonText: 'Ok'
            });
            $('.loading').fadeOut(700).addClass('hidden');
          }
          if (result.menssage === 'error_num') {
            swal({
              position: 'top',
              title: 'Erro!',
              text: 'Não é possível exclucir pois só existe um administrador cadastrado!',
              type: 'error',
              confirmButtonText: 'Ok'
            });
            $('.loading').fadeOut(700).addClass('hidden');
          }
          if (result.menssage === 'success') {
            $('.loading').fadeOut(700).addClass('hidden');
            swal({
              position: 'top',
              title: 'Excluído!',
              text: 'O administrador foi excluído com sucesso!',
              type: 'success'
            }).then(function (result) {
              $('.loading').fadeOut(700).removeClass('hidden');
              location.reload(true)
            })
          }
        }, "json");

      }
    })
  });

  $('#modal_create_administrador').on('hidden.bs.modal', function (event) {
    $("#form_create_administrador")[0].reset();

    $('#form_create_administrador input[name="name"]').attr('value','');
    $('#form_create_administrador input[name="data_nascimento"]').attr('value','');
    $('#form_create_administrador input[name="cpf"]').attr('value','');
    $('#form_create_administrador input[name="rg"]').attr('value','');
    $('#form_create_administrador input[name="email"]').attr('value','');
    $('#form_create_administrador input[name="rua"]').attr('value','');
    $('#form_create_administrador input[name="numero"]').attr('value','');
    $('#form_create_administrador input[name="complemento"]').attr('value','');
    $('#form_create_administrador input[name="bairro"]').attr('value','');
    $('#form_create_administrador input[name="nome_cidade"]').attr('value','');
    $('#form_create_administrador input[name="cep"]').attr('value','');
    $('#form_create_administrador select[name="nome_estado"]').attr('value','');
    $('#form_create_administrador input[name="telefone_um"]').attr('value','');
    $('#form_create_administrador input[name="telefone_dois"]').attr('value','');
  });

  $('#btn_edit_administrador').click(function(){
    var id = $('#btn_delete_administrador').val();

    editing(id);
  });


  $('#modal_actions_administrador').on('hidden.bs.modal', function (event) {
    if ($('#btn_group').hasClass("hidden")) {
      $('#btn_group').removeClass('hidden');

      $('#btn_group_edit').remove();
    }
  });

  function cancelEdit(id) {
    $('.loading').fadeOut(700).removeClass('hidden');

    $.get('/administrador/ver-administrador/' + id, function (administrador) {
      $('#form_actions_administrador input[name="name"]').attr('value', administrador.name).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="data_nascimento"]').attr('administrador', moment(atendente.data_nascimento).format('DD/MM/YYYY')).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="cpf"]').attr('value', administrador.cpf).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="rg"]').attr('value', administrador.rg).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="email"]').attr('value', administrador.email).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="rua"]').attr('value', administrador.rua).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="numero"]').attr('value', administrador.numero).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="complemento"]').attr('value', administrador.complemento).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="bairro"]').attr('value', administrador.bairro).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="nome_cidade"]').attr('value', administrador.nome_cidade).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="cep"]').attr('value', administrador.cep).attr('disabled', 'disabled');
      $('#form_actions_administrador select[name="nome_estado"]').attr('value', administrador.nome_estado).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="telefone_um"]').attr('value', administrador.telefone_um).attr('disabled', 'disabled');
      $('#form_actions_administrador input[name="telefone_dois"]').attr('value', administrador.telefone_dois).attr('disabled', 'disabled');
    });

    $('.loading').fadeOut(700).addClass('hidden');
  };

@endsection
