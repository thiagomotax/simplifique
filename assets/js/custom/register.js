$(document).ready(function() {
    $('#button-cadastrar-usuario').click(function() {
        jQuery('.js-validation-signup').validate({
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
                'signup-name': {
                    required: true,
                },
                'signup-cpf': {
                    required: true,
                    cpfBR: true
                },
                'signup-email': {
                    required: true,
                    email: true
                },
                'signup-password': {
                    required: true,
                    minlength: 5
                },
                'signup-password-confirm': {
                    required: true,
                    equalTo: '#signup-password'
                },
                'signup-terms': {
                    required: true
                },
                'signup-data': {
                    required: true
                },
                'signup-curso': {
                    required: true
                },
                'signup-disciplina': {
                    required: true
                }
            },
            messages: {
                'signup-name': {
                    required: 'Por favor, digite seu nome',
                },
                'signup-cpf': {
                    required: 'Por favor, digite seu cpf',
                    cpfBR: 'Digite um cpf válido'
                },
                'signup-email': {
                    required: 'Por favor, digite seu e-mail',
                    email: 'Digite um enedereço de email válido'
                },
                'signup-password': {
                    required: 'Por favor, digite sua senha',
                    minlength: 'Sua senha deve ter no mínimo 8 caracteres'
                },
                'signup-password-confirm': {
                    required: 'Por favor, confirme sua senha',
                    minlength: 'Sua senha deve ter no mínimo 8 caracteres',
                    equalTo: 'Digite a mesma senha do campo acima'
                },
                'signup-terms': {
                    required: 'Você deve aceitar os termos de uso'
                },
                'signup-data': {
                    required: 'Por favor, preencha sua data de nascimento'
                },
                'signup-curso': {
                    required: 'Por favor, preencha seu curso'
                },
                'signup-disciplina': {
                    required: 'Por favor, preencha sua disciplina'
                }
            },
            submitHandler: function(form) {
                var dados = $('#form-cadastrar-aluno').serializeArray();
                nome = $('#signup-name').val();
                email = $('#signup-email').val();
                senha = $('#signup-password').val();
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "../controller/ControllerRegistro.php",
                    data: dados,
                    success: function(result) {
                        alert(result);
                        if (result == 1) {
                            $body.removeClass("loading");
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Inscrição realizada com sucesso',
                                html:
                                  nome+', você irá receber um e-mail confirmando(ou não) sua inscrição, mediante aprovação.<br/>' +
                                  '<br/>Caso você tenha inserido dados incorretos, entre em contato com a administração da plataforma. Não se esqueça de salvar seus dados de acesso.<br/>' +
                                  '<br/>Seu email: ' + email + '<br/>' +
                                  '<br/>Sua senha: ' + senha + '<br/>',
                                showConfirmButton: false,
                                //timer: 50000
                              });
                            $("#form-cadastrar-aluno")[0].reset();
                            // $('#idC').val('').trigger('change');
                        } else {
                            $body.removeClass("loading");
                        }
                    }
                });
                return false;
            }
        });
    });
});
 

$(':radio').change(function (event) {
    var id = $(this).data('id');
    $('#' + id).addClass('none').siblings().removeClass('none');
});

/*
 * Brazillian CPF number (Cadastrado de Pessoas Físicas) is the equivalent of a Brazilian tax registration number.
 * CPF numbers have 11 digits in total: 9 numbers followed by 2 check numbers that are being used for validation.
 */
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