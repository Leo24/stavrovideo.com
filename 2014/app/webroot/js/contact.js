$(document).ready(function() {
        $('input[name="q_t"]').remove();
        
	$('.contact-form').submit(function() {
	        var frm = $(this);
		var buttonCopy = $('button', $(this)).html(),
			errorMessage = $('button', $(this)).data('error-message'),
			sendingMessage = $('button', $(this)).data('sending-message'),
			okMessage = $('button', $(this)).data('ok-message'),
			hasError = false;
                        
		$('.error-message', $(this)).remove();
		
		$('.requiredField', $(this)).each(function() {
			if($.trim($(this).val()) == '') {
				var errorText = $(this).data('error-empty');
				$(this).parent().append('<span class="error-message" style="display:none;">'+errorText+'.</span>').find('.error-message').fadeIn('fast');
				$(this).addClass('inputError');
				hasError = true;
			} else if($(this).is("input[type='email']") || $(this).attr('name')==='email') {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test($.trim($(this).val()))) {
					var invalidEmail = $(this).data('error-invalid');
					$(this).parent().append('<span class="error-message" style="display:none;">'+invalidEmail+'.</span>').find('.error-message').fadeIn('fast');
					$(this).addClass('inputError');
					hasError = true;
				}
			}
		});
		
		if(hasError) {
			$('button', $(this)).html('<i class="fa fa-times"></i>'+errorMessage);
			setTimeout(function(){
			     console.log(buttonCopy);
				$('button', frm).html(buttonCopy);
			},2000);
		}
		else {
			$('button', $(this)).html('<i class="fa fa-spinner fa-spin"></i>'+sendingMessage);
			
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('button', frm).html('<i class="fa fa-check"></i>'+okMessage);
				setTimeout(function(){
					$('button', frm).html(buttonCopy);
                                        $('input, textarea', frm).val('');
				},2000);
				
			});
		}
		
		return false;	
	});
});