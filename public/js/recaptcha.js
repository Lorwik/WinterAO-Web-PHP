$(document).ready(function() {

	$("form").submit(function(event) {
	
		event.preventDefault();

		grecaptcha.ready(function() {
	        grecaptcha.execute('6LfBaP0UAAAAAOVHbT0uEeFxmNSRMLGCu6n_V-vU', { action: 'submit' }).then(function(token) {
	            $('form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
	            $('form').unbind('submit').submit();
	        });
	    });
	});

});