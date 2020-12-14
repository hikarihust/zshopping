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
            $meta_key = '_zendvn_sp_zsproduct_';
            if(count($idArr)) {
                $args = array(
                    'post_type' => 'zsproduct',
                    'post__in'=> $idArr,
                );
                $wpQuery = new WP_Query($args);
                while ($wpQuery->have_posts()){
                    $wpQuery->the_post();
                    $post = $wpQuery->post;

                    $postID 	= $post->ID;
                    $title 		= $post->post_title;
                    
                    $price		= get_post_meta($postID, $meta_key . 'price', true);
                    $saleOff	= get_post_meta($postID, $meta_key . 'sale-off', true);

                    if(absint($saleOff) >0 ){
                        $price = $saleOff;
                    }

                    $quality = $ssCart[$postID];

                    $money = $price * $quality;

                    $cartHTML .= '<tr>
                                    <td>' . $postID . '</td>
                                    <td>' . $title . '</td>
                                    <td>' . $price . '</td>
                                    <td><input type="text" name="price[' . $postID . ']" size="5" 
                                            id="price-' . $postID . '" style="text-align: center;" 
                                            value="' . $quality . '">
                                    </td>
                                    <td class="money-pay">' . $money . '</td>
                                    <td class="control">update | remove</td>
                                </tr>';
                }
            }
$cartHTML .= '</tbody>
	</table>
	<div id="total">
		<b>Total:</b> <span class="pay">$ 1223</span>
	</div>';
	echo $cartHTML;
?>
</div>
<?php endwhile;?>