jQuery(document).ready(function($){
	$('#add_to_cart').click(function(e){
		var dataObj = {

				};
		$.ajax({
			url			: ajaxurl,
			type		: "POST",
			data		: dataObj,
			dataType	: "text",
			success		: function(data, status, jsXHR){

						}
		});
	});
});
