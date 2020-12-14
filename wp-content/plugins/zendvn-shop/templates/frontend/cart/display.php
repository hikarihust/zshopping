<?php 
	global $zController, $wp_query;
    $ss 	= $zController->getHelper('Session');
    $ssCart = $ss->get('zcart',array());

    $idArr = array_keys($ssCart);
?>
<?php if(have_posts()) while (have_posts()) : the_post();?>
<h1 class="entry-title"><?php the_title();?></h1>
<div class="entry-content">
    <?php the_content();?>
</div>
<div id="zendvn_sp_cart_table">
	<div class="show-alert"></div>
<?php 

$cartHTML = '';
$cartHTML .= '<table>
		<thead>
			<tr>
				<td class="id">ID</td>
				<td class="name">Name</td>
				<td class="quality">Price</td>
				<td class="quality">Quality</td>
				<td class="money">Money</td>
				<td class="control">Action</td>
			</tr>
		</thead>

		<tbody>';
            if(count($idArr)) {
                $args = array(
                    'post_type' => 'zaproduct',
                    'post__in'=> $idArr,
                );
                $wpQuery = new WP_Query($args);
            }
			$cartHTML .= '<tr>
							<td>259</td>
							<td>iPhone 6</td>
							<td>769</td>
							<td><input type="text" name="price[259]" size="5" 
									id="price-259" style="text-align: center;" 
									value="1">
							</td>
							<td class="money-pay">769</td>
							<td class="control">update | remove</td>
						</tr>';
					
$cartHTML .= '</tbody>
	</table>
	<div id="total">
		<b>Total:</b> <span class="pay">$ 1223</span>
	</div>';
	echo $cartHTML;
?>
</div>
<?php endwhile;?>