$(document).ready(function() {
    $('#button-login').click(function() {
        jQuery('.js-validation-signin').validate({
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
                'login-email': {
                    required: true,
                    email: true
                },
                'login-password': {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                'login-email': {
                    required: 'Por favor, preencha seu e-mail',
                    email: 'Seu e-mail deve estar na forma josé@exemplo.com',
                },
                'login-password': {
                    required: 'Por favor, preencha sua senha',
                    minlength: 'Sua senha tem no mínimo 8 caracteres'
                }
            },
            submitHandler: function (form) {
                var dados = $('#form-login').serializeArray();
                console.log(dados);
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                  type: "POST",
                  url: "../controller/controllerLogin.php",
                  data: dados,
                  success: function (result) {
                    if (result == 1) {
                      $body.removeClass("loading");
                      $("#form-login")[0].reset()
                      window.location="../view/viewGerencia.php";
                    } else if (result == 2) {
                        $body.removeClass("loading");
                        $("#form-login")[0].reset()
                        window.location="../view/viewProfessor.php"; 
                    } else if (result == 3) {
                        $body.removeClass("loading");
                        $("#form-login")[0].reset()
                        window.location="../view/viewAluno.php";
                    } else{
                      $body.removeClass("loading");
                      alert("Dados incorretos"); 
                    }     
                  }
                });
                return false;
              }
              
        });

    });
});
