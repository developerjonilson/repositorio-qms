@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li class="active">Operadores</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Operadores</h3>
        <hr>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_general_operator">
              <i class="fa fa-plus-square-o"></i> Adicionar Operador
            </button>
          </div>
        </div>
        <hr>
        <table id="operadores-table" class="table table-striped table-bordered table-responsive table-hover table-condensed data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Email</th>
              <th width="150">Ações</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>

  <form class="" action="" method="post" id="form_operator">
    {{ csrf_field() }}
    {{--           --------- Modal operator -----------                --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalGeneralOperator" id="modal_general_operator" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalGeneralOperatorTitle">Detalhes do Operador</h4>
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
                  <label for="name">Nome</label>
                  <input type="text" class="form-control campo" name="name" value="{{ old('name') }}" placeholder="JOSE DA SILVA FILHO">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento</label>
                  <div class="input-group date" data-toggle="datepicker">
                    <input type="text" class="form-control" name="data_nascimento">
                    <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </div>
                  </div>
                  {{-- <input type="text" class="form-control campo" data-toggle="datepicker" name="data_nascimento" value="{{ old('data_nascimento') }}"> --}}
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
                  <input type="tel" maxlength="15" class="form-control" name="telefone_um" placeholder="(88) 99900-1234" value="{{ old('telefone_um') }}">
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
          <div class="modal-footer" id="btn_actions_modal_operador">
            <button type="button" class="btn btn-warning" id="btn_edit_operator" value=""><i class="fa fa-pencil-square-o"></i>  Editar</button>
            <button type="button" class="btn btn-danger" id="btn_delete_operator" value=""><i class="fa fa-trash-o"></i>  Excluir</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Fechar</button>
          </div>
        </div>
        </div>
      </div>

  </form>

@endsection

@section('pos-script')
  <script type="text/javascript">

  // $('[data-toggle="datepicker"]').datepicker({
  //   language: 'pt-BR',
  // });
  $('div[data-toggle="datepicker"]').datepicker({
    language: 'pt-BR',
    autoclose: true,
    format: 'dd/mm/yyyy'
  });


  @isset($erro)
    swal({
      position: 'top',
      title: 'Erro!',
      text: '{{ $erro }}',
      type: 'error'
    });
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
    swal({
      position: 'top',
      title: 'Erro!',
      text: '{{ $erroEdit }}',
      type: 'error'
    });
  @endisset

  $('#cpf').blur(function () {
    var valor = $(this).val();

    if (valor != "") {
      var status = verificaoCpf(valor);

      function verificaoCpf(value) {
        value = jQuery.trim(value);

       value = value.replace('.','');
       value = value.replace('.','');
       cpf = value.replace('-','');
       while(cpf.length < 11) cpf = "0"+ cpf;
       var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
       var a = [];
       var b = new Number;
       var c = 11;
       for (i=0; i<11; i++){
         a[i] = cpf.charAt(i);
         if (i < 9) b += (a[i] * --c);
       }
       if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
       b = 0;
       c = 11;
       for (y=0; y<10; y++) b += (a[y] * c--);
       if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

       var retorno = true;
       if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

       return retorno;
      }

      if (status == false) {
        swal({
          title: 'Erro no Campo CPF!',
          text: 'O CPF informado é invalido, tente novamente!',
          type: 'error',
          confirmButtonText: 'Ok. Já entendi...'
        });
      }
    }

  });

  @isset($erro)
    $('#modal_cadastrar_operador').modal('show');
  @endisset

  @isset($erroEdit)
    $('#modal_editar_operador').modal('show');
  @endisset

  $('#new_operador').submit(function() {
    $('.loading').fadeIn('fast').removeClass('hidden');
  });

  $('#edit_operador').submit(function() {
    $('.loading').fadeIn('fast').removeClass('hidden');
  });

  $(function() {
        $('#operadores-table').DataTable({
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
            ajax: '{{ route('administrador.get-operadores') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],

        });
    });

    function verOperador(id) {
      $('.loading').fadeOut(700).removeClass('hidden');

      $.get('/administrador/ver-operador/' + id, function (operador) {

        $('#ver_nome').attr('value', operador.name);
        $('#ver_data_nascimento').attr('value', operador.data_nascimento);
        $('#ver_cpf').attr('value', operador.cpf);
        $('#ver_rg').attr('value', operador.rg);
        $('#ver_email').attr('value', operador.email);
        $('#ver_rua').attr('value', operador.rua);
        $('#ver_numero').attr('value', operador.numero);
        $('#ver_complemento').attr('value', operador.complemento);
        $('#var_bairro').attr('value', operador.bairro);
        $('#ver_cidade').attr('value', operador.nome_cidade);
        $('#ver_cep').attr('value', operador.cep);
        $('#ver_estado').attr('value', operador.nome_estado);
        $('#ver_telefone_um').attr('value', operador.telefone_um);
        $('#ver_telefone_dois').attr('value', operador.telefone_dois);

        $('#btn_delete_operador').attr('value', operador.id);

        $('.cpf input, .maskcpf').mask('000.000.000-00');
        $('.cep input, .maskcep').mask('00000-000');
        $(".telefone input, .masktel").mask("(99) 99999-9999");

      });

      $('.loading').fadeOut(700).addClass('hidden');
    };

    function operadorParaEditar(id) {
      $('.loading').fadeOut(700).removeClass('hidden');
      $.get('/administrador/ver-operador/' + id, function (operador) {
        $('#edit_operador_id').attr('value', operador.id);
        $('#edit_name').attr('value', operador.name);
        $('#edit_data_nascimento').attr('value', operador.data_nascimento);
        $(' #edit_cpf').attr('value', operador.cpf);
        $('#edit_rg').attr('value', operador.rg);
        $('#edit_email').attr('value', operador.email);
        $('#edit_rua').attr('value', operador.rua);
        $('#edit_numero').attr('value', operador.numero);
        $('#edit_complemento').attr('value', operador.complemento);
        $('#edit_bairro').attr('value', operador.bairro);
        $('#edit_nome_cidade').attr('value', operador.nome_cidade);
        $('#edit_cep').attr('value', operador.cep);
        $('#edit_nome_estado').attr('value', operador.nome_estado);
        $('#edit_telefone_um').attr('value', operador.telefone_um);
        $('#edit_telefone_dois').attr('value', operador.telefone_dois);

        $('.edit_cpf input, .maskcpf').mask('000.000.000-00');
        $('.edit_cep input, .maskcep').mask('00000-000');
        $(".edit_telefone input, .masktel").mask("(99) 99999-9999");
      });
      $('.loading').fadeOut(700).addClass('hidden');
    };

    function operadorParaExcluir(id) {
      $('.loading').fadeOut(700).removeClass('hidden');
      $.get('/administrador/ver-operador/' + id, function (operador) {
        $('#operador_id').empty();
        $('#nome_operador').empty();
        $("#operador_id").attr('value', operador.id);
        $("#nome_operador").append( "<b>"+operador.name+"</b>");
      });
      $('.loading').fadeOut(700).addClass('hidden');
    };

    $('#btn_cancel_new').click(function () {
        $("#new_operador")[0].reset();

        $('#new_operador #name').attr('value','');
        $('#new_operador #data_nascimento').attr('value','');
        $('#new_operador #cpf').attr('value','');
        $('#new_operador #rg').attr('value','');
        $('#new_operador #email').attr('value','');
        $('#new_operador #rua').attr('value','');
        $('#new_operador #numero').attr('value','');
        $('#new_operador #complemento').attr('value','');
        $('#new_operador #bairro').attr('value','');
        $('#new_operador #cidade').attr('value','');
        $('#new_operador #cep').attr('value','');
        $('#new_operador #telefone_um').attr('value','');
        $('#new_operador #telefone_dois').attr('value','');

    });

    $('#btn_cancel_edit').click(function () {
      // $('#edit_operador')[0].reset();
      $('#edit_operador').trigger("reset");
    });

    $('#btn_delete_operador').click(function () {
      let operador_id = $(this).val();

      swal({
        position: 'top',
        title: 'Excluir Operador',
        text: "Você tem certeza que deseja excluir esse Operador?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
      }).then(function (result) {
        if (result.value) {
          $('.loading').fadeOut(700).removeClass('hidden');

          $.post("{{ route('administrador.excluir-operador') }}",
          {
            _token: "{{ csrf_token() }}",
             id: operador_id
          },
          function(result) {
            if (result.menssage === 'error') {
              $('.loading').fadeOut(700).addClass('hidden');
              swal({
                position: 'top',
                title: 'Erro!',
                text: 'Ocorreu um erro ao excluir o operador, tente em instantes!',
                type: 'error',
                confirmButtonText: 'Ok'
              });
            }
            if (result.menssage === 'success') {
              $('.loading').fadeOut(700).addClass('hidden');
              swal({
                position: 'top',
                title: 'Excluído!',
                text: 'O operador foi excluída com sucesso!',
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

  </script>
@endsection
