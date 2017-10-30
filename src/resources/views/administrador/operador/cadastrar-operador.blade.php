@extends('layouts.layout-administrador')

@section('conteudo')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ action('AdministradorController@index') }}">Administrador</a></li>
      <li><a href="{{ action('AdministradorController@index') }}">Operadores</a></li>
      <li class="active">Cadastrar Operador</li>
    </ol>
  </div>

  <div class="row">

    <div class="panel panel-headline">
      <div class="panel-heading">
        <h3 class="panel-title">Cadastrar Operador</h3>
        <hr>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOperadorModal">
              <i class="fa fa-plus-square-o"></i> Novo Operador
            </button> --}}
            <!-- Large modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>
            {{-- <a href="{{ action('AdministradorController@cadastrarOperador') }}" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Novo Operador</a> --}}
            {{-- <button type="button" name="button" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Novo Operador</button> --}}
          </div>
        </div>
        <hr>
        <div class="container">

        </div>
      </div>
    </div>

  </div>


  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        ...
      </div>
    </div>
  </div>


@endsection

@section('pos-script')
  <script type="text/javascript">


  </script>
@endsection
