<?php 
    $args = array(
				'hide_empty' 		=> false,
				'number' 			=> 8,
				'orderby' 			=>'id',
				'order' 			=> 'DESC',
				'hierarchical'		=> false
			);

    $zs_category = get_terms('zs_category', $args);
?>
<div id="normal-sortables" class="meta-box-sortables ui-sortable">
    <div id="dashboard_right_now" class="postbox ">
        <div class="postbox-header">
            <h2 class="hndle ui-sortable-handle"><?php echo __('Latest Categories')?></h2>
            <div class="handle-actions hide-if-no-js"><button type="button" class="handle-order-higher" aria-disabled="true" aria-describedby="dashboard_right_now-handle-order-higher-description"><span class="screen-reader-text">Move up</span><span class="order-higher-indicator" aria-hidden="true"></span></button><span class="hidden" id="dashboard_right_now-handle-order-higher-description">Move At a Glance box up</span><button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="dashboard_right_now-handle-order-lower-description"><span class="screen-reader-text">Move down</span><span class="order-lower-indicator" aria-hidden="true"></span></button><span class="hidden" id="dashboard_right_now-handle-order-lower-description">Move At a Glance box down</span><button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: At a Glance</span><span class="toggle-indicator" aria-hidden="true"></span></button></div>
        </div>
        <div class="inside">
            <div class="main">
                <ul>
                    <?php 
						 $i = 1;
							if(count($zs_category)>0){
								foreach ($zs_category as $key => $val){
									$link = 'edit-tags.php?action=edit&taxonomy=zs_category
												&tag_ID=' . $val->term_id . '&post_type=zsproduct';
									echo '<li class=""><a href="' . $link . '">' 
										 . $i . ' - ' . $val->name . '</a></li>';
						
									$i++;
								}
							}
					?>
                </ul>
				<p id="wp-version-message">
					<span id="wp-version">View all products <a href="edit-tags.php?taxonomy=zs_category&post_type=zsproduct">click here</a>.
					</span>
				</p>
            </div>
        </div>
    </div>
</div>