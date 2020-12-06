<?php 
    global $zController;
    
	$msg = '';
	if(count($zController->_error) > 0){
		$msg .= '<div class="error"><ul>';		
		foreach ($zController->_error as $key => $val){
			$msg .= '<li>' . $val . '</li>';
		}
		$msg .= '</ul></div>';
    }
    
	$vName 		= sanitize_text_field($zController->_data['name']);
	$vSlug		= sanitize_title($zController->_data['slug']);
	$vStatus	= absint($zController->_data['status']);
    
	//Khoi tao doi tuong ZendvnHTML
	$htmlObj = new ZendvnHtml();
	
	//Lay gia trị tham so Page
	$page 	= $zController->getParams('page');
		
	$action = ($zController->getParams('action') != '')? $zController->getParams('action'):'add';
	
	$lbl 	= translate('Add new a Manufacturer');	
	
	$name 	= $htmlObj->textbox('name',@$vName,array('class'=>'regular-text'));
	
	$slug 	= $htmlObj->textbox('slug',@$vSlug,array('class'=>'regular-text'));
	
	$options['data'] = array('Inactive','Active');
	$status = $htmlObj->selectbox('status',@$vStatus,array('class'=>'regular-text'),$options);
	
?>
<div class="wrap">
    <h2><?php echo $lbl;?></h2>
    <?php echo $msg;?>
	<form method="post" action="" id="<?php echo $page;?>"
		enctype="multipart/form-data">
		<input name="action" value="<?php echo $action;?>" type="hidden">				
		<?php wp_nonce_field($action,'security_code',true);?>
		
		<h3>Information:</h3>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label><?php echo translate('Manufacturer name') . ':';?></label>
					</th>
					<td><?php echo $name;?></td>
                </tr>
				<tr>
					<th scope="row">
						<label><?php echo translate('Slug') . ':';?></label>
					</th>
					<td><?php echo $slug;?></td>
                </tr>
				<tr>
					<th scope="row"><label><?php echo translate('Status') . ':';?></label></th>
					<td><?php echo $status;?></td>
				</tr>
			</tbody>
		</table>
		
		<p class="submit">
			<input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
		</p>
	</form>
</div>
