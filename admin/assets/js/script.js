jQuery(document).ready(function() {
	




	jQuery('.form-submit').submit(function(){

	// GET Register Value
		var username = jQuery('input[name="username"]').val();
		var email = jQuery('input[name="email"]').val();
		var pass = jQuery('input[name="pass"]').val();
		var pass2 = jQuery('input[name="pass2"]').val();
		
		jQuery.ajax({
		  url: 'ajax.php',
		  type: 'POST',
		  data: {
		  	username: username,
		  	email: email,
		  	pass: pass,
		  	pass2: pass2,
		  	registration: 'reg'
		  },
		  success: function(data) {
		  	jQuery('.error').html(data);

		  	var username = jQuery('input[name="username"]').val('');
			var email = jQuery('input[name="email"]').val('');
			var pass = jQuery('input[name="pass"]').val('');
			var pass2 = jQuery('input[name="pass2"]').val('');
		  }
		});
		

		return false;
	});



	// Login Ajax Process

	jQuery('.login-form').submit(){

		var username = jQuery('input[name="username"]').val();
		var password = jQuery('input[name="password"]').val();
		var check = jQuery('input[name="remember-me"]').val();

		jQuery.ajax({

			url : 'ajax.php',
			type : "POST",
			data : {
				login : 'login_success',
				username : username,
				pass : password,
				check : check
			},
			success : function(output){
				jQuery('.error').html(output);
			}


		});



	}



});