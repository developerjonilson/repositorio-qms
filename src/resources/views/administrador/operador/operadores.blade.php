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
        <div class="container">
          <div class="row">
            conteudo
          </div>
        </div>
      </div>
    </div>

  </div>


@endsection
