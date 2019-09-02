
        jQuery('.js-validation-reminder').validate({
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
                'reminder-credential': {
                    required: true,
                    email: true
                }
            },
            messages: {
                'reminder-credential': {
                    required: 'Por favor, digite seu e-mail',
                    email: 'E-mail inválido, preencha corretamente'
                }
            }
        });
    