<script type="text/javascript">
//
var button_title = '     {if $tsDraft}Aplicar Cambios{else}Agregar post{/if}     ';
// {literal}
function countUpperCase(string) {
	var len = string.length, strip = string.replace(/([A-Z])+/g, '').length, strip2 = string.replace(/([a-zA-Z])+/g, '').length, percent = (len  - strip) / (len - strip2) * 100;
	return percent;
}
//
function showError(obj, str) {
	if (obj.tagName.toLowerCase() == 'textarea') {
		obj = $(obj).parent().parent();
	}
	$(obj).parent('li').addClass('error').children('span.errormsg').html(str).show(); // TODO QUE ONDA
	$.scrollTo($(obj).parent('li'), 500);
}
//
function hideError(obj) {
	if (obj.tagName.toLowerCase() == 'textarea') {
		obj = $(obj).parent().parent();
	}
	$(obj).parent('li').removeClass('error').children('span.errormsg').html('').hide();
}
//
function save_borrador(){
	var params = 'titulo=' + encodeURIComponent($('input[name="titulo"]').val()) + '&cuerpo=' + encodeURIComponent($('textarea[name="cuerpo"]').val()) + '&tags=' + encodeURIComponent($('input[name="tags"]').val()) + '&categoria=' + encodeURIComponent($('select[name="categoria"]').val());
	params += $('input[name="privado"]').is(':checked') ? '&privado=1' : '';
	params += $('input[name="sin_comentarios"]').is(':checked') ? '&sin_comentarios=1' : '';
	params += $('input[name="patrocinado"]').is(':checked') ? '&patrocinado=1' : '';
	params += $('input[name="sticky"]').is(':checked') ? '&sticky=1' : '';
	$('div#borrador-guardado').html('Guardando...');

	borrador_setTimeout = setTimeout('borrador_save_enabled()', 60000);
	borrador_save_disabled();

	//Actualizo el borrador id
	if(!empty($('input[name="borrador_id"]').val())){
		$.ajax({
			type: 'POST',
			url: global_data.url + '/borradores-guardar.php',
			data: params + '&borrador_id=' + encodeURIComponent($('input[name="borrador_id"]').val()),
			success: function(h){
				switch(h.charAt(0)){
					case '0': //Error
						clearTimeout(borrador_setTimeout);
						borrador_setTimeout = setTimeout('borrador_save_enabled()', 5000);
						borrador_ult_guardado = h.substring(3);
						$('div#borrador-guardado').html(borrador_ult_guardado);
						break;
					case '1': //Guardado
						var currentTime = new Date();
						borrador_ult_guardado = 'Guardado a las ' + currentTime.getHours() + ':' + currentTime.getMinutes() + ':' + currentTime.getSeconds() + ' hs.';
						$('div#borrador-guardado').html(borrador_ult_guardado);
				}
			},
			error: function(){
				mydialog.error_500('save_borrador()');
			}
		});
	}else{
		$.ajax({
			type: 'POST',
			url: global_data.url + '/borradores-agregar.php',
			data: params,
			success: function(h){
				switch(h.charAt(0)){
					case '0': //Error
						clearTimeout(borrador_setTimeout);
						borrador_setTimeout = setTimeout('borrador_save_enabled()', 5000);
						borrador_ult_guardado = h.substring(3);
						$('div#borrador-guardado').html(borrador_ult_guardado);
						break;
					case '1': //Creado
						$('input[name="borrador_id"]').val(h.substring(3));
						var currentTime = new Date();
						borrador_ult_guardado = 'Guardado a las ' + currentTime.getHours() + ':' + currentTime.getMinutes() + ':' + currentTime.getSeconds() + ' hs.';
						$('div#borrador-guardado').html(borrador_ult_guardado);
				}
			},
			error: function(){
				mydialog.error_500('save_borrador()');
			}
		});
	}
}

var borrador_setTimeout;
var borrador_ult_guardado = '';
var borrador_is_enabled = true;

function borrador_save_enabled(){
	if($('input#borrador-save'))
		$('input#borrador-save').removeClass('disabled').removeAttr('disabled');
	borrador_is_enabled = true;
}
function borrador_save_disabled(){
	if($('input#borrador-save'))
		$('input#borrador-save').addClass('disabled').attr('disabled', 'disabled');
	borrador_is_enabled = false;
}
//
var confirm = true;
window.onbeforeunload = confirmleave;
function confirmleave() {
	if (confirm && ($('input[name=titulo]').val() || $('textarea[name=cuerpo]').val())) return "Este post no fue publicado y se perdera.";
}
//
var tags = false;
$(document).ready(function(){
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
    // NO REPOST
    $('input[name=titulo]').blur(function(){
        var q = $(this).val();
		$.ajax({
			type: 'post',
			url: global_data.url + '/posts-genbus.php?do=search',
			data: 'q=' + q,
			success: function(h) {
                $('#repost').html(h);
			}
		});
    });
    // GENERADOR DE TAGS
    $('input[name=tags]').click(function(){
        if(tags == true) return true;
        var q = $('input[name=titulo]').val();
		$.ajax({
			type: 'post',
			url: global_data.url + '/posts-genbus.php?do=generador',
			data: 'q=' + q,
			success: function(h) {
                $('input[name=tags]').val(h);
                tags = true;
			}
		});
    });
	// PREVIEW
	$('input[name=preview]').on('click',function(){
		var error = false;

    		$('.required').each(function(){
    			if (!$.trim($(this).val())) {
    				showError(this, 'Este campo es obligatorio');
    				$(this).parent('li').addClass('error');
    				error = true;
    				return false;
    			}
    		});

			if (error) {
				return false;
			}

			if ($('textarea[name=cuerpo]').val().length > 63206) {
				showError($('textarea[name=cuerpo]').get(0), 'El post es demasiado largo. No debe exceder los 65000 caracteres.');
				return false;
			}

			var tags = $('input[name=tags]').val().split(',');

			if (tags.length < 4) {
				showError($('input[name=tags]').get(0), 'Tienes que ingresar por lo menos 4 tags separados por coma.');
				return false;
			} else {
			     for(var i = 0; i < tags.length; i++){
			         if(tags[i] == '') {
			             showError($('input[name=tags]').get(0), 'Tienes que ingresar por lo menos 4 tags separados por coma.');
			             return false;
			         } else hideError($('input[name=tags]').get(0))
			     }
			}
			mydialog.class_aux = 'preview';
			mydialog.show(true);
			mydialog.title('...');
			mydialog.body('Cargando vista previa....<br><br><img src="' + global_data.url + '/themes/default/images/loading_bar.gif">');
            mydialog.center();
            // PREVIEW
			$.ajax({
				type: 'post',
				url: global_data.url + '/posts-preview.php?ts=true',
				data: 'titulo=' + encodeURIComponent($('input[name=titulo]').val()) + '&cuerpo=' + encodeURIComponent($('textarea[name=cuerpo]').val()),
				success: function(r) {
					mydialog.body(r);
					mydialog.buttons(true, true, button_title, 'postSave()', true, true, true, 'Cerrar previsualizaci&oacute;n', 'close', true, false);
					mydialog.center();

					$('#mydialog #buttons .mBtn.btnOk').removeClass('btnCancel').addClass('btnGreen');

					$.scrollTo(0, 500)

				}
			});

	});
    //
    $('a.consejos-view-more-button').on(
		'click',
		function () {
			$(this).hide();
			$('div.consejos-view-more').show();
		}
	);
});
//
function postSave() {
	confirm = false;
	$('form[name=newpost]').submit();
}
</script>
{/literal}