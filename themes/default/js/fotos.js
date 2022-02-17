/* FOTOS */
function ControlLargo(obj) {
    if (obj.value.length > 1500) {
        obj.value = obj.value.substr(0,1500);
        showError(obj, 'La descripci&oacute;n no debe exeder los 500 caracteres.');
    } else hideError(obj);
}
function countUpperCase(string) {
	var len = string.length, strip = string.replace(/([A-Z])+/g, '').length, strip2 = string.replace(/([a-zA-Z])+/g, '').length, percent = (len  - strip) / (len - strip2) * 100;
	return percent;
}
function showError(obj, str) {
	$(obj).parent('li').addClass('error').children('span.errormsg').html(str).show(); // TODO QUE ONDA
	$.scrollTo($(obj).parent('li'), 500);
}
//
function hideError(obj) {
	$(obj).parent('li').removeClass('error').children('span.errormsg').html('').hide();
}
var fotos = {
    validaUrl: function(obj, url){
      var regex = /^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,3}|info|mobi|aero|asia|name)(:\d{2,5})?(\/)?((\/).+)?$/i;
      var ext = url.substr(-3);
      // URL VALIDA
      if(regex.test(url) == false){
        showError(obj, 'No es una direcci&oacute;n v&aacute;lida');
        return false;
      } else if(ext != 'gif' && ext != 'png' && ext != 'jpg'){
        showError(obj, 'S&oacute;lo se permiten im&aacute;genes .gif, .png y .jpg');
        return false; 
      } else return true;
    },
    agregar: function(){
        var error = false;
        $('.required').each(function(){
        	if (!$.trim($(this).val())) {
        		showError(this, 'Este campo es obligatorio');
        		$(this).parent('li').addClass('error');
        		error = true;
        		return false;
        	} else if($(this).attr('name') == 'url'){
        	   var rimg = fotos.validaUrl(this, $(this).val());
                if(rimg != true) {
                    error = true;
                    return false;
                } else error = false;
        	}
        });
        //
        if (error) {
			return false;
		} 
        //
        if ($('textarea[name=desc]').val().length > 1500) {
			showError($('textarea[name=desc]').get(0), 'La descripci&oacute;n no debe exeder los 1500 caracteres.');
			return false;
		}
        // ENVIAMOS
        $('.fade_out').fadeOut("slow",function(){
            $('.loader').fadeIn();  
        })
        //
        $('form[name=add_foto]').submit();
    },
    comentar: function(){
        // EVITAR FLOOD
        $('#btnComment').attr({'disabled':'disabled'});
        //
        // CHECAMOS....
        var textarea = $('#mensaje');
    	var text = textarea.val();
    	if(text == '' || text == textarea.attr('title')){
    		textarea.focus();
            $('#btnComment').attr({'disabled':''});
    		return;
    	}else if(text.length > 1000){
    		alert("Tu comentario no puede ser mayor a 1000 caracteres.");
    		textarea.focus();
            $('#btnComment').attr({'disabled':''});
    		return;
    	}
        // ENVIAMOS
        var auser = $('input[name=auser_post]').val();
        $('#loading').fadeIn(250); 
       	$.ajax({
    		type: 'POST',
    		url: global_data.url + '/comentario-agregar.php?ts=true&do=fotos',
    		data: 'comentario=' + encodeURIComponent(text) + '&fotoid=' + gget('fotoid') + '&auser=' + auser,
    		success: function(h){
    			switch(h.charAt(0)){
    				case '0': //Error
    					$('.form .error').html(h.substring(3)).show('slow');
                        $('#btnComment').attr({'disabled':''});
    					break;
    				case '1': //OK
    						$('#no-comments').hide();
    						$('#mensajes').append(h.substring(3));
                            $('.form').html('<div class="emptyData">Tu comentario fue agregado correctamente :)</div>');
    						// SUMAMOS
    						var ncomments = parseInt($('#ncomments').text());
    						$('#ncomments').text(ncomments + 1);
                            $('#btnComment').attr({'disabled':''});
                            // NO HAY COMMENTS REMOVE
                            $('.noComments').remove();
    					break;
    			}
                $('#loading').fadeOut(250); 
    		}
      });
        
    },
    // VOTAR FOTO
    votar: function(voto){
        // FIX
        voto = (voto == 'pos') ? 'pos' : 'neg';
        // VARS
    	var total_votos = parseInt($('#votos_total_' + voto).text());
        total_votos = (isNaN(total_votos)) ? 0 : total_votos;
        //
        $('#loading').fadeIn(250); 
    	$.ajax({
    		type: 'POST',
    		url: global_data.url + '/comentario-votar.php?do=fotos',
    		data: 'voto=' + voto + '&fotoid=' + gget('fotoid'),
    		success: function(h){
    			switch(h.charAt(0)){
    				case '0': //Error
                        mydialog.alert('Votar Foto', h.substring(3));
    					break;
    				case '1': //OK
    					total_votos = total_votos + 1;
                        //
    					$('#actions').html(h.substring(3)).fadeIn("fast");
    					$('#votos_total_' + voto).text(total_votos);
    					//
    					break;
    			}
                $('#loading').fadeOut(250); 
    		}
        });
    },
    // BORRAR COMENTARIO/ FOTO
    borrar:function(id, type){
        //
        var txt_type = (type == 'com') ? 'comentario' : 'foto';
        var txt_aux = (type == 'com') ? 'este ' : 'esta ';
        //
        mydialog.mask_close = false;
        mydialog.show(true);
		mydialog.title('Eliminar ' + txt_type);
		mydialog.body('¿Seguro que quieres eliminar ' + txt_aux + txt_type);
		mydialog.buttons(true, true, 'Eliminar ' + txt_type, 'fotos.del_' + txt_type + '(' + id + ')', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
    },
    // ELIMINAR COMENTARIO
    del_comentario: function(cid){
        $('#loading').fadeIn(250); 
    	$.ajax({
    		type: 'POST',
    		url: global_data.url + '/comentario-borrar.php?do=fotos',
    		data: 'cid=' + cid,
    		success: function(h){
    			switch(h.charAt(0)){
    				case '0': //Error
                        mydialog.alert('Error:', h.substring(3));
    					break;
    				case '1': //OK
						var ncomments = parseInt($('#ncomments').text());
						$('#ncomments').text(ncomments - 1);
                        //
						$('#div_cmnt_' + cid).slideUp( 1500, 'easeInOutElastic');
						$('#div_cmnt_' + cid).remove();
    					//
                        mydialog.close();
                        //
    					break;
    			}
                $('#loading').fadeOut(250); 
    		}
        });
    },
    // ELIMINAR FOTO
    del_foto: function(fid){
        $('#loading').fadeIn(250); 
    	$.ajax({
    		type: 'POST',
    		url: global_data.url + '/fotos/borrar.php',
    		data: 'fid=' + fid,
    		success: function(h){
    			switch(h.charAt(0)){
    				case '0': //Error
                        mydialog.alert('Error:', h.substring(3));
    					break;
    				case '1': //OK
                        mydialog.close();
                        location.href = global_data.url + '/fotos/';
                        //
    					break;
    			}
                $('#loading').fadeOut(250); 
    		}
        });
    }

}

$(function(){
    
    // WIDTH TOOLS
    var twidth = 0;
    var tleft = 3;
    $('#imagen').hover(function(){
        if(twidth <= 0){
            twidth = $('#imagen .img').css("width");
            twidth = twidth.substring(-2);
            twidth = parseInt(twidth) - 6;
            tleft = ((568 - twidth) / 2);
            $('.tools').css({"width": twidth + 'px', "left": tleft + 'px'})
        }
    });
    // AUTOGROW
    $('.autorow').css('max-height', '140px');
	// QUITAR LOS ERRORES
	$('.required').on('keyup change',function(){
		if ($.trim($(this).val())) {
			hideError(this);
		}
	});
	// CHECAR EL TITULO
	$('input[name=titulo]').on('keyup',function(){
		if ($(this).val().length >= 5 && countUpperCase($(this).val()) > 90) {
			showError(this, 'El t&iacute;tulo no debe estar en may&uacute;sculas');
		}
		else {
			hideError(this);
		}
	});
});