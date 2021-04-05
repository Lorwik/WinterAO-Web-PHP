$(document).ready(function() {

	$("#form-login").validate({
	  	rules: {
	    	email: {
	      		required: true,
	      		email: true,
	      		minlength: 4,
	      		maxlength: 32
	      	},
	      	password: {
        		required: true,
        		minlength: 6,
        		maxlength: 23,
      		}
	    },
	    messages: {
      		email: {
        		required: "Ingrese un correo electrónico válido.",
        		minlength: "Tu correo electrónico debe tener como mínimo 4 caracteres.",
        		maxlength: "Tu correo electrónico debe tener como máximo 32 caracteres."
      		},
      		password: {
        		required: "Ingrese una contraseña.",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres."
      		}
    	}
	});
});