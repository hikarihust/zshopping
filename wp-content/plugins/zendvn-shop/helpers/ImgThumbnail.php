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
				$image = wp_get_attachment_image_src($thumbnail_id,'single-post-thumbnail');
				if(!is_array($image)) {
					return $img;
				}else{
					$img = $this->resize($image[0],$options['width'],$options['height']);
				}
			}
		}
			
		return $img;
    }
    
    public function resize($imgURL =  null, $width = 0, $height = 0) {
		$tmp = explode('/wp-content/', $imgURL);
		$imgDir =ABSPATH . 'wp-content/' . $tmp[1];
				
        //Lay ra ten cua hinh anh hien thoi
        //http://zshopping.xyz/wp-content/uploads/2020/12/iPhone-6.jpg -> iPhone-6.jpg
		preg_match("/[^\/|\\\]+$/", $imgURL,$currentName);
		$currentName = $currentName[0];
		
		//Duong dan thu muc de luu hinh anh moi
		$storeFolder = ZENDVN_SP_PRODUCT_PATH . '/p' . $width .'x' . $height;
		if(!file_exists($storeFolder)){
			mkdir($storeFolder,0755); //CMOD
		}
		
		$newImgPath = $storeFolder . '/' . $currentName;
		if(!file_exists($newImgPath)){

		}
		$newImgUrl = ZENDVN_SP_PRODUCT_URL . '/p' . $width .'x' . $height . '/' . $currentName;
		
		return $newImgUrl;
    }
}