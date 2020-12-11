<?php
class Zendvn_Sp_ImgThumbnail_Helper{
	
	// $options['type']: original - thumbnail - resize
	// $options['width'] - $options['height']
	public function getImage($postID = 0, $options = array()){
		
		$img = ZENDVN_SP_PRODUCT_URL . '/default.jpg';
		if($postID > 0 ){
			$imgType 		= (!isset($options['type']))?'thumbnail':$options['type'];
			$thumbnail_id 	= get_post_thumbnail_id($postID);
			
			if($imgType == 'thumbnail' ){
				$image = wp_get_attachment_image_src($thumbnail_id);
				if(is_array($image)) $img = $image[0];
			}else if($imgType == 'original' ){
				$image = wp_get_attachment_image_src($thumbnail_id,'single-post-thumbnail');
				if(is_array($image)) $img = $image[0];
			}else if($imgType == 'resize' ){

			}
		}
			
		return $img;
	}
}