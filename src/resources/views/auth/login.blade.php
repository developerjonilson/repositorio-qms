@extends('layouts.layout-login')

@section('content')
  <div class="left">
    <div class="content">
      <div class="header">
        <div class="logo text-center"><img src="/img/logo-dark.png" alt="QMS Logo"></div>
        <p class="lead">Faça o login com seus dados</p>
      </div>
      <div class="erros">
        @if ($errors->has('email') || $errors->has('password'))
            <span class="help-block">
              <div class="alert alert-danger" role="alert">
                <i class="fa fa-times-circle"></i>   Email ou senha incorretos!
              </div>
            </span>
        @endif
      </div>
      <form class="form-auth-small" method="POST" action="{{ route('login') }}" id="form_login">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="control-label sr-only">Email</label>
          <input id="email" type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="control-label sr-only">Senha</label>
          <input id="password" type="password" class="form-control campo" name="password" id="password" placeholder="*************" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_login"><i id="icone_btn_login" class=""></i>LOGIN</button>
        <div class="bottom">
          <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Esqueceu sua senha?</a></span>
        </div>
      </form>
    </div>
  </div>
  <div class="right">
    <div class="overlay"></div>
    <div class="content text">
      <h1 class="heading">QMS - Sistema de Gestão de Consultas Médicas</h1>
      <p>Desenvolvido por StarTech</p>
    </div>
  </div>




@endsection
