@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li class="active">Médicos</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Médicos</h3>
        <hr>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_create_doctor">
              <i class="fa fa-plus-square-o"></i> Adicionar Médico
            </button>
          </div>
        </div>
        <hr>
        <table id="medicos_table" class="table table-striped table-bordered table-responsive table-hover table-condensed data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>CRM</th>
              <th>Nome</th>
              <th width="250">Ações</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>

  <form action="{{ route('administrador.create-medico') }}" method="post" id="create_doctor">
    {{ csrf_field() }}
    {{--           --------- Modal para cadastrar medico -----------                --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalCreateDoctor" id="modal_create_doctor" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastrar Médico</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <h4>Informações Pessoais</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="numero_crm">Número do CRM<span class="vermelho">*</span></label>
                  <input type="number" name="numero_crm" class="form-control" placeholder="123456" value="{{ old('numero_crm') }}">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nome_medico">Nome do Médico<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="nome_medico" placeholder="MARCOS DA SILVA SANTOS" value="{{ old('nome_medico') }}">
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
                  <input type="text" class="form-control campo" name="complemento" value="{{ old('complemento') }}">
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
                  <input type="text" class="form-control" name="telefone_dois" value="{{ old('telefone_dois') }}">
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer" id="btn_modal_create_doctor">
            <button type="submit" class="btn btn-success" id="btn_save_doctor" value=""><i class="fa fa-check"></i>  Salvar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cancel_create_doctor"><i class="fa fa-times-circle"></i>  Cancelar</button>
          </div>

        </div>
        </div>
      </div>

  </form>


  <form class="" action="{{ route('administrador.edit-medico') }}" method="post" id="form_actions_doctor">
    {{ csrf_field() }}

    <input type="hidden" name="medico_id" value="{{ old('medico_id') }}">
    {{--           --------- Modal para ver detalhes do medico -----------                --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_actions_doctor" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalhes do Médico</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <h4>Informações Pessoais</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="numero_crm">Número do CRM<span class="vermelho">*</span></label>
                  <input type="number" name="numero_crm" class="form-control" placeholder="123456" disabled>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nome_medico">Nome do Médico<span class="vermelho">*</span></label>
                  <input type="text" class="form-control campo" name="nome_medico" placeholder="MARCOS DA SILVA SANTOS" disabled>
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
                  <input type="text" class="form-control" name="cep" placeholder="632500-000" value="{{ old('cep') }}" disabled>
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
          <div class="modal-footer" id="btn_actions_doctor">
            <div class="" id="btn_group_doctor">
              <button type="button" class="btn btn-primary" id="btn_especialidade" value=""><i class="fa fa-list-ol"></i>  Especialidades</button>
              <button type="button" class="btn btn-warning" id="btn_edit_doctor" value=""><i class="fa fa-pencil-square-o"></i>  Editar</button>
              <button type="button" class="btn btn-danger" id="btn_delete_doctor" value=""><i class="fa fa-trash-o"></i>  Excluir</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Fechar</button>
            </div>
          </div>

        </div>
        </div>
      </div>
  </form>

  <form class="" action="{{ route('administrador.cadastrar-especialidade-medico') }}" method="post" id="add_especialdiades">
    {{ csrf_field() }}

    <input type="hidden" name="medico_id" value="{{ old('medico_id') }}">
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalEspecialidades"  id="modal_especialidades" data-backdrop="static"  data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastrar especialidades</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Informações do Médico</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="numero_crm">Número do CRM</label>
                  <input type="number" name="numero_crm" class="form-control" value="{{ old('numero_crm') }}" disabled>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nome_medico">Nome do Médico</label>
                  <input type="text" class="form-control campo" name="nome_medico" value="{{ old('nome_medico') }}" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Nova Especialidade</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome_especialidade">Especialidade<span class="vermelho">*</span></label>
                  <select class="form-control" name="especialidade_id">
                    <option disabled selected>Selecione...</option>
                    @isset($especialidades)
                      @foreach ($especialidades as $esp)
                        <option value="{{ $esp->id_especialidade }}">{{ $esp->nome_especialidade}}</option>
                      @endforeach
                    @endisset
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <br>
              <div class="col-md-12">
                <h4>Especialidades já cadastradas</h4>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-hover">
                  <thead>
                    <td width="150"><b>Código</b></td>
                    <td><b>Nome da Especialidade</b></td>
                    <td width="150"><b>Ações</b></td>
                  </thead>
                  <tbody id="especialidades_cadastradas">

                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="save"><i class="fa fa-check-circle"></i>  Cadastrar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cancel_delete"><i class="fa fa-times-circle"></i>  Cancelar</button>
          </div>
        </div>
      </div>
    </div>

  </form>

@endsection

@section('scripts')

  $(function() {
        $('#medicos_table').DataTable({
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
            ajax: '{{ route('administrador.get-medicos') }}',
            columns: [
                { data: 'id_medico', name: 'id_medico' },
                { data: 'numero_crm', name: 'numero_crm' },
                { data: 'nome_medico', name: 'nome_medico' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],

        });
    });

    function editingDoctor(id) {
      $('#btn_group_doctor').addClass('hidden');

      $('#btn_actions_doctor').append(
        '<div class="" id="btn_group_edit_doctor">'+
        '<button type="submit" class="btn btn-success" id="btn_edit_doctor" value=""><i class="fa fa-check"></i>  Salvar Alterações</button>'+
        '<button type="button" class="btn btn-danger" data-dismiss="modal" id=""><i class="fa fa-times-circle"></i>  Cancelar</button>'+
        '</div>'
      );
      enabledForm('#form_actions_doctor')
    };

    function detalhesDoctor(id) {
      $('.loading').fadeOut(700).removeClass('hidden');

      $.get('/administrador/ver-medico/' + id, function (medico) {

        $('#form_actions_doctor input[name="medico_id"]').attr('value', medico.id_medico);
        $('#form_actions_doctor input[name="numero_crm"]').attr('value', medico.numero_crm).trigger('input');
        $('#form_actions_doctor input[name="nome_medico"]').attr('value', medico.nome_medico);
        $('#form_actions_doctor input[name="rua"]').attr('value', medico.rua);
        $('#form_actions_doctor input[name="numero"]').attr('value', medico.numero);
        $('#form_actions_doctor input[name="complemento"]').attr('value', medico.complemento);
        $('#form_actions_doctor input[name="bairro"]').attr('value', medico.bairro);
        $('#form_actions_doctor input[name="nome_cidade"]').attr('value', medico.nome_cidade);
        $('#form_actions_doctor input[name="cep"]').attr('value', medico.cep).trigger('input');
        $('#form_actions_doctor select[name="nome_estado"]').attr('value', medico.nome_estado);
        $('#form_actions_doctor input[name="telefone_um"]').attr('value', medico.telefone_um).trigger('input');
        $('#form_actions_doctor input[name="telefone_dois"]').attr('value', medico.telefone_dois).trigger('input');

        disabledForm('#form_actions_doctor');

        $('#btn_delete_doctor').attr('value', medico.id_medico);

        $('#modal_actions_doctor').modal('show');
      });
      $('.loading').fadeOut(700).addClass('hidden');

    };

    $('#btn_delete_doctor').click(function () {
      let medico_id = $(this).val();

      swal({
        position: 'top',
        title: 'Excluir Médico',
        text: "Você tem certeza que deseja excluir esse Médico?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
      }).then(function (result) {
        if (result.value) {
          $('.loading').fadeOut(700).removeClass('hidden');

          $.post("{{ route('administrador.delete-medico') }}",
          {
            _token: "{{ csrf_token() }}",
             id: medico_id
          },
          function(result) {
            if (result.menssage === 'error') {
              swal({
                position: 'top',
                title: 'Erro!',
                text: 'Ocorreu um erro ao excluir o Médico, tente em instantes!',
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
                text: 'O médico foi excluído com sucesso!',
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

    $('#modal_create_doctor').on('hidden.bs.modal', function (event) {
      $("#create_doctor")[0].reset();

      $('#create_doctor input[name="numero_crm"]').attr('value','');
      $('#create_doctor input[name="nome_medico"]').attr('value','');
      $('#create_doctor input[name="rua"]').attr('value','');
      $('#create_doctor input[name="numero"]').attr('value','');
      $('#create_doctor input[name="complemento"]').attr('value','');
      $('#create_doctor input[name="bairro"]').attr('value','');
      $('#create_doctor input[name="nome_cidade"]').attr('value','');
      $('#create_doctor input[name="cep"]').attr('value','');
      $('#create_doctor select[name="nome_estado"]').attr('value','');
      $('#create_doctor input[name="telefone_um"]').attr('value','');
      $('#create_doctor input[name="telefone_dois"]').attr('value','');
    });

    $('#btn_edit_doctor').click(function(){
      var id = $('input[name="medico_id"]').val();

      editingDoctor(id);
    });

    $('#form_actions_doctor').on('hidden.bs.modal', function (event) {
      if ($('#btn_group_doctor').hasClass("hidden")) {
        $('#btn_group_doctor').removeClass('hidden');

        $('#btn_group_edit_doctor').remove();
      }
    });

    @isset($sucesso)
      swal({
        position: 'top',
        title: 'Sucesso!',
        text: '{{ $sucesso }}',
        type: 'success',
        timer: 4000
      });
    @endisset

    @isset($erro)
      swal({
        position: 'top',
        title: 'Erro!',
        text: '{{ $erro }}',
        type: 'error'
      });
      $('#modal_create_doctor').modal('show');
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
      let id = $('input[name="medico_id"]').val();
      swal({
        position: 'top',
        title: 'Erro!',
        text: '{{ $erroEdit }}',
        type: 'error'
      });

      editing(id);

      $('#modal_actions_doctor').modal('show');
    @endisset

    @isset($sucessoEspecialidade)
      swal({
        position: 'top',
        title: 'Sucesso!',
        text: '{{ $sucessoEspecialidade }}',
        type: 'success',
        timer: 4000
      });
    @endisset

    @isset($erroEspecialidade)
      swal({
        position: 'top',
        title: 'Erro!',
        text: '{{ $erroEspecialidade }}',
        type: 'error'
      });
    @endisset

    function especialidadesDoctor(id) {
      $('.loading').fadeOut(700).removeClass('hidden');

      $.get('/administrador/ver-medico/' + id, function (medico) {
        $('#add_especialdiades input[name="numero_crm"]').empty();
        $('#add_especialdiades input[name="nome_medico"]').empty();

        $('#add_especialdiades input[name="numero_crm"]').attr('value', medico.numero_crm);
        $('#add_especialdiades input[name="nome_medico"]').attr('value', medico.nome_medico);
      });

      $.get('/administrador/medicos-especialidades/' + id, function (especialidades_medico) {
        $('#especialidades_cadastradas').empty();
        $.each(especialidades_medico, function (key, especialidade) {
          $('#especialidades_cadastradas').append(
          '<tr>'+
            '<td>'+especialidade.codigo_especialidade+'</td>'+
            '<td>'+especialidade.nome_especialidade+'</td>'+
            '<td><button class="btn btn-danger" type="button" id="btnExcluirEspecialidade" value="'+especialidade.id_especialidade+'" onclick="excluirEspecialidadeDeMedico(this.value)"><i class="fa fa-trash-o"></i> Excluir</button></td>'+
          '</tr>'
          );
        });
      });
      $('.loading').fadeOut(700).addClass('hidden');
    };

    $('#btn_especialidade').click(function() {
      $('#modal_actions_doctor').modal('hide');

      let id = $('#form_actions_doctor input[name="medico_id"]').val();
      $('#add_especialdiades input[name="medico_id"]').attr('value', id);

      especialidadesDoctor(id);

      $('#modal_especialidades').modal('show');
    });

    {{-- $('#btnExcluirEspecialidade').click(function() {


    }); --}}

    function excluirEspecialidadeDeMedico(id) {

      id_medico = $('#add_especialdiades input[name="medico_id"]').val();
      id_especialidade = id;

      swal({
        position: 'top',
        title: 'Desvincular Especialidade',
        text: "Você tem certeza que deseja desvincular essa especialidade desse Médico?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
      }).then(function (result) {
        if (result.value) {
          $('.loading').fadeOut(700).removeClass('hidden');

          $.post("{{ route('administrador.excluir-especialidade-medico') }}",
          {
            _token: "{{ csrf_token() }}",
             medico_id: id_medico,
             especialidade_id: id_especialidade
          },
          function(result) {
            if (result.menssage === 'error') {
              swal({
                position: 'top',
                title: 'Erro!',
                text: 'Ocorreu um erro ao desvincular especialidade do médico, tente em instantes!',
                type: 'error',
                confirmButtonText: 'Ok'
              });
              $('.loading').fadeOut(700).addClass('hidden');
            }
            if (result.menssage === 'success') {
              $('.loading').fadeOut(700).addClass('hidden');
              swal({
                position: 'top',
                title: 'Desvinculado!',
                text: 'A especialidade foi desvinculado do médico com sucesso!',
                type: 'success'
              }).then(function (result) {
                $('.loading').fadeOut(700).removeClass('hidden');
                location.reload(true)
              })
            }
          }, "json");

        }
      });

    };

@endsection
