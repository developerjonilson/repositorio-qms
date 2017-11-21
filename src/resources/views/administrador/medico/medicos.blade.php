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
        <h3 class="panel-title">Médicos (Em Construção) - Falta: Ver, Editar e Excluir</h3>
        <hr>
        <div class="erros">
          @isset($sucesso)
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-check-square-o"></i> {{ $sucesso }}
            </div>
          @endisset
          @isset($erroExcluir)
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-times-circle"></i> {{ $erroExcluir }}
            </div>
          @endisset
        </div>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cadastrar_operador">
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
              <th width="370">Ações</th>
            </tr>
          </thead>
        </table>
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

  </script>
@endsection
