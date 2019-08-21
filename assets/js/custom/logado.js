$(document).ready(function () {
    $('#btnEditarLogado').click(function () {
      jQuery('.js-validation-logado').validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            jQuery(e).parents('.form-group > div').append(error);
        },
        highlight: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
          'cpf': {
              cpfBR: true
          },
          'email': {
              email: true
          },
          'senha': {
             minlength: 6
          },
          'confirm-senha': {
              equalTo: '#senha'
          }
      },
      messages: {
        'cpf': {
            cpfBR: 'Digite um cpf válido'
        },
        'email': {
            email: 'Digite um endereÃ§o de email válido'
        },
        'senha': {
            minlength: 'A senha deve ter no mínimo 8 caracteres'
        },
        'confirm-senha': {
            minlength: 'A senha deve ter no mínimo 8 caracteres',
            equalTo: 'Digite a mesma senha do campo acima'
        }
    },
        /*submitHandler: function (form) {
          var dados = $('#form-cadastrar-logado').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerLogado.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-logado")[0].reset();
                $('#idC').val('').trigger('change');
                alerta("success", "Logado cadastrado com sucesso!", " Cadastrar outro", "Ver lista de logado", "viewListarLogado.php");
              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar logado!", " Cadastrar outro", "Ver lista de logado", "viewListarLogado.php");
              }     
            }
          });
          return false;
        }*/


$submitHandler: function (form) {
    var dados = $('#form-cadastrar-logado').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../controller/ControllerLogado.php",
          data: dados,
          success: function (result) {
          alert(result);
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Dados editados com sucesso!", " Voltar", "", "");

              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao editar dados", " Voltar", "", "");
                atualizarTabela();
              }
          }
      });
      return false;
}
  });
    });
  });
function excluirLogado(id) {
  var nome = $('#rowDeleteLogado_' + (id - 1)).attr("data-nome");
  var id = $('#rowDeleteLogado_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o logado " + nome + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#D05BE2",
      confirmButtonText: "<i class='fa fa-times'></i> Excluir",
      cancelButtonText: "<i class='fa fa-check'></i> Cancelar",
      preConfirm: function () {
        $body = $("body");
        $body.addClass("loading");
          $.ajax({
              type: "POST",
              url: "../controller/ControllerLogado.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Logado excluÃ­do com sucesso!", " Ver logado", "Adicionar novo logado", "viewAdicionarLogado.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir o logado!", " Ver logado", "Adicionar novo logado", "viewAdicionarLogado.php");
                    atualizarTabela();
                  }

              }
          });
      }
  });
  return false;
}
  function alerta(type, title, button, footer, link){
    Swal.fire({
      type: type,
      showConfirmButton: false,
      html:
      '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i>'+ button +'</button>',
      title: title,
      footer: '<a href="'+link+'">'+footer+'</a>'
    });
    $("#ok").click(function () {
      Swal.close();
    });
  }

  function atualizarTabela(){
    var table = $('#listar_logado').DataTable();
    table.ajax.reload(null, false);
  }

  function editarLogado(id) {
    var idLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-id");
    var nomeLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-nome");
    var cpfLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-cpf");
    var dataLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-data");
    var emailLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-email");
    var senhaLogado = $('#rowEditarLogado_' + (id - 1)).attr("data-senha");
    var idCurso = $('#rowEditarLogado_' + (id - 1)).attr("data-idc");

    $('#curso').load('../view/hello.php?IdCurso='+idCurso);

    $('#verLogado').modal('show');

    $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do logado(a) " + nomeLogado);
    $('.modal .modal-dialog .modal-content #id').val(idLogado);
    $('.modal .modal-dialog .modal-content #nome').val(nomeLogado);
    $('.modal .modal-dialog .modal-content #cpf').val(cpfLogado);
    $('.modal .modal-dialog .modal-content #data').val(dataLogado);
    $('.modal .modal-dialog .modal-content #email').val(emailLogado);
    $('.modal .modal-dialog .modal-content #senha').val(senhaLogado);
  
}

$.validator.addMethod( "cpfBR", function( value, element ) {
	"use strict";

	if ( this.optional( element ) ) {
		return true;
	}

	// Removing special characters from value
	value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "" );

	// Checking value to have 11 digits only
	if ( value.length !== 11 ) {
		return false;
	}

	var sum = 0,
		firstCN, secondCN, checkResult, i;

	firstCN = parseInt( value.substring( 9, 10 ), 10 );
	secondCN = parseInt( value.substring( 10, 11 ), 10 );

	checkResult = function( sum, cn ) {
		var result = ( sum * 10 ) % 11;
		if ( ( result === 10 ) || ( result === 11 ) ) {
			result = 0;
		}
		return ( result === cn );
	};

	// Checking for dump data
	if ( value === "" ||
		value === "00000000000" ||
		value === "11111111111" ||
		value === "22222222222" ||
		value === "33333333333" ||
		value === "44444444444" ||
		value === "55555555555" ||
		value === "66666666666" ||
		value === "77777777777" ||
		value === "88888888888" ||
		value === "99999999999"
	) {
		return false;
	}

	// Step 1 - using first Check Number:
	for ( i = 1; i <= 9; i++ ) {
		sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 11 - i );
	}

	// If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
	if ( checkResult( sum, firstCN ) ) {
		sum = 0;
		for ( i = 1; i <= 10; i++ ) {
			sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 12 - i );
		}
		return checkResult( sum, secondCN );
	}
	return false;

}, "Please specify a valid CPF number" );
