jQuery(function($){
	$(document).ready(function(){
        $('#zendvn-sp-zsproduct-button').click(open_media_window);
	
    });	
    
	function open_media_window(e){
        e.preventDefault();
		if(this.window === undefined){
			this.window = wp.media({
					title: 'Insert pictures for product',
					library: {type: 'image'},
					multiple: true,
					button: {text: 'Insert pictures'}			
				}).open();	
		}
	
		return false;
	}
});