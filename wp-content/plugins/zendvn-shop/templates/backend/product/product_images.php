<?php
global $zController;
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

?>
<div id="zendvn-sp-zsproduct-show-images">
	<div class="content-img">
		<img
			src="http://zshopping.xyz/wp-content/uploads/2020/12/baby-28-150x150.jpg"
			height="100" width="100">
		<div>
			<a class="remove-img">Remove</a>
		</div>
		<div class="div-ordering">
			<input value="1" class="ordering"
                name="zendvn-sp-zsproduct-img-ordering[]" type="text"> 
            <input
				name="zendvn-sp-zsproduct-img-url[]"
				value="http://zshopping.xyz/wp-content/uploads/2020/12/baby-28-150x150.jpg"
				type="hidden">
		</div>
	</div>
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
