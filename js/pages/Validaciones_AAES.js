var Validaciones_AAES = function() {
	 
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
            var formLogin       = $('#registro_AAES');
            var formLogin2       = $('#actualizacion_AAES');
           
            $('#registro_AAES').validate({
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
                    'nombre_asociacion': {
                        required: true,
                        minlength: 10,
                        maxlength: 50
                    },

                    'telefono': {
                        required: true
                    },
                    'fax': {
                        required: true
                    },
                    
                     'email': {
                        required: true,
                        email: true
                    },
                    'operador': {
                        required: true,
                        minlength: 10,
                        maxlength: 50   
                    },
                    'contacto_comercial': {
                        required: true,
                       	minlength: 10,
                       	maxlength: 50 
                    },
                    'contacto_documentos': {
                        required: true,
                       	minlength: 10,
                        maxlength: 50 
                    },
                    'direccion': {
                        required: true,
                        minlength: 10,
                        maxlength: 50 
                    }
	            },
                messages: {
                    'nombre_asociacion': {
                        required:'Proporcione un nombre para la Asociación',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'telefono': {
                        required: 'Por favor ingrese el teléfono del usuario',
                        
                    },
                    'fax': {
                        required: 'Por favor ingrese el FAX del usuario',
                        
                    },
                    
                    'email': 'Por favor ingrese el correo electrónico de la cuenta',
                    'contra': {
                        required: 'Por favor ingrese su contraseña',
                        minlength: 'Su contraseña debe tener al menos 5 caracteres de largo'
                    },
                    'operador': {
                        required: 'Por favor ingrese el operador',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'contacto_comercial': {
                        required: 'Por favor ingrese el contacto comercial',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'contacto_documentos': {
                        required: 'Por favor ingrese el contacto de documentos',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'direccion': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    
                    

                }
            });


            $('#actualizacion_AAES').validate({
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
                    'nombre_asociacion': {
                        required: true,
                        minlength: 10,
                        maxlength: 50
                    },

                    'telefono': {
                        required: true
                    },
                    'fax': {
                        required: true
                    },
                    
                     'email': {
                        required: true,
                        email: true
                    },
                    'operador': {
                        required: true,
                        minlength: 10,
                        maxlength: 50   
                    },
                    'contacto_comercial': {
                        required: true,
                        minlength: 10,
                        maxlength: 50 
                    },
                    'contacto_documentos': {
                        required: true,
                        minlength: 10,
                        maxlength: 50 
                    },
                    'direccion': {
                        required: true,
                        minlength: 10,
                        maxlength: 50 
                    }
                },
                messages: {
                    'nombre_asociacion': {
                        required:'Proporcione un nombre para la Asociación',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'telefono': {
                        required: 'Por favor ingrese el teléfono del usuario',
                        
                    },
                    'fax': {
                        required: 'Por favor ingrese el FAX del usuario',
                        
                    },
                    
                    'email': 'Por favor ingrese el correo electrónico de la cuenta',
                    'contra': {
                        required: 'Por favor ingrese su contraseña',
                        minlength: 'Su contraseña debe tener al menos 5 caracteres de largo'
                    },
                    'operador': {
                        required: 'Por favor ingrese el operador',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'contacto_comercial': {
                        required: 'Por favor ingrese el contacto comercial',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'contacto_documentos': {
                        required: 'Por favor ingrese el contacto de documentos',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    'direccion': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 10 caracteres',
                        maxlength: 'Debe de ser menor a 50 caracteres'
                    },
                    
                    

                }
            });


            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $.mask.definitions['~']='[2]';
            $('#fax').mask('~999-9999');
            


            
        }



    };
}();