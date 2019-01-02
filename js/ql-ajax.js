jQuery(document).ready(function($){
	
	$(document).on('click', '#start, #next, #finish, #back, #resume, #check', function(){
		//$(this).action = 'tm_custom_shortcode';
		var tm_skip = $(this).parent().find("#skip").val();
		var tm_checkcnt = $(this).parent().find("#checkcnt").val();
		if(typeof $(".tmo:checked").val() != 'undefined' || $(this).attr('name') == 'start' || $(this).attr('name') == 'resume' || $(this).attr('name') == 'back' || tm_skip == 1 || (tm_checkcnt == 1 && ($(this).attr('name') == 'next' || $(this).attr('name') == 'finish'))){
			$.ajax({
				type: "POST",
				url: MyAjax.ajaxurl,
				data: $(this).parent().serialize() + '&send=' + $(this).attr("value") + '&singul=' + MyAjax.singul,
				success: function(msg){
					$(".tm-question").replaceWith(msg.slice(0, -1));
					if($(this).attr("value") == 'Check'){
						$("#check").replaceWith('<input type="submit" name="next" value="Next" id="next">');
					}
				},
			});
		}
		else if($(this).attr('name') == 'check'){
			alert("Please check correct answer!");
		}
		return false;
	});


});