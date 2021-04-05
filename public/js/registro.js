$(document).ready(function() {

	$("#form-registro").validate({
	  	rules: {
	    	username: {
				required: true,
	      		minlength: 4,
	      		maxlength: 23
	    	},
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
      		},
      		repassword: {
        		required: true,
        		minlength: 6,
        		maxlength: 23,
        		equalTo: "#password"
      		},
      		checkTerms: { required: true }
	    },
	    messages: {
      		username: {
        		required: "Ingrese un nombre de usuario.",
        		maxlength: "Tu nombre de usuario debe tener como mínimo 4 caracteres.",
        		maxlength: "Tu nombre de usuario debe tener como máximo 23 caracteres.",
      		},
      		password: {
        		required: "Ingrese una contraseña.",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres.",
      		},
      		repassword: {
        		required: "Escriba nuevamente la contraseña aqui!",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres.",
        		equalTo: "Las contraseñas no coinciden, escriba nuevamente la contraseña aqui!"
      		},
      		email: {
        		required: "Ingrese un correo electrónico válido. Deberá verificar la cuenta mas adelante!",
        		minlength: "Tu correo electrónico debe tener como mínimo 4 caracteres.",
        		maxlength: "Tu correo electrónico debe tener como máximo 32 caracteres."
      		},
      		checkTerms: { required: "Debes aceptar el reglamento!" }
    	}
	});
});