<?php 
	$args = array(
				'post_type' 		=> 'zsproduct',
				'posts_per_page' 	=> 8,
				'orderby' 			=>'date',
				'order' 			=> 'DESC'
			);
	$the_query = new WP_Query($args);
?>
<div id="normal-sortables" class="meta-box-sortables ui-sortable">
    <div id="dashboard_right_now" class="postbox ">
        <div class="postbox-header">
            <h2 class="hndle ui-sortable-handle"><?php echo __('Latest Products')?></h2>
            <div class="handle-actions hide-if-no-js"><button type="button" class="handle-order-higher" aria-disabled="true" aria-describedby="dashboard_right_now-handle-order-higher-description"><span class="screen-reader-text">Move up</span><span class="order-higher-indicator" aria-hidden="true"></span></button><span class="hidden" id="dashboard_right_now-handle-order-higher-description">Move At a Glance box up</span><button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="dashboard_right_now-handle-order-lower-description"><span class="screen-reader-text">Move down</span><span class="order-lower-indicator" aria-hidden="true"></span></button><span class="hidden" id="dashboard_right_now-handle-order-lower-description">Move At a Glance box down</span><button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: At a Glance</span><span class="toggle-indicator" aria-hidden="true"></span></button></div>
        </div>
        <div class="inside">
            <div class="main">
                <ul>
                    <?php 
						$i = 1;
						if($the_query->have_posts()){
							while ($the_query->have_posts()){
								$the_query->the_post();
								$link = 'post.php?post_type=zsproduct&post=' . get_the_ID() . '&action=edit';
								echo '<li class="page-count"><a href="' . $link . '">' 
									 . $i . ' - ' . get_the_title() . '</a></li>';
								$i++;
							}//$the_query->have_posts()
						}
						wp_reset_postdata();
					?>
                </ul>
                <p id="wp-version-message"> 
                    <span id="wp-version">View all products <a href="edit.php?post_type=zsproduct">click here</a>.</span>
                </p>
            </div>
        </div>
    </div>
</div>