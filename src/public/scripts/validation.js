$(document).ready(function(){
//   $('#cpf').mask('000.000.000-00'),
//   $('#telefone-um').mask("(00) 0000-00009");
//   $('#telefone-dois').mask("(00) 0000-00009");
//   $('#numero_cns').mask("000.0000.0000.0000");
//   $('#cep').mask("00000-000");
//
// $('#btn-cadastrar-paciente').click(function(){
//   $('#cpf').unmask();
//   $('#telefone-um').unmask();
//   $('#telefone-dois').unmask();
//   $('#cep').unmask();
//   $("#numero_cns").unmask();
// });
//
// $('#btn-search-paciente').click(function(){
//   $('#numero_cns').unmask();
// });
//
// $('#btn-cadastrar-paciente').click(function(){
//   $('#numero_cns').unmask();
//   $('#cpf').unmask();
// });



// $('#cpf').blur(function(){
//   function TestaCPF(strCPF) {
//     var Soma;
//     var Resto;
//     Soma = 0;
//
//     exp = /\.|\-/g
//     strCPF = strCPF.toString().replace( exp, "" );
//
//     if (strCPF == "00000000000") return false;
//
//     for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
//     Resto = (Soma * 10) % 11;
//
//     if ((Resto == 10) || (Resto == 11))  Resto = 0;
//     if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
//
//     Soma = 0;
//     for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
//     Resto = (Soma * 10) % 11;
//
//     if ((Resto == 10) || (Resto == 11))  Resto = 0;
//     if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
//     return true;
//   }
//   var strCPF = $('#cpf').val();
//   alert(TestaCPF(strCPF));
//
// });
});
