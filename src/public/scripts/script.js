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
          if (pathname == '/operador/listagem-consultas' || pathname == '/operador/listagem-consultas/') {
            $('#menu_listagem').addClass('active');
          }
        }
      }
    }// fim no primeiro 'if' para saber se esta na pagina inicial de operador

  });

  $('#form-change-password').submit(function() {
    $('#icone-btn').removeClass('fa-check-circle');
    $('#icone-btn').addClass('fa-spinner fa-spin');
    $('#enviar').attr('disabled', 'disabled');
  });

  $('#form_login').submit(function() {
    $('#icone_btn_login').addClass('fa fa-spinner fa-spin');
    $('#btn_login').attr('disabled', 'disabled');
  });

  // $('#form-create-paciente').submit(function() {
    // $('#icone-btn-cadastro-paciente').removeClass('fa-check-circle');
    // $('#icone-btn-cadastro-paciente').addClass('fa fa-spinner fa-spin');
    // $('#btn-cadastrar-paciente').attr('disabled', 'disabled');
  // });

  // $('#search-paciente').submit(function() {
  //   $('#icone-btn-search-paciente').removeClass('fa-search');
  //   $('#icone-btn-search-paciente').addClass('fa fa-spinner fa-spin');
  //   $('#btn-search-paciente').attr('disabled', 'disabled');
  // });

  // $('#form-para-alterar-paciente').submit(function () {
  //   $('#icone-btn-alterar').removeClass('fa-pencil-square-o');
  //   $('#icone-btn-alterar').addClass('fa fa-spinner fa-spin');
  //   $('#btn-agendar').attr('disabled', 'disabled');
  //   $('#btn-search-paciente').attr('disabled', 'disabled');
  //   $('#btn-aterar').attr('disabled', 'disabled');
  // });

  // $('#form-para-agendar-consulta').submit(function () {
  //   $('#icone-btn-agendar').removeClass('fa-calendar');
  //   $('#icone-btn-agendar').addClass('fa fa-spinner fa-spin');
  //   $('#btn-agendar').attr('disabled', 'disabled');
  //   $('#btn-search-paciente').attr('disabled', 'disabled');
  //   $('#btn-aterar').attr('disabled', 'disabled');
  // });

  // função para buscar os valores dos selected de medicos por especialidade:
  $('#especialidade').change(function () {
    var idEspecialidade = $(this).val();

    $.get('/operador/get-medicos/' + idEspecialidade, function (medicos) {
      $('#medico').empty();
      $('#medico').append('<option value="" disabled selected>Selecione...</option>');
      $.each(medicos, function (key, medico) {
        $('#medico').append('<option value="'+medico.id+'">'+medico.nome_medico+'</option>');
      });
      $('#medico').prop("disabled", false);
    });
  });

  //função para buscar os valores dos selected de data por medicos e especialidade:
  $('#medico').change(function () {
    var idEspecialidade = $('#especialidade').val();
    var idMedico = $(this).val();

    $.get('/operador/especialidade/'+idEspecialidade+'/medico/'+idMedico, function (calendarios) {
      $('#periodo').empty();
      $('#vagas').attr('value', '');
      $('#local_id').attr('value', '');
      $('#local_nome_fantasia').attr('value', '');
      $('#data_consulta').empty();
      $('#data_consulta').append('<option value="" disabled selected>Selecione...</option>');

      $.each(calendarios, function (key, calendario) {
        //$('#data_consulta').append('<option value="'+calendario.id+'"> <?php date("d/m/Y", strtotime('+calendario.data+')) ?> </option>');
        var data = moment(calendario.data).format('DD/MM/YYYY');
        $('#data_consulta').append('<option value="'+calendario.id+'"><time>'+data+'</time></option>');
      });
      $('#data_consulta').prop("disabled", false);
    });
  });

  $('#data_consulta').change(function () {
    var idCaleandario = $(this).val();

    $.get('/operador/periodos/'+idCaleandario, function (periodos) {
      $('#periodo').empty();
      $('#vagas').attr('value', '');
      $('#local_id').attr('value', '');
      $('#local_nome_fantasia').attr('value', '');
      $('#periodo').append('<option value="" disabled selected>Selecione...</option>');
      $.each(periodos, function (key, periodo) {
        $('#periodo').append('<option value="'+periodo.id+'">'+periodo.nome+'</option>');
      });
      $('#periodo').prop("disabled", false);
    });
  });


  $('#periodo').change(function () {
    var idPeriodo = $(this).val();
    $.get('/operador/vagas-disponiveis/'+idPeriodo, function (vagas) {
      $('#vagas').attr('value', vagas.vagas_disponiveis);
    });

    $.get('/operador/local/'+idPeriodo, function (local) {
      $('#local_id').attr('value', local.id);
      $('#local_nome_fantasia').attr('value', local.nome_fantasia);
    });
  });

// DIV loading no carregamento da pagina:
  $('.loading').fadeOut(700).addClass('hidden');

  $( "#btn-test").click(function() {
    $('.loading').fadeIn(700).removeClass('hidden');
  });

});
