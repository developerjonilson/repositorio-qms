@extends('layouts.layout-erro-acesso')

@section('content')
  <div class="content">

    <div class="row centralizado">
      <i class="fa fa-ban fa-5x" aria-hidden="true"></i>
    </div>
    <div class="row centralizado">
      {{-- Voçê não tem permissão para acessar essa página! --}}
      <h2>Voçê não tem permissão para acessar essa página!</h2>
      {{-- <label>Voçê não tem permissão para acessar essa página!</label> --}}
    </div>
    <div class="row centralizado">
      <br><br>
      <a href="{{ action('SistemaController@voltar') }}" class="btn btn-primary">Voltar</a>
    </div>


  </div>

@endsection
