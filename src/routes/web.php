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
Route::post('/operador/update-senha', 'OperadorController@updateSenha');
Route::get('/operador/update-senha', 'OperadorController@alterarSenha');




Route::get('/operador/cadastrar-paciente', 'PacienteController@cadastrarPaciente');
Route::post('/operador/create-paciente', 'PacienteController@createPaciente');

Route::get('/operador/alterar-paciente', 'PacienteController@alterarPaciente');
Route::post('/operador/paciente-para-alterar', 'PacienteController@pacienteParaAlterarPost');
Route::get('/operador/paciente-para-alterar/{numero_cns}', 'PacienteController@pacienteParaAlterarGet');
Route::post('/operador/alterando-paciente', 'PacienteController@alterandoPaciente');

Route::get('/operador/buscar-paciente', 'PacienteController@buscarPaciente');
Route::post('/operador/search-paciente', 'PacienteController@searchPaciente');




// Rotas de consultas:
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

Route::get('/operador/buscar-consulta/{numero_cns?}', 'ConsultaController@buscarConsulta');
Route::post('/operador/buscar-consulta', 'ConsultaController@buscarConsulta');
Route::get('/operador/buscar-uma-consulta/{id}', 'ConsultaController@buscarUmaConsulta');
Route::get('/operador/buscar-uma-consulta-dois/{id}', 'ConsultaController@buscarUmaConsultaDois');
Route::get('/operador/listagem-consultas', 'ConsultaController@listagemConsultas');
Route::post('/operador/filtrar-consultas', 'ConsultaController@filtrarConsultas');
Route::get('/operador/consultas/gerar-pdf/{codigo?}', 'ConsultaController@gerarPdf');



Route::get('/operador/alterar-consulta', 'ConsultaController@alterarConsulta');

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
