<?php 
    global $zController, $zendvn_sp_settings, $wp_query, $wpQuery, $post;

    $args = $wp_query->query;
    $args['posts_per_page'] = $zendvn_sp_settings['product_number'];
    $wp_query->query($args);

    $wpQuery = $wp_query
?>
<?php if(have_posts()):?>
<h1 class="entry-title">
    <?php single_cat_title();?>
</h1>
<div class="entry-content">
    <?php echo category_description();?>
    <?php 
        echo '<ul id="zendvn_sp_products">';
        while (have_posts()){
            the_post();
            $postID = $post->ID;
            $tilte = get_the_title($postID);

            $imgThumbnail = $zController->getHelper('ImgThumbnail');
			$width = 160;
			$height = 160;
			$img = $imgThumbnail->getImage($postID,
                            array('type'=>'resize','width'=> $width, 'height'=> $height));
            $meta_key = '_zendvn_sp_zsproduct_';
            $price = get_post_meta($postID, $meta_key . 'price',true) . ' ' . $zendvn_sp_settings['currency_unit'];
            $saleOff = get_post_meta($postID, $meta_key . 'sale-off',true) . ' ' . $zendvn_sp_settings['currency_unit'];

			$cssPrice = '';
			if(get_post_meta($postID, $meta_key . 'sale-off',true) >0 ){
				$cssPrice = 'text-decoration: line-through';
            }
            
			$gift = get_post_meta($postID, $meta_key . 'gift',true);
			if(strlen(trim($gift))>0){
				$gift = '* Có quà tặng *';
			}else{
				$gift = '&nbsp;';
            }
            
            $linkProduct = get_permalink($postID);
    ?>
        <li>
			<div class="product">
				<a href="<?php echo $linkProduct;?>"title="<?php echo $tilte;?>">
					<img src="<?php echo $img;?>" alt="" width="<?php echo $width;?>px" height="<?php echo $height;?>px">
					<div class="name"><?php echo $tilte;?></div>
				</a>
				<div class="price">
					<span class="plft" style="<?php echo $cssPrice?>"><?php echo $price;?></span>
					<span class="prt"><?php echo $saleOff;?></span>
				</div>
				<div class="gift clr"><?php echo $gift;?></div>
			</div>
		</li>
    <?php 
        }
        echo '</ul>';
        wp_reset_postdata();
	?>
    <div class="clr"></div>
</div>
<?php endif;?>
<?php 
	if($wpQuery->max_num_pages > 1){
		$zController->getView('paging.php','/frontend');
	}
?>