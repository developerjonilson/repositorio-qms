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

    function postFormCreatePaciente(form) {
        $('.loading').fadeIn('fast').removeClass('hidden');

        $('#cpf').unmask();
        $('#cep').unmask();
        $("#numero_cns").unmask();
        $('#telefone_um').unmask();
        $('#telefone_dois').unmask();

        form.submit();

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
            $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
            form.submit();
          },
      });

  $("#form-filtro").validate({
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
          $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
          form.submit();
        },
    });

  $('#btn-edit-profile').click(function () {
    $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
    $(this).addClass('hidden');
    $('#riquired-fields').removeClass('hidden');
    $('.riquired-fields').removeClass('hidden');

    $('#telefone_um').prop("disabled", false);
    $('#telefone_dois').prop("disabled", false);
    $('#rua').prop("disabled", false);
    $('#numero').prop("disabled", false);
    $('#bairro').prop("disabled", false);
    $('#complemento').prop("disabled", false);
    $('#cidade').prop("disabled", false);
    $('#estado').prop("disabled", false);

    $('#buttons-edit').removeClass('hidden');
    $('.loading').delay(5000).fadeOut(700).addClass('hidden');
  });

  $('#edit-profile').validate({
        rules: {
            telefone_um: {
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
            estado: {
                required: true
            },
        },
        // Define as mensagens de erro para cada regra
        messages: {
            telefone_um: {
                required: "Este campo é obrigatório!"
            },
            rua: {
                required: "Este campo é obrigatório!"
            },
            numero: {
                required: "Este campo é obrigatório!",
                digits:"Este campo só podem conter numeros!"
            },
            bairro: {
                required: "Este campo é obrigatório!"
            },
            cidade: {
                required: "Este campo é obrigatório!"
            },
            estado: {
                required: "Este campo é obrigatório!"
            },
        },
        submitHandler: function (form) {
          $('.loading').fadeIn('fast').removeClass('hidden').delay(10000);
          $('#telefone_um').unmask();
          $('#telefone_dois').unmask();
          form.submit();
        },
    });

$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$("#form_create_operator").validate({
        // Define as regras
        rules: {
            name: {
              required: true,
              lettersonlys: true
            },
            data_nascimento: {
              required: true
            },
            cpf: {
              required: true,
              verificarCpf: true
            },
            rg: {
              required: true,
              digits: true
            },
            email: {
               required: true,
               email: true
            },
            rua: {
               required: true
            },
            numero: {
              required: true,
              number: true
            },
            bairro: {
              required: true
            },
            nome_cidade: {
              required: true
            },
            cep: {
              required: true,
            },
            nome_estado: {
              required: true
            },
            telefone_um: {
              required: true
            },
        },
        // Define as mensagens de erro para cada regra
        messages: {
              name: {
                required: "Campo Obrigatório!",
              },
              data_nascimento: {
                required: "Campo Obrigatório!",
              },
              cpf: {
                required: "Campo Obrigatório!",
                verificarCpf: "CPF inválido!"
              },
              rg: {
                required: "Campo Obrigatório!",
                digits: "Campo numérico!"
              },
              email: {
                 required: "Campo Obrigatório!",
                 email: "Informe um email correto!"
              },
              rua: {
                 required: "Campo Obrigatório!"
              },
              numero: {
                required: "Campo Obrigatório!",
                number: "Este campo só pode conter numeros!"
              },
              bairro: {
                required: "Campo Obrigatório!"
              },
              nome_cidade: {
                required: "Campo Obrigatório!"
              },
              cep: {
                required: "Campo Obrigatório!"
              },
              nome_estado: {
                required: "Campo Obrigatório!"
              },
              telefone_um: {
                required: "Campo Obrigatório!"
              },
        },

      submitHandler: postFormOperador,
    }
  );

  function postFormOperador(form) {
      $('.loading').fadeIn('fast').removeClass('hidden');
      form.submit();

  };

  $("#form_actions_operator").validate({
          // Define as regras
          rules: {
              name: {
                required: true,
                lettersonlys: true
              },
              data_nascimento: {
                required: true
              },
              cpf: {
                required: true,
                verificarCpf: true
              },
              rg: {
                required: true,
                digits: true
              },
              email: {
                 required: true,
                 email: true
              },
              rua: {
                 required: true
              },
              numero: {
                required: true,
                number: true
              },
              bairro: {
                required: true
              },
              nome_cidade: {
                required: true
              },
              cep: {
                required: true,
              },
              nome_estado: {
                required: true
              },
              telefone_um: {
                required: true
              },
          },
          // Define as mensagens de erro para cada regra
          messages: {
                name: {
                  required: "Campo Obrigatório!",
                },
                data_nascimento: {
                  required: "Campo Obrigatório!",
                },
                cpf: {
                  required: "Campo Obrigatório!",
                  verificarCpf: "CPF inválido!"
                },
                rg: {
                  required: "Campo Obrigatório!",
                  digits: "Campo numérico!"
                },
                email: {
                   required: "Campo Obrigatório!",
                   email: "Informe um email correto!"
                },
                rua: {
                   required: "Campo Obrigatório!"
                },
                numero: {
                  required: "Campo Obrigatório!",
                  number: "Este campo só pode conter numeros!"
                },
                bairro: {
                  required: "Campo Obrigatório!"
                },
                nome_cidade: {
                  required: "Campo Obrigatório!"
                },
                cep: {
                  required: "Campo Obrigatório!"
                },
                nome_estado: {
                  required: "Campo Obrigatório!"
                },
                telefone_um: {
                  required: "Campo Obrigatório!"
                },
          },

        submitHandler: postFormEditOperador,
      }
    );

    function postFormEditOperador(form) {
        $('.loading').fadeIn('fast').removeClass('hidden');
        form.submit();
    };

    $("#new_especialidade").validate({
            // Define as regras
            rules: {
                codigo_especialidade: {
                  required: true,
                  number: true
                },
                nome_especialidade: {
                  required: true,
                  lettersonlys: true
                },
            },
            // Define as mensagens de erro para cada regra
            messages: {
                  codigo_especialidade: {
                    required: "Campo Obrigatório!",
                    number: "Este campo só pode conter numeros!"
                  },
                  nome_especialidade: {
                    required: "Campo Obrigatório!",
                  },
            },

          submitHandler: postFormEspecialidade,
        }
      );

      function postFormEspecialidade(form) {
          $('.loading').fadeIn('fast').removeClass('hidden');
          form.submit();

      };

      $("#create_doctor").validate({
              // Define as regras
              rules: {
                  numero_crm: {
                    required: true,
                    number: true
                  },
                  nome_medico: {
                    required: true,
                    lettersonlys: true
                  },
                  rua: {
                     required: true
                  },
                  numero: {
                    required: true,
                    number: true
                  },
                  bairro: {
                    required: true
                  },
                  nome_cidade: {
                    required: true
                  },
                  cep: {
                    required: true,
                  },
                  nome_estado: {
                    required: true
                  },
                  telefone_um: {
                    required: true
                  },
              },
              // Define as mensagens de erro para cada regra
              messages: {
                    numero_crm: {
                      required: "Campo Obrigatório!",
                      number: "Este campo só pode conter numeros!"
                    },
                    nome_medico: {
                      required: "Campo Obrigatório!",
                    },
                    rua: {
                       required: "Campo Obrigatório!"
                    },
                    numero: {
                      required: "Campo Obrigatório!",
                      number: "Este campo só pode conter numeros!"
                    },
                    bairro: {
                      required: "Campo Obrigatório!"
                    },
                    nome_cidade: {
                      required: "Campo Obrigatório!"
                    },
                    cep: {
                      required: "Campo Obrigatório!"
                    },
                    nome_estado: {
                      required: "Campo Obrigatório!"
                    },
                    telefone_um: {
                      required: "Campo Obrigatório!"
                    },
              },

            submitHandler: postFormCreateDoctor,
          }
        );

        function postFormCreateDoctor(form) {
            $('.loading').fadeIn('fast').removeClass('hidden');
            form.submit();
        };

        $("#form_actions_doctor").validate({
                // Define as regras
                rules: {
                    numero_crm: {
                      required: true,
                      number: true
                    },
                    nome_medico: {
                      required: true,
                      lettersonlys: true
                    },
                    rua: {
                       required: true
                    },
                    numero: {
                      required: true,
                      number: true
                    },
                    bairro: {
                      required: true
                    },
                    nome_cidade: {
                      required: true
                    },
                    cep: {
                      required: true,
                    },
                    nome_estado: {
                      required: true
                    },
                    telefone_um: {
                      required: true
                    },
                },
                // Define as mensagens de erro para cada regra
                messages: {
                      numero_crm: {
                        required: "Campo Obrigatório!",
                        number: "Este campo só pode conter numeros!"
                      },
                      nome_medico: {
                        required: "Campo Obrigatório!",
                      },
                      rua: {
                         required: "Campo Obrigatório!"
                      },
                      numero: {
                        required: "Campo Obrigatório!",
                        number: "Este campo só pode conter numeros!"
                      },
                      bairro: {
                        required: "Campo Obrigatório!"
                      },
                      nome_cidade: {
                        required: "Campo Obrigatório!"
                      },
                      cep: {
                        required: "Campo Obrigatório!"
                      },
                      nome_estado: {
                        required: "Campo Obrigatório!"
                      },
                      telefone_um: {
                        required: "Campo Obrigatório!"
                      },
                },

              submitHandler: postFormActionsDoctor,
            }
          );

          function postFormActionsDoctor(form) {
              $('.loading').fadeIn('fast').removeClass('hidden');
              form.submit();
          };


          $("#add_especialdiades").validate({
                  // Define as regras
                  rules: {
                      codigo_especialidade: {
                        required: true,
                      },
                  },
                  // Define as mensagens de erro para cada regra
                  messages: {
                        codigo_especialidade: {
                          required: "Campo Obrigatório!",
                        },
                  },

                submitHandler: postFormCadastrarEspecialidadeMedico,
              }
            );

            function postFormCadastrarEspecialidadeMedico(form) {
                $('.loading').fadeIn('fast').removeClass('hidden');
                form.submit();
            };

            $("#buscar_hoje").validate({
                  // Define as regras
                  rules: {
                      especialidade: {
                          required: true
                      },
                      medico: {
                          required: true
                      },
                      periodo: {
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
                      periodo: {
                          required: "Você tem que selecionar um periodo antes!"
                      },
                  },

                  submitHandler: postFormBuscarHoje,
              });

              function postFormBuscarHoje(form) {
                  $('.loading').fadeIn('fast').removeClass('hidden');
                  form.submit();
              };

              $("#buscar_hoje").validate({
                    // Define as regras
                    rules: {
                        especialidade: {
                            required: true
                        },
                        medico: {
                            required: true
                        },
                        periodo: {
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
                        periodo: {
                            required: "Você tem que selecionar um periodo antes!"
                        },
                    },

                    submitHandler: postFormBuscarHoje,
                });

                function postFormBuscarHoje(form) {
                    $('.loading').fadeIn('fast').removeClass('hidden');
                    form.submit();
                };

              //   $("#form-mensal").validate({
              //         // Define as regras
              //         rules: {
              //             ano: {
              //                required: true
              //             },
              //             meses: {
              //                required: true
              //             },
              //         },
              //         // Define as mensagens de erro para cada regra
              //         messages: {
              //             ano: {
              //                 required: "Esse campo é obrigatório!"
              //             },
              //             meses: {
              //                 required: "Esse campo é obrigatório!"
              //             },
              //         },
              //
              //         submitHandler: postFormBuscarMensal,
              //     });
              //
              //     function postFormBuscarMensal(form) {
              //         $('.loading').fadeIn('fast').removeClass('hidden');
              //         form.submit();
              //     };

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

jQuery.validator.addMethod("lettersonlys", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Preencha somente com letras");
