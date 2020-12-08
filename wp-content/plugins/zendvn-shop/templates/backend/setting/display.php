<?php
    $lbl = __('ZShopping Settings');
    
    $option_name = 'zendvn_sp_setting';

	//========================================
	//TẠO CÁC PHẦN TỬ INPUT
	//========================================
	$htmlObj = new ZendvnHtml();
	
	//Tao phan tu chua productNumber
	$inputID 	= $option_name . '_product_number';
	$inputName 	= $option_name . '[product_number]';
	$inputValue = $data['product_number'];
	$arr 		= array('size' =>'5','id' => $inputID);
	$productNumber	= $htmlObj->textbox($inputName,$inputValue,$arr);
?>
<div class="wrap">
	<h2>
		<?php echo $lbl;?>
	</h2>

    <form method="post" action="" id="<?php echo $option_name;?>" name="<?php echo $option_name;?>"enctype="multipart/form-data">
		<!--Show product in FrontEnd -->
		<h3 class="title">
			<?php echo __('Show product in FrontEnd')?>
        </h3>
		<div class="zendvn-sp-form-table">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('Products in a page')?> : </label>
					</th>
					<td><?php echo $productNumber;?></td>
				</tr>				
			</tbody>
		</table>
		</div>
	</form>
</div>