jQuery(document).ready(function() {
	






	var inputHeight = jQuery('.chat-input-box form input').height();
	var inputHeightdevide = inputHeight / 2;
	jQuery('.chat-input-box form button').css({
		top: inputHeightdevide
	});






	setInterval(function(){


		// Get input Value for Massage
		var inputVal = jQuery('.chat-input-box form input#sms').val();
		var inputVal = inputVal.trim();


		// Condition for Show Send Button 
		if(inputVal.length >=1){
			jQuery('.chat-input-box form button').show();
		}else{
				// Send Button is hide
		jQuery('.chat-input-box form button').hide();

		}




	}, 50);


});