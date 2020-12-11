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
    ?>
        <li>
			<div class="product">
				<a href="#"title="">
					<img src="<?php echo $img;?>" alt="" width="160px" height="160px">
					<div class="name"><?php echo $tilte;?></div>
				</a>
				<div class="price">
					<span class="plft" style="">USD</span>
					<span class="prt">USD</span>
				</div>
				<div class="gift clr">&nbsp;</div>
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
	$zController->getView('paging.php','/frontend');
?>