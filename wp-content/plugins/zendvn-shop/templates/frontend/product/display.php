<?php 
global $wp_query, $post, $zController, $zendvn_sp_settings;

$meta_key = '_zendvn_sp_zsproduct_';
?>
<?php if( have_posts() ) while( have_posts() ) : the_post();?>

<?php 
    $manufacturerID = get_post_meta($post->ID, $meta_key . 'manufacturer',true);
    $result = $zController->getModel('Manufacturer2')->getItem(array('id'=>$manufacturerID));
    $manufacturer = $result['name'];

    $price = get_post_meta($post->ID, $meta_key . 'price',true) . ' ' . $zendvn_sp_settings['currency_unit'];
    $saleOff = get_post_meta($post->ID, $meta_key . 'sale-off',true) . ' ' . $zendvn_sp_settings['currency_unit'];

    $cssPrice = '';
    if(get_post_meta($post->ID, $meta_key . 'sale-off',true) >0 ){
        $cssPrice = 'text-decoration: line-through';
	}else{
		$saleOff = '';
    }
    
    $gift = get_post_meta($post->ID, $meta_key . 'gift',true);

	$arrOrdering = get_post_meta($post->ID, $meta_key . 'img-ordering', true);
    $arrPicture = get_post_meta($post->ID, $meta_key . 'img-url', true);
    
	$newPicArray = array();
	foreach ($arrPicture as $key => $val){
		$newPicArray[$val] = $arrOrdering[$key];
	}
    asort($newPicArray);
    $firstImg = key($newPicArray);
?>
<div id="zendvn_sp_product_detail">
	<div class="product_imgs">
		<img class="firstImg" width="480px" height="320px"
            src="<?php echo $firstImg;?>"
			alt="<?php the_title();?>">
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
			<li class="manufacturer">Manufacturer: <?php echo $manufacturer;?>
			</li>
			<li class="price" style="<?php echo $cssPrice;?>">Price: <?php echo $price;?></li>
			<li class="sale-off">Sale Off: <?php echo $saleOff;?></li>
			<li class="gift">
				<div>Gift: <?php echo $gift;?></div>
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