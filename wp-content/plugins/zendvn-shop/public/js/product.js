jQuery(document).ready(function($){
	$(".product_imgs .product-thumbs img").on('click', function(){
		var data_img = $(this).attr('data-img');
		$(".product_imgs .firstImg").attr('src',data_img);
	});
});