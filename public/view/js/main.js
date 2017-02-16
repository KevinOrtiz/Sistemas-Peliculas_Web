

$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
        $("#login-form").display('block');
		$('#register-form-link').removeClass('active');
         $("#register-form").display('none');
		$('#login-form-link').addClass('active');

		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
        $("#login-form").display('none');
         $("#register-form").display('block');
		$('#login-form-link').removeClass('active');
		$('#register-form-link').addClass('active');
		e.preventDefault();
	});

});
