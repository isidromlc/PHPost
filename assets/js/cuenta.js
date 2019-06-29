$(document).ready(function(){
	$('textarea.imagen-desc').on('focus', function(){ if ($(this).html() == 'Descripcion de la foto') $(this).html(''); });
	/*$('input[name=ciudad]').autocomplete('/registro-geo.php', {
		minChars: 2,
		width: 298
	}).result(function(event, data, formatted){
		cuenta.ciudad_id = (data) ? data[1] : '';
		cuenta.ciudad_text = (data) ? data[0] : '';
	});*/
	//cuenta.chgprovincia(true);
	if (typeof $.browser.msie != 'undefined' && $.browser.version == '6.0') $('li.local-file > div.mini-modal').html('<div class="dialog-m"></div><span>Esta funciÃ³n no es compatible con su navegador</span>');

});

function input_fake(x) {
	$('.input-hide-'+x).hide();
	$('.input-hidden-'+x).show().focus();
}

function desactivate(few) {
	if(!few){
            mydialog.show();
			
            mydialog.title('Desactivar Cuenta');
			
            mydialog.body('&#191;Seguro que quiere desativar su cuenta?');
			
            mydialog.buttons(true, true, 'Desactivar', 'desactivate(true)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
			
		var pass = $('#passi');
        
            $('#loading').fadeIn(250); 
			
           $.post(global_data.url + '/cuenta.php?action=desactivate', 'validar=' + 'ajaxcontinue', function(a){
		   
           mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), (a.charAt(0) == '0' ? 'No se pudo desactivar' : 'Cuenta desactivada'), true);
		   
           mydialog.center();
           
           $('#loading').fadeOut(250); 
		   
      });
     }
   }

var cuenta = {
	ciudad_id: '',
	ciudad_text: '',
	no_requerido: new Array(),

	alert: function (secc, title, body) {
		$('div.alert-cuenta.cuenta-'+secc).html('<h2>'+title+'</h2>');
		$('div.alert-cuenta.cuenta-'+secc).slideDown(100);
	},

	alert_close: function (secc) {
		$('div.alert-cuenta.cuenta-'+secc).html('');
		$('div.alert-cuenta.cuenta-'+secc).slideUp(100);
	},

	chgtab: function (obj) {
		$('div.tabbed-d > div.floatL > ul.menu-tab > li.active').removeClass('active');
		$(obj).parent().addClass('active');
		var active = $(obj).html().toLowerCase().replace(' ', '-');
		$('div.content-tabs').hide();
		$('div.content-tabs.'+active).show();
	},

	chgsec: function (obj) {
		$('div.content-tabs.perfil > h3').removeClass('active');
		$('div.content-tabs.perfil > fieldset').slideUp(100);
		if ($(obj).next().css('display') == 'none') {
			$(obj).addClass('active');
			$(obj).next().slideDown(100).addClass('active');
		}
	},

	chgpais: function(){
		var pais = $('form[name=editarcuenta] select[name=pais]').val();
		var el_estado = $('form[name=editarcuenta] .content-tabs.cuenta select[name=estado]');

		//No se selecciono ningun pais.
		if(empty(pais)){
			$('form[name=editarcuenta] select[name=estado]').addClass('disabled').attr('disabled', 'disabled').val('');
		}else{
			//Obtengo las estados
			$(el_estado).html('');
            $('#loading').fadeIn(250); 
			$.ajax({
				type: 'GET',
				url: global_data.url + '/registro-geo.php',
				data: 'pais_code=' + pais,
				success: function(h){
					switch(h.charAt(0)){
						case '0': //Error
							break;
						case '1': //OK
							cuenta.no_requerido['estado'] = false;
							$(el_estado).append(h.substring(3)).removeAttr('disabled').val('').focus();
							break;
					}
                    $('#loading').fadeOut(250); 
				},
				error: function(){

				}
			});
		}
	},
	

	error: function(obj, str){
		var container = $(obj).next();
		if($(container).hasClass('errorstr')){
			$(container).show();
			$(container).html(str);
		}
	},

	next: function (isprofile) {
		if (typeof isprofile == 'undefined') var isprofile = false;
		if (isprofile) $('div.content-tabs.perfil > h3.active').next().next().click();
		else $('div.tabbed-d > div.floatL > ul.menu-tab > li.active').next().children().click();
	},

	save: function (secc, next) {

		$('.ac_input, .cuenta-save-'+secc).removeClass('input-incorrect');

		if (typeof next == 'undefined') var next = false;
		params = Array();
		params.push('save='+secc);

		$('.cuenta-save-'+secc).each(function(){
			if (($(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio') || $(this).prop('checked')) params.push($(this).attr('name')+'='+encodeURIComponent($(this).val()));
		});

		var cuenta_url = global_data.url + '/cuenta.php?action=save&ajax=true';

        $('#loading').slideDown(250); 
		$.ajax({
			type: 'post', 
			url: cuenta_url, 
			data: params.join('&'), 
			dataType: 'json',
			success: function (r) {
				//$('#prueba').html(r.html);
				if (r.error) {
					if (r.field) $('input[name='+r.field+']').focus().addClass('input-incorrect');
					cuenta.alert(secc, r.error)
				}
				else {
					if (next) cuenta.next(secc > 1 && secc < 5);
					cuenta.alert(secc, 'Los cambios fueron aceptados y ser&aacute;n aplicados.');
					if(r.porc != null) {
						$('#porc-completado-label').html('Perfil completo al ' + r.porc + '%');
						$('#porc-completado-barra').css('width', r.porc + '%');
					}
				}
				window.location.hash = 'alert-cuenta';
                $('#loading').slideUp(250); 
			}
		});
	},

	imagen: {

		add: function (obj) {
			var url = $(obj).prev().prev(), caption = $(obj).prev();
			$(url).removeClass('input-incorrect');
			$(caption).removeClass('input-incorrect');
            $('#loading').fadeIn(250); 
			$.ajax({
				type: 'post', url: global_data.url + '/cuenta.php?ajax=1&action=add', data: 'url='+$(url).val()+'&caption='+$(caption).val(), dataType: 'json',
				success: function (r) {
					if (r.error) {
						if (r.field) $(eval(r.field)).focus().addClass('input-incorrect');
						else {
							cuenta.alert(7, r.error);
							window.location.hash = 'alert-cuenta';
						}
					}
					else if (typeof r.id != 'undefined') {
						$(obj).attr('onclick', '');
						$(obj).off('click').on('click', function(){ cuenta.imagen.del(this, r.id); });
						$(obj).removeClass('misfotos-add').addClass('misfotos-del').html('Eliminar');
						$(url).parent().prepend('<div class="floatL"><img src="'+$(url).val()+'" class="imagen-preview" /></div>')
						$('<div class="field"><label>Imagen</label><div class="input-fake"><input value="http://" type="text" class="text" /><textarea style="margin-top:10px">Descripcion de la foto</textarea><a onclick="cuenta.imagen.add(this)" class="misfotos-add floatL">Agregar</a></div></div>').appendTo('.content-tabs.mis-fotos > fieldset');
					}
                    $('#loading').fadeOut(250); 
				}
			});
		},

		del: function (obj, id) {
			var container = $(obj).parent().parent();
            $('#loading').fadeIn(250); 
			$.ajax({
				type: 'post', url: global_data.url + '/cuenta.php?ajax=1&action=del', data: 'id='+id, dataType: 'json',
				success: function (r) { $(container).slideUp(100, function(){ $(container).remove(); cuenta.alert_close(7); }); $('#loading').fadeOut(250);  }
			});
		}

	}

}

var avatar = {

	uid: false,
	key: false,
    ext: false,
	crop_coord: false,
	current: false,
	success: false,

	edit: function (obj) {
		if ($(obj).html() == 'Editar') {
			$('.change-avatar').slideDown(100);
			$(obj).html('Cancelar');
		}
		else {
			$('div.sidebar-tabs > div.webcam-capture, div.mini-modal').hide();
			$('div.sidebar-tabs > img:first, div.avatar-big-cont').show();
			$('ul.change-avatar > li').removeClass('active');
			$('.change-avatar').slideUp(100);
			$(obj).html('Editar');
		}
	},
	chgtab: function (obj) {
		var container = $(obj).parent().parent();
		var close = container.hasClass('active');
		$('ul.change-avatar > li').removeClass('active');
		$('div.sidebar-tabs > div.webcam-capture, div.mini-modal').hide();
		$('div.sidebar-tabs > div.avatar-big-cont').show();
		if (!close) {
			container.addClass('active');
			if (container.hasClass('webcam-file')) {
				$('div.sidebar-tabs > div.avatar-big-cont').hide();
				$('div.sidebar-tabs > div.webcam-capture').show();
			}
			else $(obj).parent().next().show();
		}
	},
	upload: function (obj) {
		if ($(obj).hasClass("local")) {
			if ($('input#file-avatar').val()) {
				if(isImageFile($('input#file-avatar').val())){
				    $('div.avatar-loading').show();
				    $.ajaxFileUpload({ url: global_data.url + '/upload-avatar.php', fileElementId: 'file-avatar', dataType: 'json', success: this.uploadsuccess });
				} else alert('El archivo no es una imagen válida.');
			}
			else alert('No selecciono ningun archivo');
		} else if($(obj).hasClass("url")) {
            var url_file = $('input#url-avatar').val();  
            if(url_file && isImageFile(url_file)){
                $('div.avatar-loading').show();
                $(obj).attr('disabled', 'true');
    			$.ajax({type: 'post', url: global_data.url + '/upload-avatar.php', data: 'url='+url_file, dataType: 'json', success: this.uploadsuccess, complete: function() {$(obj).attr('disabled', 'true');} });
            } else alert('El archivo no es una imagen válida.');
		}
		return false;
	},
	uploadsuccess: function (r) {
		$('div.avatar-loading').hide();
		if (r.error == 'success') {
			avatar.success = true;
			avatar.close();
		}
		else if (r.msg) {
            avatar.key = r.key;
            avatar.ext = r.ext;
            avatar.crop(r.msg); 
		}
		else alert(r);
	},
	crop: function (img) {
		mydialog.show();
		$('#modalBody').css('padding', 0);
		mydialog.title('Cortar avatar');
		mydialog.body('<img class="avatar-crop" src="'+img+'?'+Math.random()+'" onload="mydialog.center()">');
		mydialog.buttons(true, true, 'Guardar', 'avatar.save()', true, false, true, 'Cancelar', 'avatar.close()', true, true);
		$('img.avatar-big').attr('src', img+'?'+Math.random()).on('load', function(){ $('img.avatar-crop').Jcrop({ aspectRatio: 1, sideHandles: false, setSelect: [ 0, 0, 120, 120 ], onChange: avatar.preview, onSelect: function(c) { avatar.crop_coord = c; } }) });
	},
	reload: function () {
		$('.avatar-big').attr('src', this.current+'?'+Math.random()).css({ margin: 0, width: '120px', height: '120px' });
	},
	close: function () {
        mydialog.body('');
		mydialog.close();
		$('a.edit').click();
		if (avatar.success) {
			avatar.success = false;
            var img_url = global_data.url + '/files/avatar/' + avatar.uid + '_120.jpg?reload=true';
            $('#avatar-img').attr({'src': img_url}).fadeIn();
            $('div.avatar-loading').hide();
		}
	},
	preview: function (coords) {
		avatar.crop_coord = coords;
		var rx = 120 / coords.w;
		var ry = 120 / coords.h;
		$('.avatar-big').css({
			width: Math.round(rx * $('img.avatar-crop').width()) + 'px',
			height: Math.round(ry * $('img.avatar-crop').height()) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
	},

	save: function () {
		if (!this.crop_coord) alert('Debes seleccionar una parte de la foto');
		else {
            $('div.avatar-loading').show();
            $('#avatar-img').attr({'style' : 'display:none'});
            $('#loading').fadeIn(250); 
			$.ajax({
				type: 'post', 
                url: global_data.url + '/upload-crop.php', 
                data: 'key='+this.key+'&ext=' + this.ext + '&x='+this.crop_coord.x+'&y='+this.crop_coord.y+'&w='+this.crop_coord.w+'&h='+this.crop_coord.h, 
                dataType: 'json',
				success: function (r) {
            		if (r.error == 'success') {
            			avatar.success = true;
            			avatar.close();
            		}
            		else alert(r.error);
                    
                    $('#loading').fadeOut(250); 
				}
			});
		}
	}
}
/*
	isImageFile(filename)
*/
function isImageFile(filename){
	var ext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename.toLowerCase()) : '';
	if(ext && /^(jpg|png|jpeg|gif)$/.test(ext)) return true;
	else return false;
}
jQuery.extend({

	createUploadIframe: function(id, uri) {
		var frameId = 'jUploadFrame' + id;
		if(window.ActiveXObject) {
			var io = document.createElement('<iframe id="' + frameId + '" name="' + frameId + '" />');
			if(typeof uri== 'boolean') io.src = 'javascript:false';
			else if(typeof uri== 'string') io.src = uri;
		}
		else {
			var io = document.createElement('iframe');
			$(io).attr({ id: frameId, name: frameId })
		}
		$(io).css({ position: 'absolute', top: '-1000px', left: '-1000px' });
		document.body.appendChild(io);
		return io
	},

	createUploadForm: function(id, fileElementId) {
		var formId = 'jUploadForm' + id;
		var fileId = 'jUploadFile' + id;
		var form = $('<form	action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');
		var oldElement = $('#' + fileElementId);
		var newElement = $(oldElement).clone();
		$(oldElement).attr('id', fileId);
		$(oldElement).before(newElement);
		$(oldElement).appendTo(form);
		$(form).css({ position: 'absolute', top: '-1200px', left: '-1200px' });
		$(form).appendTo('body');
		return form;
	},

	ajaxFileUpload: function(s) {
		s = jQuery.extend({}, jQuery.ajaxSettings, s);
		var id = new Date().getTime();
		var form = jQuery.createUploadForm(id, s.fileElementId);
		var io = jQuery.createUploadIframe(id, s.secureuri);
		var frameId = 'jUploadFrame' + id;
		var formId = 'jUploadForm' + id;
		if (s.global && !jQuery.active++) jQuery.event.trigger('ajaxStart');
		var requestDone = false;
		var xml = {}	 
		if (s.global) jQuery.event.trigger('ajaxSend', [xml, s]);
		var uploadCallback = function(isTimeout) {
			var io = document.getElementById(frameId);
			try{
				if (io.contentWindow) {
					xml.responseText = io.contentWindow.document.body ? io.contentWindow.document.body.innerHTML : null;
					xml.responseXML = io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;
				}
				else if (io.contentDocument) {
					xml.responseText = io.contentDocument.document.body?io.contentDocument.document.body.innerHTML:null;
					xml.responseXML = io.contentDocument.document.XMLDocument?io.contentDocument.document.XMLDocument:io.contentDocument.document;
				}
			} catch(e) { jQuery.handleError(s, xml, null, e); }
			if (xml || isTimeout == 'timeout') {
				requestDone = true;
				var status;
				try {
					status = isTimeout != 'timeout' ? 'success' : 'error';
					if (status != 'error') {
						var data = jQuery.uploadHttpData(xml, s.dataType);	
						if (s.success) s.success(data, status);
						if (s.global) jQuery.event.trigger('ajaxSuccess', [xml, s]);
					}
					else jQuery.handleError(s, xml, status);
				} catch(e)	{ status = 'error'; jQuery.handleError(s, xml, status, e); }
				if (s.global) jQuery.event.trigger('ajaxComplete', [xml, s]);
				if (s.global && !--jQuery.active) jQuery.event.trigger('ajaxStop');
				if (s.complete) s.complete(xml, status);
				jQuery(io).off();
				setTimeout(function() { try { $(io).remove(); $(form).remove(); } catch(e) { jQuery.handleError(s, xml, null, e); } }, 100);
				xml = null;
			}
		}
		if (s.timeout > 0) setTimeout(function(){ if(!requestDone) uploadCallback('timeout'); }, s.timeout);
		try{
			var form = $('#'+formId);
			$(form).attr({ action: s.url, method: 'post', target: frameId });
			if(form.encoding) form.encoding = 'multipart/form-data';
			else form.enctype = 'multipart/form-data';
			$(form).submit();
		} catch(e) { jQuery.handleError(s, xml, null, e); }
		if ($.browser.opera) document.getElementById(frameId).onload = uploadCallback;
		else {
			if (window.attachEvent) document.getElementById(frameId).attachEvent('onload', uploadCallback);
			else document.getElementById(frameId).addEventListener('load', uploadCallback, false);
		}
		return {abort: function () {}};	
	},

	uploadHttpData: function(r, type) {
		var data = !type;
		data = type == 'xml' || data ? r.responseXML : r.responseText;
		if (type == 'script') jQuery.globalEval(data);
		if (type == 'json') eval('data ='+data);
		return data;
	}

});


