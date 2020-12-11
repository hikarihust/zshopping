<?php 
    global $zController;
?>
<h1 class="entry-title">
	Shopping
</h1>
<div class="entry-content">
    <p>
        The Shopping Content Service allows you to use the Google Content API for Shopping in Apps Script. 
        This API gives Google Merchant Center users the ability to upload and manage their product listings 
        and manage their Merchant Center accounts.
    </p>
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
<?php 
	$zController->getView('paging.php','/frontend');
?>