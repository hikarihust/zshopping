jQuery(document).ready(function($){
	var elemt = "#toplevel_page_zendvn-sp-manager";
	$(elemt).removeClass('wp-not-current-submenu')
			.addClass('wp-has-current-submenu wp-menu-open');
	$(elemt + ' > a').removeClass('wp-not-current-submenu')
			.addClass('wp-has-current-submenu wp-menu-open');
});

function getURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){
            return sParameterName[1];
        }
    }
}
