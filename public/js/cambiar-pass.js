$(document).ready(function() {

	$("#form-cambiarpass").validate({
	  	rules: {
	    	previous_password: {
	    		required: true,
	      		minlength: 6,
	      		maxlength: 23
	    	},
	    	new_password: {
				required: true,
	      		minlength: 6,
	      		maxlength: 23
	    	},
	      	repeat_new_password: {
        		required: true,
        		minlength: 6,
        		maxlength: 23,
        		equalTo: "#new_password"
      		}
	    },
	    messages: {
      		previous_password: {
				required: "Escribe una contraseña aqui!",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres."
	    	},
      		new_password: {
				required: "Escribe una contraseña aqui!",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres."
	    	},
      		repeat_new_password: {
        		required: "Escriba nuevamente la contraseña aqui!",
        		maxlength: "Tu contraseña debe tener como mínimo 6 caracteres.",
        		maxlength: "Tu contraseña debe tener como máximo 23 caracteres.",
        		equalTo: "Las contraseñas no coinciden, escriba nuevamente la contraseña aqui!"
      		}
    	}
	});
});