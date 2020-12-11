<?php 
    global $zController, $zendvn_sp_settings, $wp_query, $wpQuery;
?>
<?php if(have_posts()) while(have_posts()) : the_post();?>
<h1 class="entry-title">
    <?php the_title();?>
</h1>
<div class="entry-content">
    <?php the_content();?>
    <?php 
        $productQuery = $zController->getModel('Product')->getAllProduct();
        $wpQuery = $productQuery;
        echo '<ul id="zendvn_sp_products">';
        while ($productQuery->have_posts()){
            $productQuery->the_post();
            $postID = $productQuery->post->ID;
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
	?>
    <div class="clr"></div>
</div>
<?php endwhile;?>
<?php 
	if($wpQuery->max_num_pages > 1){
		$zController->getView('paging.php','/frontend');
	}
?>