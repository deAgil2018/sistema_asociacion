var Perfil = function() {
	 
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
                    'nombre': {
                        required: true
                    }

                    /*'nacimiento': {
                        required: true
                    },
                    'nacionalidad': {
                        required: true
                    },
                     'acedemico': {
                        required: true
                    },
                    'mater': {
                        required: true, 
                    },
                    'partido': {
                        required: true

                    }*/
	            },
                messages: {
                    'nombre': 'Por favor ingrese el nombre',
                    'nacionalidad':'Por favor ingrese la nacionalidad',
                    'nacimiento':'Ingrese el lugar de nacimiento',
                    'acedemico': 'Ingrese el nivel academico',
                    'mater': 'Complete este campo',
                    'partido': 'Por favor ingrese el partido politico',

                }
            });
                       
        }



    };
}();