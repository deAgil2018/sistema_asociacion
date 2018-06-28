var Oficinas_trader = function() {
	 
	 // Function for switching form views (login, reminder and register forms)
    var switchView = function(viewHide, viewShow, viewHash){
        viewHide.slideUp(250);
        viewShow.slideDown(250, function(){
            $('input').placeholder();
        });

        if ( viewHash ) {
            window.location = '#' + viewHash;
        } else {
            window.location = '#';
        }
    };

	return {
        init: function() {
            /* Switch Login, Reminder and Register form views */
            var formLogin       = $('#registro');

            

           
            $('#registro').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'nombre1': {
                        required: true
                    },

                    'co_contrato': {
                        required: true
                    },
                    'direccion': {
                        required: true,
                        minlength: 10
                    },
                     'con_operativo': {
                        required: true,
                    },
                    'con_comercial': {
                        required: true,
   
                    },
                    'con_otros': {
                        required: false,
                    },
                    'co_direccion': {
                        required: true,
                    },
                     'con_financiero': {
                        required: true,
                    },
                     'con_documentacion': {
                        required: true,
                    }
	            },
                messages: {
                    'nombre1': 'Por favor ingrese el nombre de la oficina',
                    'co_contrato': {
                        required: 'Por favor ingrese el código de contrato',
                        
                    },
                    'direccion': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'con_operativo': {
                        required: 'Por favor repita su contraseña',
                        minlength: 'Su contraseña debe tener al menos 5 caracteres de largo',
                        equalTo: "La contraseña ingresada no coincide"

                    },
                    'con_comercial': 'Por favor ingrese el correo electrónico de la cuenta',
                    'co_direccion': 'Por favor ingrese el código postal',
                    'con_financiero': 'Por favor ingrese el contacto financiero',
                    'con_documentacion': 'Por favor ingrese el ontacto de documentación',

                }
            });
            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $('#fax').mask('~999-9999');
        
        }

    };
}();