$(document).ready(function () {

  $(window).on('load', function() {
    let pathname = window.location.pathname.split('/')
    // console.log(pathname)
    if(pathname[1]==='operador') {
      $('#home').addClass('active')

      let action = pathname[2].split('-')

      if (action[0]==='update' || action[0]==='perfil') {
        $('#home').removeClass('active');
      }

      // console.log(action[0], action[1])
      if(action[1] ==='paciente' || action[1] ==='pacientes') {
        $('#home').removeClass('active')
        $('#pacientes').removeClass('collapsed');
        $('#pacientes').addClass('active');
        $('#subPaciente').addClass('in');
        if (action[0] ==='cadastrar') {
          $('#menu_cadastrar_paciente').addClass('active')
        }
        if (action[0] ==='pesquisar') {
          $('#menu_pesquisar_paciente').addClass('active')
        }
        if (action[0] ==='alterar') {
          $('#menu_alterar_paciente').removeClass('hidden')
          $('#menu_alterar_paciente').addClass('active')
        }
      } else {
        if (action[1] ==='consulta' || action[1] ==='consultas') {
          $('#home').removeClass('active')
          $('#consultas').removeClass('collapsed');
          $('#consultas').addClass('active');
          $('#subConsulta').addClass('in');
          if (action[0] ==='agendar') {
            $('#menu_agendar_consulta').removeClass('hidden');
            $('#menu_agendar_consulta').addClass('active');
          }
          if (action[0] ==='buscar') {
            $('#menu_pesquisar_consulta').addClass('active');
          }
          if (action[0] ==='listagem') {
            $('#menu_lista_consulta').addClass('active');
          }
        } else {
          if (action[1] ==='sucesso') {
            $('#home').removeClass('active')
            $('#consultas').removeClass('collapsed');
            $('#consultas').addClass('active');
            $('#subConsulta').addClass('in');
          }
        }
      }
    } else {
      if (pathname[1]==='administrador') {
        // $('#home').addClass('active')
        // $('#home').removeClass('active')
        switch (pathname[2]) {
          case 'atendentes':
            $('#home').removeClass('active')
            $('#atendentes').removeClass('collapsed')
            $('#atendentes').addClass('active')
            break;
          case 'operadores':
            $('#home').removeClass('active')
            $('#operadores').removeClass('collapsed')
            $('#operadores').addClass('active')
            break;
          case 'administradores':
            $('#home').removeClass('active')
            $('#administradores').removeClass('collapsed')
            $('#administradores').addClass('active')
            break;
          case 'medicos':
            $('#home').removeClass('active')
            $('#medicos').removeClass('collapsed')
            $('#medicos').addClass('active')
            break;
          case 'especialidades':
            $('#home').removeClass('active')
            $('#especialidades').removeClass('collapsed')
            $('#especialidades').addClass('active')
            break;
          case 'relatorio-diario':
            $('#home').removeClass('active')
            $('#relatorios').removeClass('collapsed')
            $('#relatorios').addClass('active')
            $('#subRelatios').addClass('in')
            break;
          case 'relatorio-mensais':
            $('#home').removeClass('active')
            $('#relatorios').removeClass('collapsed')
            $('#relatorios').addClass('active')
            $('#subRelatios').addClass('in');
            break;
        }
      }
    }
  })

  $('#form-change-password').submit(function() {
    $('.loading').fadeOut(700).removeClass('hidden');
  });

  $('#form_login').submit(function() {
    $('.loading').fadeOut(700).removeClass('hidden');
  });

  $('#cancel').click(function() {
    $('.loading').fadeOut(700).removeClass('hidden');
  });

  // função para buscar os valores dos selected de medicos por especialidade:
  $('#especialidade').change(function () {
    var idEspecialidade = $(this).val();

    $.get('/operador/get-medicos/' + idEspecialidade, function (medicos) {
      $('#medico').empty();
      $('#medico').append('<option value="" disabled selected>Selecione...</option>');
      $.each(medicos, function (key, medico) {
        $('#medico').append('<option value="'+medico.id_medico+'">'+medico.nome_medico+'</option>');
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
        $('#data_consulta').append('<option value="'+calendario.id_calendario+'"><time>'+data+'</time></option>');
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
        $('#periodo').append('<option value="'+periodo.id_periodo+'">'+periodo.nome+'</option>');
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
      $('#local_id').attr('value', local.id_local);
      $('#local_nome_fantasia').attr('value', local.nome_fantasia);
    });
  });

// DIV loading no carregamento da pagina:
  $('.loading').fadeOut(700).addClass('hidden');


  $('#search_type').change(function () {
    var option = $(this).val();

    if (option == 1) {
      $('.fields_filtrar').val('');

      $('#div_number_cpf').addClass('hidden');
      $('#div_date_nasc').addClass('hidden');
      $('#div_number_cns').removeClass('hidden');
    } else {
      if (option == 2) {
        $('.fields_filtrar').val('');

        $('#div_number_cns').addClass('hidden');
        $('#div_date_nasc').addClass('hidden');
        $('#div_number_cpf').removeClass('hidden');
      } else {
        $('.fields_filtrar').val('');

        $('#div_number_cns').addClass('hidden');
        $('#div_number_cpf').addClass('hidden');
        $('#div_date_nasc').removeClass('hidden');
      }
    }
  });

  $('#form_filtro-paciente').submit(function () {
    $('#numero_cns').unmask();
    $('#cpf').unmask();
  });

});
