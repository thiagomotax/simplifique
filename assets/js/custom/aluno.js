$(document).ready(function () {
    $('#button-cadastrar-aluno').click(function () {
      jQuery('.js-validation-aluno').validate({
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
          'nome': {
              required: true,
          },
          'cpf': {
              required: true,
              cpfBR: true
          },
          'email': {
              required: true,
              email: true
          },
          'senha': {
              required: true,
              minlength: 6
          },
          'confirm-senha': {
              required: true,
              equalTo: '#senha'
          },
          'data': {
              required: true
          }
      },
      messages: {
        'nome': {
            required: 'Por favor, digite o nome do aluno',
        },
        'cpf': {
            required: 'Por favor, digite o cpf do aluno',
            cpfBR: 'Digite um cpf válido'
        },
        'email': {
            required: 'Por favor, digite o e-mail do aluno',
            email: 'Digite um endereço de email válido'
        },
        'senha': {
            required: 'Por favor, digite a senha do aluno',
            minlength: 'A senha deve ter no mínimo 8 caracteres'
        },
        'confirm-senha': {
            required: 'Por favor, confirme a senha',
            minlength: 'A senha deve ter no mínimo 8 caracteres',
            equalTo: 'Digite a mesma senha do campo acima'
        },
        'data': {
            required: 'Por favor, preencha a data de nascimento do aluno'
        }
    },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-aluno').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerAluno.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-aluno")[0].reset()
                alerta("success", "Aluno cadastrado com sucesso!", " Cadastrar outro", "Ver lista de alunos", "viewListarAlunos.php");                               
              } else if(result == 2){
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar aluno!", " Cadastrar outro", "Ver lista de alunos", "viewListarAlunos.php");         
              }     
            }
          });
          return false;
        }
      });
    });
  });

$(document).ready(function () {
  $('#btnEditarAluno').click(function () {
      var dados = $('#verAluno-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verAluno').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/ControllerAluno.php",
          data: dados,
          success: function (result) {
              alert(result);
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Aluno editado com sucesso!", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");               
                atualizarTabela();
                  
              } else if(result == 2){
                $body.removeClass("loading");
                alerta("error", "Erro ao editar aluno", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");               
                atualizarTabela();
              }
          }
      });
      return false;
  });
});

function excluirAluno(id) {
  var nome = $('#rowDeleteAluno_' + (id - 1)).attr("data-nome");
  var id = $('#rowDeleteAluno_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o aluno " + nome + "?",
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
              url: "../controller/ControllerAluno.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Aluno excluído com sucesso!", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }
                  else if(result == 2){
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir o aluno!", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");
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
    var table = $('#listar_alunos').DataTable();
    table.ajax.reload(null, false);
  }

  function editarAluno(id) {
    var idAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-id");
    var nomeAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-nome");
    var cpfAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-cpf");
    var dataAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-data");
    var emailAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-email");
    var senhaAluno = $('#rowEditarAluno_' + (id - 1)).attr("data-senha");

    $('#verAluno').modal('show');
    $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do aluno(a) " + nomeAluno);
    $('.modal .modal-dialog .modal-content #id').val(idAluno);
    $('.modal .modal-dialog .modal-content #nome').val(nomeAluno);
    $('.modal .modal-dialog .modal-content #cpf').val(cpfAluno);
    $('.modal .modal-dialog .modal-content #data').val(dataAluno);
    $('.modal .modal-dialog .modal-content #email').val(emailAluno);
    $('.modal .modal-dialog .modal-content #senha').val(senhaAluno);
  
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