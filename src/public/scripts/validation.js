$(document).ready(function(){

  $('#cpf').mask('000.000.000-00'),
  $('#rg').mask('000000000000000'),
  $('#numero_cns').mask("000.0000.0000.0000");
  $('#cep').mask("00000-000");
  $('#telefone_um').mask("(00) 00000-0009");
  $('#telefone_dois').mask("(00) 00000-0009");

  $("#form-create-paciente").validate({
        // Define as regras
        rules: {
            nome_paciente: {
               required: true
            },
            sexo: {
               required: true
            },
            data_nascimento: {
               required: true,
            },
            numero_cns: {
              required: true,
            },
            cpf: {
              verificarCpf: true
            },
            rg: {
               digits: true
            },
            nome_mae: {
               required: true
            },
            rua: {
               required: true
            },
            numero: {
               required: true,
               digits: true
            },
            bairro: {
               required: true
            },
            cidade: {
               required: true
            },
            cep: {
               required: true,
            },
            nome_estado: {
               required: true
            },
        },
        // Define as mensagens de erro para cada regra
        messages: {
              nome_paciente: {
                 required: "Esse campo não pode ficar vazio!",
              },
              sexo: {
                 required: "Esse campo não pode ficar vazio!",
              },
              data_nascimento: {
                 required: "Esse campo não pode ficar vazio!",
              },
              numero_cns: {
                 required: "Esse campo não pode ficar vazio!",
              },
              cpf: {
                //  digits:"Este campo é numerico!",
                 verificarCpf: "Esse CPF informado é inválido!"
              },
              rg: {
                 digits:"Este campo só podem conter numeros!"
              },
              nome_mae: {
                 required: "Esse campo não pode ficar vazio!",
              },
              rua: {
                 required: "Esse campo não pode ficar vazio!",
              },
              numero: {
                 required: "Esse campo não pode ficar vazio!",
                 digits:"Este campo só podem conter numeros!"
              },
              bairro: {
                 required: "Esse campo não pode ficar vazio!",
              },
              cidade: {
                 required: "Esse campo não pode ficar vazio!",
              },
              cep: {
                 required: "Esse campo não pode ficar vazio!",
              },
              nome_estado: {
                 required: "Esse campo não pode ficar vazio!",
              },
        },

        submitHandler: postFormCreatePaciente,
      }
    );

//function from submit form:
    function postFormCreatePaciente(form) {
        $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);

        $('#cpf').unmask();
        $('#cep').unmask();
        $("#numero_cns").unmask();
        $('#telefone_um').unmask();
        $('#telefone_dois').unmask();

        $.post('/operador/create-paciente', $(form).serialize(), function (resposta) {
          $('#status').empty();
          if (resposta === 1) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Por favor preencha todos os campos corretamente!\
              </div>'
            );
          }
          if (resposta === 2) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de CNS já foi registrado no sistema!\
              </div>'
            );
          }
          if (resposta === 3) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Data de Nascimento do paciente Inválida!\
              </div>'
            );
          }
          if (resposta === 4) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Erro insperado, tente mais tarde!\
              </div>'
            );
          }
          if (resposta === 5) {
            $('#status').append(
              '<div class="alert alert-success alert-dismissible" role="alert" id="status_5">\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                <i class="fa fa-check-circle"></i> Paciente cadastrado com sucesso!\
              </div>'
            );
            $('#form-create-paciente')[0].reset();
          }
          if (resposta === 6) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> O número do Cartão Nacional da Saúde (CNS) deve ter 15 digitos!\
              </div>'
            );
          }
          if (resposta === 7) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de <b>CPF</b> já foi registrado no sistema!\
              </div>'
            );
          }
          if (resposta === 8) {
            $('#status').append(
              '<div class="alert alert-danger alert-dismissible" role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
              <i class="fa fa-times-circle"></i> Não é possível realizar o cadastrado, pois esse número de <b>RG</b> já foi registrado no sistema!\
              </div>'
            );
          }

          $('#cpf').mask('000.000.000-00'),
          $('#rg').mask('000000000000000'),
          $('#numero_cns').mask("000.0000.0000.0000");
          $('#cep').mask("00000-000");
          $('#telefone_um').mask("(00) 00000-0009");
          $('#telefone_dois').mask("(00) 00000-0009");

          $('html,body').scrollTop(0);
          $('.loading').delay(5000).fadeOut(700).addClass('hidden');

        });
        return false;

    };

    $("#form-alteracao-paciente").validate({
            // Define as regras
            rules: {
                nome_paciente: {
                   required: true
                },
              sexo: {
                 required: true
              },
                data_nascimento: {
                   required: true,
                },
                numero_cns: {
                  required: true,
                },
              cpf: {
                verificarCpf: true
              },
              rg: {
                 digits: true
              },
              nome_mae: {
                   required: true
                },
              rua: {
                   required: true
                },
              numero: {
                   required: true,
                 digits: true
                },
              bairro: {
                   required: true
                },
              cidade: {
                   required: true
                },
              cep: {
                   required: true,
                },
              nome_estado: {
                   required: true
                },
            },
            // Define as mensagens de erro para cada regra
            messages: {
                nome_paciente: {
                   required: "Esse campo não pode ficar vazio!",
                },
                sexo: {
                   required: "Esse campo não pode ficar vazio!",
                },
                data_nascimento: {
                   required: "Esse campo não pode ficar vazio!",
                },
                numero_cns: {
                   required: "Esse campo não pode ficar vazio!",
                },
                cpf: {
                  //  digits:"Este campo é numerico!",
                   verificarCpf: "Esse CPF informado é inválido!"
                },
                rg: {
                   digits:"Este campo só podem conter numeros!"
                },
                nome_mae: {
                   required: "Esse campo não pode ficar vazio!",
                },
                rua: {
                   required: "Esse campo não pode ficar vazio!",
                },
                numero: {
                   required: "Esse campo não pode ficar vazio!",
                   digits:"Este campo só podem conter numeros!"
                },
                bairro: {
                   required: "Esse campo não pode ficar vazio!",
                },
                cidade: {
                   required: "Esse campo não pode ficar vazio!",
                },
                cep: {
                   required: "Esse campo não pode ficar vazio!",
                },
                nome_estado: {
                   required: "Esse campo não pode ficar vazio!",
                },
            },
            submitHandler: function (form) {
              $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
              $('#cpf').unmask();
              $('#cep').unmask();
              $("#numero_cns").unmask();
              $('#telefone_um').unmask();
              $('#telefone_dois').unmask();
              form.submit();
            },
        }
      );

    $('#search-paciente').validate({
      rules: {
        numero_cns: {
          required: true,
          verificarCns: true
        }
      },
      messages: {
        numero_cns: {
          required: "Você tem que preencher corretamente este campo antes!",
          verificarCns: "Esse número de CNS informado é inválido!"
        }
      },
      errorContainer: $('#errorContainer'),
      errorLabelContainer: $('#errorContainer'),
      submitHandler: function (form) {
        // $('#search-paciente').trigger('submit');
        $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
        $("#numero_cns").unmask();
        form.submit();
      },
    });

    $('#form-para-agendar-consulta').submit(function () {
      $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
    });

    $('#form-para-alterar-paciente').submit(function () {
      $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
    });

    $('#btn-salvar-alteracao').click(function(){
      $('#cpf').unmask();
      $('#telefone-um').unmask();
      $('#telefone-dois').unmask();
      $('#cep').unmask();
      $("#numero_cns").unmask();
    });



    $("#form-agendar-consulta").validate({
          // Define as regras
          rules: {
              especialidade: {
                  // campo especialidade será obrigatório (required)
                  required: true
              },
              medico: {
                  // campo medico será obrigatório (required)
                  required: true
              },
              data_consulta: {
                  // campo data_consulta será obrigatório (required)
                  required: true
              },
              periodo: {
                  // campo periodo será obrigatório (required)
                  required: true
              },
          },
          // Define as mensagens de erro para cada regra
          messages: {
              especialidade: {
                  required: "Você tem que selecionar uma especialidade antes!"
              },
              medico: {
                  required: "Você tem que selecionar um medico antes!"
              },
              data_consulta: {
                  required: "Você tem que selecionar uma data antes!"
              },
              periodo: {
                  required: "Você tem que selecionar um periodo antes!"
              },
          },
          submitHandler: function (form) {
            // $('#search-paciente').trigger('submit');
            $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
            form.submit();
          },
      });

  });



//    --------------------   metodo para validar CPF      --------------------
jQuery.validator.addMethod("verificarCpf", function(value, element) {
   value = jQuery.trim(value);

	value = value.replace('.','');
	value = value.replace('.','');
	cpf = value.replace('-','');
	while(cpf.length < 11) cpf = "0"+ cpf;
	var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
	var a = [];
	var b = new Number;
	var c = 11;
	for (i=0; i<11; i++){
		a[i] = cpf.charAt(i);
		if (i < 9) b += (a[i] * --c);
	}
	if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
	b = 0;
	c = 11;
	for (y=0; y<10; y++) b += (a[y] * c--);
	if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

	var retorno = true;
	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

	return this.optional(element) || retorno;

}, "Informe um CPF válido");



//    --------------------   metodo para validar número CNS      --------------------
jQuery.validator.addMethod("verificarCns", function(value, element) {
  value = jQuery.trim(value);

	value = value.replace('.','');
	value = value.replace('.','');
  cns = value.replace('.','');

  var retorno = false;

  if (cns.length === 15) {
    retorno = true;
    return retorno;
  } else {
    retorno = false;
    return retorno;
  }

}, "Informe um número de CNS válido");
