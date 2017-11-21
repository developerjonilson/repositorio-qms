@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li class="active">Especialidades</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Especialidades (Em Construção) - Falta: Ver, Editar e Excluir</h3>
        <hr>
        <div class="erros">
          @isset($sucesso)
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-check-square-o"></i> {{ $sucesso }}
            </div>
          @endisset
        </div>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cadastrar_especialidade">
              <i class="fa fa-plus-square-o"></i> Adicionar Especialidade
            </button>
          </div>
        </div>
        <hr>
        <table id="especialidades_table" class="table table-striped table-bordered table-responsive table-hover table-condensed data-table">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th width="80">Ações</th>
            </tr>
          </thead>
        </table>
      </div>

      <form class="" action="{{ route('administrador.especialidade.cadastrar') }}" method="post" id="new_especialidade" name="new_especialidade">
        {{ csrf_field() }}
        {{--           --------- Modal para cadastrar especialidade -----------                --}}
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_cadastrar_especialidade" data-backdrop="static">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalhes da Especialidade</h4>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nome_especialidade">Nome da Especialidade</label>
                      <input type="text" class="form-control" id="nome_especialidade" name="nome_especialidade" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ver_descricao_especialidade">Breve Descrição Sobre a Especialidade</label>
                      <textarea class="form-control" rows="4" id="descricao_especialidade" name="descricao_especialidade" required></textarea>
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="enviar"><i class="fa fa-check-circle"></i>  Cadastrar</button>
                <button type="button" class="btn btn-danger btn_cancelar_especialidade" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Cancelar</button>
              </div>

        		</div>
            </div>
          </div>
      </form>

      {{--           --------- Modal para ver especialidade -----------                --}}
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_ver_especialidade" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Detalhes da Especialidade</h4>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ver_nome_especialidade">Nome da Especialidade</label>
                    <input type="text" class="form-control" id="ver_nome_especialidade" disabled>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ver_descricao_especialidade">Breve Descrição Sobre a Especialidade</label>
                    <textarea class="form-control" rows="4" id="ver_descricao_especialidade" name="ver_descricao_especialidade" disabled></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="btn_delete_especialidade" value=""><i class="fa fa-trash-o"></i>  Excluir</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Fechar</button>
            </div>

      		</div>
          </div>
        </div>


    </div>

  </div>

@endsection

@section('pos-script')
  <script type="text/javascript">

  @isset($erro)
    $('#modal_cadastrar_medico').modal('show');
  @endisset

  @isset($erroEdit)
    $('#modal_editar_medico').modal('show');
  @endisset

  $('enviar').click(function() {
    $('.loading').fadeIn('fast').removeClass('hidden');
  });

  $(function() {
        $('#especialidades_table').DataTable({
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
            ajax: '{{ route('administrador.get-especialidades') }}',
            columns: [
                { data: 'id_especialidade', name: 'id_especialidade' },
                { data: 'nome_especialidade', name: 'nome_especialidade' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],

        });
    });

    function verEspecialidade(id) {
      $('.loading').fadeOut(700).removeClass('hidden')

      $.get('/administrador/ver-especialidade/' + id, function (especialidade) {
        $('#btn_delete_especialidade').attr('value', especialidade.id_especialidade);
        $('#ver_nome_especialidade').attr('value', especialidade.nome_especialidade);
        $('#ver_descricao_especialidade').append(especialidade.nome_especialidade);
      });

      $('.loading').fadeOut(700).addClass('hidden')
    }

    $('#btn_delete_especialidade').click(function () {
      let id_periodo = $(this).val();

      swal({
        title: 'Excluir Especialidade?',
        text: "Você tem certeza que deseja excluir essa Especialidade, sendo assim, não será possivel agendar atendimentos para os médicos que são dessa especialidade.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
      }).then(function (result) {
        if (result.value) {
          $('.loading').fadeOut(700).removeClass('hidden');

          $.post("{{ route('administrador.especialidade.excluir') }}",
          {
            _token: "{{ csrf_token() }}",
             id: id_periodo
          },
          function(result) {
            if (result.menssage === 'error') {
              $('.loading').fadeOut(700).addClass('hidden');
              swal({
                title: 'Erro!',
                text: 'Ocorreu um erro ao excluir a especialidade, tente em instantes!',
                type: 'error',
                confirmButtonText: 'Ok'
              });
            }
            if (result.menssage === 'success') {
              $('.loading').fadeOut(700).addClass('hidden');
              swal(
                'Excluído!',
                'A especialidade foi excluída com sucesso!',
                'success'
              ).then(function (result) {
                $('.loading').fadeOut(700).removeClass('hidden');
                location.reload(true)
              })
            }
          }, "json");

        }
      })

    });

    $('.btn_cancelar_especialidade').click(function() {
      $('#new_especialidade')[0].reset();
    });

  </script>
@endsection
