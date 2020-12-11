<?php 
global $wp_query, $post, $zController;

$meta_key = '_zendvn_sp_zsproduct_';
?>
<?php if( have_posts() ) while( have_posts() ) : the_post();?>

<?php 
    $manufacturerID = get_post_meta($post->ID, $meta_key . 'manufacturer',true);
	$result = $zController->getModel('Manufacturer')->getItem(array('id'=>$manufacturerID));
?>
<div id="zendvn_sp_product_detail">
	<div class="product_imgs">
		<img class="firstImg" width="480px" height="320px"
			src="http://zshopping.xyz/wp-content/plugins/zendvn-shop/public/products/iphone/iphone-6/iphone-6-plus-64gb-bac-1-480x480-1.jpg"
			alt="">
		<ul class="product-thumbs">
			<li><img width="80px" height="53px"
				src="http://zshopping.xyz/wp-content/plugins/zendvn-shop/public/products/iphone/iphone-6/iphone-6-plus-64gb-bac-1-480x480-1.jpg"
				alt=""
				data-img="">
            </li>
		</ul>
		<div class="clr"></div>
	</div>
	<div class="product_text">
		<ul>
			<li class="title"><h1><?php the_title();?></h1></li>
			<li class="manufacturer">Manufacturer: Apple
			</li>
			<li class="price" style="">Price: 600USD</li>
			<li class="sale-off">Sale Off: 500USD</li>
			<li class="gift">
				<div>Gift: Có</div>
			</li>
			<li><a id="add_to_cart" class="order" product-id="259">Đặt hàng</a></li>
			<li><a href="#" class="r360">Xoay hình 360 độ</a>
			</li>
			<li class="detail-cart">
				<div class="alert-cart">Your cart updated</div>
				<div>
					Currently, <span class="number_product">6 products</span> in your
					cart
				</div>
				<div>
					View details of your cart <a href="#">click here</a>
				</div>

			</li>
		</ul>
	</div>
	<div class="clr"></div>
</div>
<?php the_content();?>
<?php endwhile;?>