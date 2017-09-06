<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Arquivo de rotas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/acesso-negado-operador', 'OperadorController@acessoNegadoOperador');
Route::get('/acesso-negado-administrador', 'AdministradorController@acessoNegadoAdministrador');
Route::get('/acesso-negado-atendente', 'SistemaController@acessoNegadoAtendente');

//Rotas de administrador:
Route::get('/administrador', 'AdministradorController@index');
Route::get('/administrador/cadastrar-operador', 'AdministradorController@cadastrarOperador');
Route::get('/administrador/cadastrar-medico', 'AdministradorController@cadastrarMedico');
Route::get('/administrador/alterar-medico', 'AdministradorController@alterarMedico');
Route::get('/administrador/remover-operador', 'AdministradorController@removerOperador');
Route::get('/administrador/remover-medico', 'AdministradorController@removerMedico');
Route::get('/administrador/cadastrar-horario', 'AdministradorController@cadastrarHorario');


Route::get('/administrador/perfil', 'AdministradorController@perfilUsuario');
Route::get('/administrador/alterar-senha', 'AdministradorController@alterarSenhaUsuario');
Route::get('/administrador/alterar-dados', 'AdministradorController@alterarUsuario');


//Rotas de operador
Route::get('/operador', 'OperadorController@index');

Route::get('/operador/perfil', 'OperadorController@perfil');
Route::get('/operador/alterar-dados', 'OperadorController@alterarUsuario');
Route::get('/operador/alterar-senha', 'OperadorController@alterarSenha');




Route::get('/operador/cadastrar-paciente', 'PacienteController@cadastrarPaciente');
Route::get('/operador/buscar-paciente', 'PacienteController@buscarPaciente');




// Rotas de consultas:
Route::get('/operador/buscar-consulta', 'ConsultaController@buscarConsulta');
Route::get('/operador/agendar-consulta', 'ConsultaController@agendarConsulta');
Route::get('/operador/alterar-consulta', 'ConsultaController@alterarConsulta');
Route::get('/operador/relatorio-diario', 'ConsultaController@relatorioDiario');
Route::get('/operador/relatorio-mensal', 'ConsultaController@relatorioMensal');
Route::get('/operador/relatorio-personalizado', 'ConsultaController@relatorioPersonalizado');


//Rotas do manual do sistema:
Route::get('/operador/manual', 'OperadorController@manualOperador');
Route::get('/administrador/manual', 'AdministradorController@manualAdministrador');
// Route::get('/operador/manual', [
//     'middleware' => '\qms\Http\Middleware\AutorizacaoMiddlewareOperador::class',
//     'uses' => 'SistemaController@manualOperador'
// ]);
// Route::get('/administrador/manual', [
//     'middleware' => '\qms\Http\Middleware\AutorizacaoMiddlewareAdministrador::class',
//     'uses' => 'SistemaController@manualAdministrador'
// ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
