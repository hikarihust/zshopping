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
	
	$linkAddCart = site_url('?zsproduct=' . get_query_var('zsproduct') . '&action=add_cart&id=' . $post->ID);
?>
<div id="zendvn_sp_product_detail">
	<div class="product_imgs">
		<img class="firstImg" width="480px" height="320px"
            src="<?php echo $firstImg;?>"
			alt="<?php the_title();?>">
		<ul class="product-thumbs">
		<?php 
			foreach ($newPicArray as $key => $val){
				$imgThumbnail = $zController->getHelper('ImgThumbnail');
				$imgUrl = $imgThumbnail->resize($key, 80, 53);
		?>
			<li><img width="80px" height="53px"
				src="<?php echo $imgUrl;?>"
				alt=""
				data-img="<?php echo $key;?>">
			</li>
		<?php 
			}
		
		?>
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
			<li><a id="add_to_cart" class="order" product-id="<?php echo $post->ID;?>" href="<?php echo $linkAddCart; ?>">Đặt hàng</a></li>
			<li><a href="#" class="r360">Xoay hình 360 độ</a>
			</li>
			<li class="detail-cart">
				<?php 
					$ss 		= $zController->getHelper('Session');
					$ssCart 	= $ss->get('zcart',array());
					$total_item = 0;
					if(count($ssCart)>0){
						foreach ($ssCart as $key => $val){
							$total_item += $val;
						}
					}
		
					$str_item = $total_item . ' product';
					if($total_item > 1){
						$str_item = $total_item . ' products';
					}
				?>
				<div class="alert-cart">Your cart updated</div>
				<div>
					Currently, <span class="number_product"><?php echo $str_item;?></span> in your
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