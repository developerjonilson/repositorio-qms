$(document).ready(function () {

  $(window).on('load', function() {
    var pathname = window.location.pathname;

    if (pathname == '/operador' || pathname == '/operador/') {
      $('#home').addClass('active');
    } else {
      if (pathname == '/operador/cadastrar-paciente' || pathname == '/operador/cadastrar-paciente/' ||
          pathname == '/operador/buscar-paciente' || pathname == '/operador/buscar-paciente/') {
        $('#pacientes').removeClass('collapsed');
        $('#pacientes').addClass('active');
        $('#subPaciente').addClass('in');
        if (pathname == '/operador/cadastrar-paciente' || pathname == '/operador/cadastrar-paciente/') {
          $('#menu_cadastrar_paciente').addClass('active');
        } else {
          $('#menu_pesquisar_paciente').addClass('active');
        } //fim do 'if' para verificar se o pathname é cadastrar ou persquisar paciente

      } else {
        // começo do 'if' para verificar se é agendar ou pesquisar uma consulta
        if (pathname == '/operador/agendar-consulta' || pathname == '/operador/agendar-consulta/' ||
        pathname == '/operador/buscar-consulta' || pathname == '/operador/buscar-consulta/') {
          $('#consultas').removeClass('collapsed');
          $('#consultas').addClass('active');
          $('#subConsulta').addClass('in');
          if (pathname == '/operador/agendar-consulta' || pathname == '/operador/agendar-consulta/') {
            $('#menu_agendar_consulta').addClass('active');
          } else {
            $('#menu_pesquisar_consulta').addClass('active');
          } //fim do 'if' para verificar se o pathname é agendar ou pesquisar consulta

        } else {
          if (pathname == '/operador/relatorio-diario' || pathname == '/operador/relatorio-diario/' ||
          pathname == '/operador/relatorio-mensal' || pathname == '/operador/relatorio-mensal/' ||
          pathname == '/operador/relatorio-personalizado' || pathname == '/operador/relatorio-personalizado/') {
            $('#relatorios').removeClass('collapsed');
            $('#relatorios').addClass('active');
            $('#subRelatorio').addClass('in');
            if (pathname == '/operador/relatorio-diario' || pathname == '/operador/relatorio-diario/') {
              $('#menu_relatorio_diario').addClass('active');
            } else {
              if (pathname == '/operador/relatorio-mensal' || pathname == '/operador/relatorio-mensal/') {
                $('#menu_relatorio_mensal').addClass('active');
              } else {
                $('#menu_relatorio_personalizado').addClass('active');
              }
            }
          } //fim do 'if' que verifica se é relatio diario, mensal ou personalizado

        }
      }
    }// fim no primeiro 'if' para saber se esta na pagina inicial de operador

  });

  $('#form-change-password').submit(function() {
    $('#icone-btn').removeClass('fa-check-circle');
    $('#icone-btn').addClass('fa-spinner fa-spin');
    $('#enviar').addClass('disabled');
  });

  $('#form_login').submit(function() {
    $('#icone_btn_login').addClass('fa fa-spinner fa-spin');
    $('#btn_login').addClass('disabled');
  });

  $('#form-create-paciente').submit(function() {
    $('#icone-btn-cadastro-paciente').removeClass('fa-check-circle');
    $('#icone-btn-cadastro-paciente').addClass('fa fa-spinner fa-spin');
    $('#btn-cadastrar-paciente').addClass('disabled');
  });
});
