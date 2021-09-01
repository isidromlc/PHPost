/*
    PERFIL
*/
var portal = {
    cache: {},
    load_tab:function(type, obj){
        // CSS
        $('#tabs_menu > li').removeClass('selected');
        $(obj).parent().addClass('selected');
        if(type == 'news') $('#portal_content').css('background-color', '#FFF');
        else $('#portal_content').css('background-color', '#F9F9F9');
        //
        $('#portal_content > div.showHide').hide();
        // CARGAMOS
        var status = $('#portal_' + type).attr('status');
        if(status == 'activo') {
            $('#portal_' + type).show();
        } else {
            $('#portal_' + type).show();
            portal.posts_page(type, 1, false);
        }
    },
    // CARGAR CONTENIDO
    save_configs: function(){
		var inputs = $('#config_inputs :input');
        var cat_ids = '';        
		inputs.each(function(){
            if($(this).attr('checked')) cat_ids += $(this).val() + ',';
		});
        //
        $('#loading').fadeIn(250);
        $.ajax({
        	type: 'POST',
        	url: global_data.url + '/portal-posts_config.php',
        	data: 'cids=' + cat_ids,
        	success: function(h){
        		switch(h.charAt(0)){
        			case '0': //Error
                        mydialog.alert('Error', h.substring(3));
        				break;
        			case '1': //OK
                        $('#config_posts').slideUp();
                        portal.posts_page('posts',1, false);
        				break;
        		}
                $('#loading').fadeOut(350);
        	}
        });                
    },
    // PAGINAS PARA LOS ULTIMOS POSTS
    posts_page: function(type, page, scroll){
        $('#portal_' + type + '_content').html('<center><img src="' + global_data.img + '/images/fb-loading.gif" /></center>');
        //
  		if(scroll == true) $.scrollTo('#cuerpocontainer', 250);
        if(typeof portal.cache[type + '_' + page] == 'undefined'){
            $('#loading').fadeIn(250);
    		$.ajax({
    			type: 'GET',
    			url: global_data.url + '/portal-' + type + '_pages.php?page=' + page,
    			success: function(h){
    			    // CACHE
                    portal.cache[type + '_' + page] = h;
                    $('#portal_' + type).attr('status', 'activo');
                    // CARGAMOS
   				    $('#portal_' + type + '_content').html(h);
                    // OCULTAMOS MENSAJE CARGA
                    $('#loading').fadeOut(350);
    			}
    		});
        } else {
            $('#portal_' + type + '_content').html(portal.cache[type + '_' + page]);
        }
    }
}

/** READY **/
$(function(){
    
});