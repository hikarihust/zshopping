jQuery(document).ready(function($){
	$('#add_to_cart').click(function(e){
		var dataObj = {
            "action"	: "add_to_cart",
            "value"		: $(this).attr('product-id'),
            "security"	: security_code,
        };
		$.ajax({
			url			: ajaxurl,
			type		: "POST",
			data		: dataObj,
			dataType	: "text",
			success		: function(data, status, jsXHR){
                            $(".detail-cart span.number_product").text(data);

                            $(".detail-cart .alert-cart").show('slow');
						}
		});
	});
});
