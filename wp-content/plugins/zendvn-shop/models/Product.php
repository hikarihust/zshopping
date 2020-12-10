<?php
class Zendvn_Sp_Product_Model{
	public function create() {
		$labels = array(
			'name' 				=> __('ZS Products'),
			'singular_name' 	=> __('ZS Product'),
			'menu_name'			=> __('ZS Product'),
			'name_admin_bar' 	=> __('ZS Product'),
			'add_new'			=> __('Add ZS Product'),
			'add_new_item'		=> __('Add New ZS Product'),
			'search_items' 		=> __('Search ZS Product'),
			'not_found'			=> __('No product found.'),
			'not_found_in_trash'=> __('No product found in Trash'),
			'view_item' 		=> __('View product'),
			'item_updated ' 	=> __('View product'),
			'edit_item'			=> __('Edit product'),
		);
		$args = array(
			'labels'               => $labels,
			'description'          => translate('Show product list'),
			'public'               => true,
			'hierarchical'         => true,
			'exclude_from_search'  => null, //public
			'publicly_queryable'   => null, //public
			'show_ui'              => null, //public
			'show_in_menu'         => null, 
			'show_in_nav_menus'    => true, //public
			'show_in_admin_bar'    => true, //public
			'menu_position'        => 5,
			//'menu_icon'            => ZENDVN_MP_IMAGES_URL . '/icon-setting16x16.png',
			'capability_type'      => 'post',
			// 'capabilities'         => array(),
			//'map_meta_cap'         => null,
			'supports'             => array('title' ,'editor','author','custom-fields' ,'comments', 'thumbnail'),
			//'register_meta_box_cb' => null,
			'taxonomies'           => array('zs_category'),
			'has_archive'          => true,
			'rewrite'              => array('slug'=>'zsproduct'),
			//'query_var'            => true,
			//'can_export'           => true,
			//'delete_with_user'     => null,
			//'_builtin'             => false,
			'_edit_link'           => 'post.php?&post_type=zsproduct&post=%d',
		);
		register_post_type('zsproduct',$args);
		// flush_rewrite_rules(false);
    }
    
	function zsproduct_updated_messages ( $messages ) {
		$preview_post_link_html   = '';
		$scheduled_post_link_html = '';
		$view_post_link_html      = '';
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );
		
		$permalink = get_permalink( $post->ID );
		if ( ! $permalink ) {
			$permalink = '';
		}

		$preview_url = get_preview_post_link( $post );
		$viewable = is_post_type_viewable( $post_type_object );
		if ( $viewable ) {
			// Preview post link.
			$preview_post_link_html = sprintf(
				' <a target="_blank" href="%1$s">%2$s</a>',
				esc_url( $preview_url ),
				__( 'Preview post' )
			);
			// Scheduled post preview link.
			$scheduled_post_link_html = sprintf(
				' <a target="_blank" href="%1$s">%2$s</a>',
				esc_url( $permalink ),
				__( 'Preview post' )
			);
			// View post link.
			$view_post_link_html = sprintf(
				' <a href="%1$s">%2$s</a>',
				esc_url( $permalink ),
				__( 'View product' )
			);
		}

		$scheduled_date = sprintf(
			/* translators: Publish box date string. 1: Date, 2: Time. */
			__( '%1$s at %2$s' ),
			/* translators: Publish box date format, see https://www.php.net/date */
			date_i18n( _x( 'M j, Y', 'publish box date format' ), strtotime( $post->post_date ) ),
			/* translators: Publish box time format, see https://www.php.net/date */
			date_i18n( _x( 'H:i', 'publish box time format' ), strtotime( $post->post_date ) )
		);
		
		$messages['zsproduct'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Product updated.' ) . $view_post_link_html,
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.'),
			4  => __( 'Product updated.' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Product restored to revision from %s.' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Product published.' ) . $view_post_link_html,
			7  => __( 'Product saved.' ),
			8  => __( 'Product saved.' ) . $preview_post_link_html,
			9  => sprintf( __( 'Post scheduled for: %s.' ), '<strong>' . $scheduled_date . '</strong>' ) . $scheduled_post_link_html,
			10 => __( 'Product draft updated.' ) . $preview_post_link_html,
		);

		return $messages;
	}

	function filter_bulk_zsproduct_updated_messages( $bulk_messages, $bulk_counts ) { 
		$bulk_messages['zsproduct']     = array(
			/* translators: %s: Number of pages. */
			'updated'   => _n( '%s product updated.', '%s products updated.', $bulk_counts['updated'] ),
			'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 product not updated, somebody is editing it.' ) :
							/* translators: %s: Number of products. */
							_n( '%s product not updated, somebody is editing it.', '%s products not updated, somebody is editing them.', $bulk_counts['locked'] ),
			/* translators: %s: Number of products. */
			'deleted'   => _n( '%s product permanently deleted.', '%s products permanently deleted.', $bulk_counts['deleted'] ),
			/* translators: %s: Number of products. */
			'trashed'   => _n( '%s product moved to the Trash.', '%s products moved to the Trash.', $bulk_counts['trashed'] ),
			/* translators: %s: Number of products. */
			'untrashed' => _n( '%s product restored from the Trash.', '%s products restored from the Trash.', $bulk_counts['untrashed'] ),
		);
		return $bulk_messages; 
	}
}