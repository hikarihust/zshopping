<?php
global $zController, $post;
$controller = $zController->_data['controller'];

$htmlObj = new ZendvnHtml();
//=====================================================
//Tao phan tu chua Button
//=====================================================
$inputID 	= $controller->create_id('button');
$inputName 	= $controller->create_id('button');
$inputValue = translate('Media Library Image');
$arr 		= array('class' =>'button-secondary','id' => $inputID);
$options	= array('type'=>'button');
echo $btnMedia	= $htmlObj->pTag($htmlObj->button($inputName,$inputValue,$arr,$options));
$arrOrdering = get_post_meta($post->ID, $controller->create_key('img-ordering'),true);
$arrPicture = get_post_meta($post->ID, $controller->create_key('img-url'),true);
?>
<div id="zendvn-sp-zsproduct-show-images">
<?php 
	if(count($arrPicture) > 0){
		for($i=0; $i<count($arrPicture); $i++){
			?>
	<div class="content-img">
		<img
			src="<?php echo $arrPicture[$i];?>"
			height="100" width="100">
		<div>
			<a class="remove-img">Remove</a>
		</div>
		<div class="div-ordering">
			<input value="<?php echo $arrOrdering[$i];?>" class="ordering"
                name="zendvn-sp-zsproduct-img-ordering[]" type="text"> 
            <input
				name="zendvn-sp-zsproduct-img-url[]"
				value="<?php echo $arrPicture[$i];?>"
				type="hidden">
		</div>
	</div>
	<?php 
		}
	}

	?>
	<div class="clr"></div>
</div>
<?php 

//=====================================================
//Tao phan tu chua rotate360
//=====================================================
$inputID 	= $controller->create_id('rotate360');
$inputName 	= $controller->create_id('rotate360');
$inputValue = get_post_meta($post->ID,$controller->create_key('rotate360'),true);
$arr 		= array('id' => $inputID,'rows'=>6, 'cols'=>60);
$html		= $htmlObj->label(translate('Rotate 360')) . '<br/>'
            . $htmlObj->textarea($inputName,$inputValue,$arr);
echo $htmlObj->pTag($html);
