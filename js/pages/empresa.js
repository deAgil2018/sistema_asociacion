var Empresa = function() {
	 
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

                    'correo1': {
                        required: true
                    },
                    'credito1': {
                        required: true,
                    },
                     'nit1': {
                        required: true,
                    },
                    'tipo_empresa1': {
                        required: true,
   
                    },
                    'detalle_nombre1': {
                        required: true,
                    },
                    'detalle_numero1': {
                        required: true,
                    },
                     'cheque_nombre1': {
                        required: true,
                    }
	            },
                messages: {
                    'nombre1': 'Por favor ingrese el nombre de la empresa',
                    'credito1': {
                        required: 'Por favor ingrese el credito de la empresa',
                        
                    },
                    'nit1': {
                        required: 'Por favor ingrese el NIT',
                    },
                    'tipo_empresa1': {
                        required: 'Por favor ingrese el tipo de empresa',

                    },
                    'correo1': 'Por favor ingrese el correo electrónico de la cuenta',
                    'detalle_nombre1': 'Por favor ingrese el nombre de la cuenta bancaria',
                    'detalle_numero1': 'Por favor ingrese el número de la cuenta bancaria',
                    'cheque_nombre1': 'Por favor ingrese el nombre del encargado de cheques',
                    

                }
            });
            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $('#fax').mask('~999-9999');
        
        }

    };
}();