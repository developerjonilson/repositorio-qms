<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Arquivo de rotas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Redirect::route('login');
});


//   -------------------    Rotas de administrador    -------------------------------------------------
Route::get('/administrador', 'AdministradorController@index');
Route::get('/administrador/acesso-negado-administrador', 'AdministradorController@acessoNegadoAdministrador');

Route::get('/administrador/alterar-senha', 'AdministradorController@alterarSenha');
Route::post('/administrador/update-password', 'AdministradorController@updatePassword');

Route::get('/administrador/perfil', 'AdministradorController@perfilUsuario');
Route::post('/administrador/alterar-perfil', 'AdministradorController@alterProfile');

Route::get('/administrador/operadores', 'AdministradorController@operadores');
Route::get('/administrador/get-operadores', 'AdministradorController@getOperador')->name('administrador.get-operadores');
Route::get('/administrador/ver-operador/{id}', 'AdministradorController@verOperador')->name('administrador.ver-operador');
Route::post('/administrador/cadastrar-operador', 'AdministradorController@cadastrarOperador')->name('administrador.cadastrar-operador');
Route::post('/administrador/editar-operador', 'AdministradorController@editarOperador')->name('administrador.editar-operador');

Route::get('/administrador/cadastrar-medico', 'AdministradorController@cadastrarMedico');
Route::get('/administrador/alterar-medico', 'AdministradorController@alterarMedico');
Route::get('/administrador/remover-operador', 'AdministradorController@removerOperador');
Route::get('/administrador/remover-medico', 'AdministradorController@removerMedico');
Route::get('/administrador/cadastrar-horario', 'AdministradorController@cadastrarHorario');





//   -------------------    Rotas de operador    -----------------------------------------------------
Route::get('/operador', 'OperadorController@index');
Route::get('/operador/acesso-negado-operador', 'OperadorController@acessoNegadoOperador');

Route::get('/operador/perfil', 'OperadorController@perfil');
Route::post('/operador/alterar-perfil', 'OperadorController@alterProfile');
Route::get('/operador/alterar-dados', 'OperadorController@alterarUsuario');
Route::get('/operador/alterar-senha', 'OperadorController@alterarSenha');
Route::post('/operador/update-senha', 'OperadorController@updateSenha');
Route::get('/operador/update-senha', 'OperadorController@alterarSenha');

Route::get('/operador/cadastrar-paciente', 'PacienteController@cadastrarPaciente');
Route::post('/operador/create-paciente', 'PacienteController@createPaciente');
Route::get('/operador/pesquisar-pacientes', 'PacienteController@pesquisarPacientes');
Route::get('/operador/filtrar-pacientes', 'PacienteController@filtrarPacientes');

Route::get('/operador/alterar-paciente', 'PacienteController@alterarPaciente');
Route::post('/operador/paciente-para-alterar', 'PacienteController@pacienteParaAlterarPost');
Route::get('/operador/paciente-para-alterar/{numero_cns}', 'PacienteController@pacienteParaAlterarGet');
Route::post('/operador/alterando-paciente', 'PacienteController@alterandoPaciente');
Route::get('/operador/ver-paciente/{id}', 'PacienteController@verPaciente');

Route::get('/operador/agendar-consulta/{idPaciente?}', 'ConsultaController@agendarConsulta');
Route::post('/operador/paciente-agendar-consulta', 'ConsultaController@pacienteParaAgendarConsulta');
Route::post('/operador/medicos-por-especialidade', 'ConsultaController@medicosPorEspecialidade');
Route::get('/operador/get-medicos/{idEspecialidade}', 'ConsultaController@getMedicos');
Route::get('/operador/especialidade/{idEspecialidade}/medico/{idMedico}', 'ConsultaController@getDataAtendimento');
Route::get('/operador/periodos/{idCaleandario}', 'ConsultaController@getPeriodos');
Route::get('/operador/vagas-disponiveis/{idPeriodo}', 'ConsultaController@getVagas');
Route::get('/operador/local/{idPeriodo}', 'ConsultaController@getLocal');
Route::post('/operador/agendando-consulta/', 'ConsultaController@agendandoConsulta');
Route::get('/operador/agendamento-sucesso/{id?}', 'ConsultaController@sucessoAgendamentoConsulta');

Route::get('/operador/ver-consulta/{id}', 'ConsultaController@verConsulta');
Route::get('/operador/listagem-consultas', 'ConsultaController@listagemConsultas');
Route::get('/operador/filtrar-consultas', 'ConsultaController@filtrarConsultas');
Route::get('/operador/consultas/gerar-pdf/{codigo?}', 'ConsultaController@gerarPdf');
Route::post('/operador/cancelar-agendamento-consulta', 'ConsultaController@cancelarAgendamentoConsulta');

Route::get('/operador/alterar-consulta', 'ConsultaController@alterarConsulta');





//   -------------------    Rotas de atendente    -------------------------------------------------
Route::get('/atendente', 'AtendenteController@index');
Route::get('/atendente/acesso-negado-atendente', 'AtendenteController@acessoNegadoAtendente');

Route::get('/atendente/alterar-senha', 'AtendenteController@alterarSenha');
Route::post('/atendente/update-password', 'AtendenteController@updatePassword');

Route::get('/atendente/perfil', 'AtendenteController@perfilUsuario');
Route::post('/atendente/alterar-dados', 'AtendenteController@alterProfile');



//   -------------------    Rotas do manual do sistema    -------------------------------------------------
Route::get('/operador/manual', 'OperadorController@manualOperador');
Route::get('/administrador/manual', 'AdministradorController@manualAdministrador');
Route::get('/atendente/manual', 'AtendenteController@manualAtendente');
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
