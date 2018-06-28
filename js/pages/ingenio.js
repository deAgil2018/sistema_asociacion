var Ingenio = function() {
	 
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
            var registro_ingenio_modal       = $('#registro_ingenio_modal');

            

           
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
                    'identificador': {
                        required: true,
                    },
                     'nit': {
                        required: true,
                    },
                     'con_documentacion': {
                        required: true,
                    },
                     'fax': {
                        required: true,
                    },
                     'nrc': {
                        required: true,
                    },
                     'correo': {
                        required: true,
	               },
                    'con_emision': {
                        required: true,
                   },
                    'con_factura': {
                        required: true,
                   },
                    'con_financiero': {
                        required: true,
                   },
                    'numero_fda': {
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
                    'con_otros': 'Por favor ingrese otros contactos, "ninguno" de no haberlos',
                    'co_direccion': 'Por favor ingrese el código postal',
                    'con_financiero': 'Por favor ingrese el contacto financiero',
                    'con_documentacion': 'Por favor ingrese el contacto de documentación',
                    'con_factra': 'Por favor ingrese el contacto de factura',
                    'con_emision': 'Por favor ingrese el contacto de emision',
                    'correo': 'Por favor ingrese el correo electronico',
                    'fax': 'Por favor ingrese el FAX',
                    'nrc': 'Por favor ingrese el NRC',
                    'nit': 'Por favor ingrese el NIT',
                    'numero_fda': 'Por favor ingrese el numero FDA',

                }
            });


            $('#registro_ingenio_modal').validate({
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
                    'numero_fda1': {
                        required: true
                    },
                    'nrc1': {
                        required: true
                    },
                    'fax1': {
                        required: true
                    },
                    

                    'correo1': {
                        required: true
                    },
                    'direccion1': {
                        required: true,
                        minlength: 10
                    },


                    'con_operativo1': {
                        required: true,
                    },
                    'con_comercial1': {
                        required: true,
   
                    },
                    'con_financiero1': {
                        required: false,
                    },
                    'con_documentacion1': {
                        required: true,
                    },
                     'cfactura1': {
                        required: true,
                    },
                     'cemision1': {
                        required: true,
                    }
               },

                messages: {
                    'nombre1': 'Por favor ingrese el nombre de la oficina',
                    'numero_fda1': 'Por favor ingrese el numero de FDA',
                    'nrc1': 'Por ingrese el NIT',
                    'fax1': 'Ingrese el FAX',
                    'correo1': 'Proporcione un correo electrónico',
                    'con_operativo1': 'Proporcione le contacto operativo',
                    'con_comercial1': 'Proporcione le contacto comercial',
                    'con_financiero1': 'Proporcione le contacto financiero',
                    'con_documentacion1': 'Proporcione le contacto de documentos',
                    'cfactura1': 'Proporcione le contacto contable de facturación',
                    'cemision1': 'Proporcione le contacto contable de emisión',
                    'direccion1': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },

                }
            });



            $('#registro_telefono_ingenio').validate({
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
                    'nombre2': {
                        required: true
                    },
                    'telefono2': {
                        required: true
                    }
               },

                messages: {
                    'nombre2': 'Por favor ingrese el nombre del responsable',
                    'telefono2': 'Por favor ingrese el número de teléfono',
                    

                }
            });

            $('#registro_actualizar_telefono').validate({
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
                    'nombre1': {
                        required: true
                    }
               },

                messages: {
                    'nombre1': 'Por favor ingrese el nombre del responsable',
                    'nombre1': 'Por favor ingrese el número de teléfono',
                    

                }
            });



            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $('#telefono1').mask('~999-9999');
            $('#telefono2').mask('~999-9999');
            $.mask.definitions['~']='[2]';
            $('#fax').mask('~999-9999');
            $('#nit').mask('9999-999999-999-9');
            $('#fax1').mask('~999-9999');
            $('#nit1').mask('9999-999999-999-9');
        
        }

    };
}();