<?php 
    global $zController, $zendvn_sp_settings, $wp_query;
?>
<?php if(have_posts()) while(have_posts()) : the_post();?>
<h1 class="entry-title">
    <?php the_title();?>
</h1>
<div class="entry-content">
    <?php the_content();?>
    <?php 
        $productQuery = $zController->getModel('Product')->getAllProduct();
    ?>
    <ul id="zendvn_sp_products">
        <li>
			<div class="product">
				<a href="#"title="">
					<img src="http://zshopping.xyz/wp-content/plugins/zendvn-shop/public/products/p160x160/Galaxy-A5.jpg" alt="" width="160px" height="160px">
					<div class="name">iPhone 4</div>
				</a>
				<div class="price">
					<span class="plft" style="">USD</span>
					<span class="prt">USD</span>
				</div>
				<div class="gift clr">&nbsp;</div>
			</div>
		</li>
    </ul>
    <div class="clr"></div>
</div>
<?php endwhile;?>
<?php 
	$zController->getView('paging.php','/frontend');
?>