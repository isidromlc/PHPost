 var proc = Array();
if(!lang)
	var lang = Array();
/* Editor */
lang['Negrita'] = "Negrita";
lang['Cursiva'] = "Cursiva";
lang['Subrayado'] = "Subrayado";
lang['Alinear a la izquierda'] = "Alinear a la izquierda";
lang['Centrar'] = "Centrar";
lang['Alinear a la derecha'] = "Alinear a la derecha";
lang['Color'] = "Color";
lang['Rojo oscuro'] = "Rojo oscuro";
lang['Rojo'] = "Rojo";
lang['Naranja'] = "Naranja";
lang['Marron'] = "Marr&oacute;n";
lang['Amarillo'] = "Amarillo";
lang['Verde'] = "Verde";
lang['Oliva'] = "Oliva";
lang['Cyan'] = "Cyan";
lang['Azul'] = "Azul";
lang['Azul oscuro'] = "Azul oscuro";
lang['Indigo'] = "Indigo";
lang['Violeta'] = "Violeta";
lang['Negro'] = "Negro";
lang['Tamano'] = "Tama&ntilde;o";
lang['Miniatura'] = "Miniatura";
lang['Pequena'] = "Peque&ntilde;a";
lang['Normal'] = "Normal";
lang['Grande'] = "Grande";
lang['Enorme'] = "Enorme";
lang['Insertar video de YouTube'] = "Insertar video de YouTube";
lang['Insertar cancion de Goear'] = "Insertar canci&oacute;n de Goear";
lang['Insertar archivo SWF'] = "Insertar archivo SWF";
lang['Insertar Imagen'] = "Insertar Imagen";
lang['Insertar Link'] = "Insertar Link";
lang['Citar'] = "Citar";
lang['Spoiler'] = "Spoiler";
lang['Tu'] = "Nombre de Usuario";
lang['Upload'] = "Subir Im&aacute;genes";
lang['Ingrese la URL que desea postear'] = "Ingrese la URL que desea postear";
lang['Fuente'] = "Fuente";
lang['ingrese el id de yt'] = "Ingrese el ID del video de YouTube:\n\nEjemplo:\nSi la URL de su video es:\nhttp://www.youtube.com/watch?v=CACqDFLQIXI\nEl ID es: CACqDFLQIXI";
lang['ingrese el id de yt IE'] = "Ingrese el ID del video de YouTube:\nPor ejemplo: CACqDFLQIXI";
lang['ingrese el id de g'] = "Ingrese el ID de la canción de Goear:\n\nEjemplo:\nSi la URL de la canción es:\nhttp://www.goear.com/listen/bc371bf/amigo-bronco\nEl ID es: bc371bf";
lang['ingrese el id de g IE'] = "Ingrese el ID de la canción de Goear:\nPor ejemplo: 94bfcd1";
lang['ingrese la url de swf'] = "Ingrese la URL del archivo swf";
lang['ingrese la url de img'] = "Ingrese la URL de la imagen";
lang['ingrese la url de url'] = "Ingrese la URL que desea postear";
lang['ingrese el txt a citar'] = "Ingrese el texto a citar";
lang['ingrese solo el id de yt'] = "Ingrese solo el ID de YouTube";
lang['ingrese solo el id de g'] = "Ingrese solo el ID de Goear";
/* Fin Editor */
lang['error procesar'] = 'Error al intentar procesar lo solicitado';
lang['posts url categorias'] = 'posts';
lang['comunidades url'] = 'comunidades';
lang['html tema confirma borrar'] = "Seguro que deseas borrar este tema?";

var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1) && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1) && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);
var is_moz = 0;

function mozWrap(txtarea, open, close){
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if(selEnd == 1 || selEnd == 2)
    selEnd = selLength;
	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	return;
}

function hidediv(id){
	if(document.getElementById) // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'none';
	else{
    if(document.layers) // Netscape 4
      document.id.display = 'none';
    else // IE 4
      document.all.id.style.display = 'none';
  }
}

function showdiv(id){
	if(document.getElementById) // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'block';
	else{
		if(document.layers) // Netscape 4
			document.id.display = 'block';
		else // IE 4
			document.all.id.style.display = 'block';
	}
}

/******************************************************************************/

function el(id){
  if(document.getElementById)
    return document.getElementById(id);
  else if(window[id])
    return window[id];
  return null;
}

/* Citar comentarios */
function citar_comment(id, nick){
	var textarea = $('#body_comm');
	textarea.focus();
	textarea.val(((textarea.val()!='') ? textarea.val() + '\n' : '') + '[quote=' + nick + ']' + htmlspecialchars_decode($('#citar_comm_'+id).html(), 'ENT_NOQUOTES') + '[/quote]\n');
}

/* Box login */
function open_login_box(action){
	if($('#login_box').css('display') == 'block' && action!='open')
		close_login_box();
	else{
		$('#login_error').css('display','none');
		$('#login_cargando').css('display','none');
		$('.opciones_usuario').addClass('here');
		$('#login_box').fadeIn('fast');
		$('#nickname').focus();
	}
}

function close_login_box(){
	$('.opciones_usuario').removeClass('here');
	$('#login_box').slideUp('fast');
}

function login_ajax(form, connect){
	var el = new Array(), params = '';
	if (form == 'registro-logueo' || form == 'logueo-form') {
		el['nick'] = $('.reg-login .login-panel #nickname');
		el['pass'] = $('.reg-login .login-panel #password');
		el['error'] = $('.reg-login .login-panel #login_error');
		el['cargando'] = $('.reg-login .login-panel #login_cargando');
		el['cuerpo'] = $('.reg-login .login-panel .login_cuerpo');
		el['button'] = $('.reg-login .login-panel input[type="submit"]');
	} else {
		el['nick'] = $('#login_box #nickname');
		el['pass'] = $('#login_box #password');
		el['error'] = $('#login_box #login_error');
		el['cargando'] = $('#login_box #login_cargando');
		el['cuerpo'] = $('#login_box .login_cuerpo');
		el['button'] = $('#login_box input[type="submit"]');
	}
	if (typeof connect != 'undefined') {
		params = 'connect=facebook';
	} else {
		if (empty($(el['nick']).val())) {
			$(el['nick']).focus();
			return;
		}
		if (empty($(el['pass']).val())) {
			$(el['pass']).focus();
			return;
		}
		$(el['error']).css('display', 'none');
		$(el['cargando']).css('display', 'block');
		$(el['button']).attr('disabled', 'disabled').addClass('disabled');
		var remember = ($('#rem').is(':checked')) ? 'true' : 'false';
		params = 'nick='+encodeURIComponent($(el['nick']).val())+'&pass='+encodeURIComponent($(el['pass']).val())+'&rem='+remember;
		if (form == 'logueo-form') {
			params += '&facebook=1';
		}
	}
    $('#loading').fadeIn(250);    
	$.ajax({
		type: 'post', url: global_data.url + '/login-user.php', cache: false, data: params,
		success: function (h) {
			switch(h.charAt(0)){
				case '0':
					$(el['error']).html(h.substring(3)).show();
					$(el['nick']).focus();
					$(el['button']).removeAttr('disabled').removeClass('disabled');
					break;
				case '1':
					if (form != 'registro-logueo') {
						close_login_box();
					}
					if (h.substring(3)=='Home') {
						location.href='/';
					} else if (h.substr(3) == 'Cuenta') {
						location.href = '/cuenta/';
					} else {
						location.reload();
					}
                    $('#loading').fadeOut(350);
					break;
				case '2':
					$(el['cuerpo']).css('text-align', 'center').css('line-height', '150%').html(h.substring(3));
					break;
				case '3':
					open_login_box();
					mydialog.class_aux = 'registro';
					mydialog.mask_close = false;
					mydialog.close_button = true;
					mydialog.show(true);
					mydialog.title('Ingresar');
					mydialog.body('<br /><br />', 305);
					mydialog.buttons(false);
					mydialog.procesando_inicio('Cargando...', 'Registro');
					mydialog.center();
					$.ajax({
						type: 'POST',
						url: global_data.url + '/login-form.php',
						data: '',
						success: function(h){
							mydialog.procesando_fin();
							switch(h.charAt(0)){
								case '0':
									mydialog.alert('Error', h.substring(3));
									break;
								case '1':
									mydialog.body(h.substring(3), 305);
							}
							mydialog.center();
						}
					});

			}
		},
		error: function() {
			$(el['error']).html(lang['error procesar']).show();
		},
		complete: function(){
			$(el['cargando']).css('display', 'none');
		}
	});
}

function actualizar_comentarios(cat, nov){
    $('#loading').fadeIn(250);
	$('#ult_comm, #ult_comm > ol').slideUp(150);
	$.ajax({
		type: 'GET',
		url: global_data.url + '/posts-last-comentarios.php',
		cache: false,
		data: 'cat='+cat+'&nov='+nov,
		success: function(h){
			$('#ult_comm').html(h);
			$('#ult_comm > ol').hide();
			$('#ult_comm, #ult_comm > ol:first').slideDown( 1500, 'easeInOutElastic');
            $('#loading').fadeOut(350);
			//$('#ult_comm, #ult_comm > ol:first').slideDown({duration: 'slow', easing: 'easeOutBack'});
			// La animación easeOutBack me pareció buena, la otra también o.O aunque easeInOutElastic se ve raro con tantas letras.
		},
		error: function(){
			$('#ult_comm, #ult_comm > ol:first').slideDown({duration: 1000, easing: 'easeOutBounce'});
            $('#loading').fadeOut(350);
			// Esta animación se usaba anteriormente en caso de que saliese bien, puede volver a utilizarse.
		}
	});
}

/* Eliminar Comentario */
function borrar_com(comid, autor, postid, gew){
	mydialog.close();
    if(!postid) var postid = gget('postid');
	if(!gew){
            mydialog.show();
			
            mydialog.title('Borrar Comentarios');
			
            mydialog.body('&#191;Quiere eliminar este comentario?');
			
            mydialog.buttons(true, true, 'S&iacute;', 'borrar_com(' + comid + ', ' + autor + ', ' + postid + ', 1)', true, false, true, 'No', 'close', true, true);
			
            mydialog.center();
			
        }else{
        $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url +'/comentario-borrar.php',
		data: 'comid=' + comid + '&autor=' + autor + '&postid=' + postid,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					// RESTAMOS
					var ncomments = parseInt($('#ncomments').text());
					$('#ncomments').text(ncomments - 1);
					//
                    $('#div_cmnt_'+comid).slideUp( 1500, 'easeInOutElastic');
					$('#div_cmnt_'+comid).slideUp('normal', function(){ $(this).remove(); });
                    $('#loading').fadeOut(350);
					break;
			}
		},
		error: function(){
			mydialog.error_500("borrar_com('"+comid+"')");
            $('#loading').fadeOut(350);
		}
	});
	}
}
/* Ocultar Comentario */
function ocultar_com(comid, autor, postid){
	mydialog.close();
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url +'/comentario-ocultar.php',
		data: 'comid=' + comid + '&autor=' + autor + '&post_id=' + postid + gget('postid'),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					//
                    //mydialog.alert('Hecho', h.substring(3));
					$('#comentario_' +comid).css('opacity', 1);
					$('#pp_' +comid).css('opacity', 0.5);
					break;
				case '2':
					//
                    //mydialog.alert('Hecho', h.substring(3));
					$('#comentario_' +comid).css('opacity', 0.5);
					$('#pp_' +comid).css('opacity', 1);
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){
			mydialog.error_500("borrar_com('"+comid+"')");
		}
	});
}

function procesando(name, clean){
	if(clean){
		proc[name] = false;
		return true;
	}
	if(proc[name])
		return true;
	else{
		proc[name] = true;
		return false;
	}
}
/* Borrar Post */
function borrar_post(aceptar){
	if(!aceptar){
			mydialog.show();
			mydialog.title('Borrar Post');
			mydialog.body('&iquest;Seguro que deseas borrar este post?');
			mydialog.buttons(true, true, 'SI', 'borrar_post(1)', true, false, true, 'NO', 'close', true, true);
			mydialog.center();
			return;
	}else if(aceptar==1){
			mydialog.show();
			mydialog.title('Borrar Post');
			mydialog.body('Te pregunto de nuevo... &iquest;Seguro que deseas borrar este post?');
			mydialog.buttons(true, true, 'SI', 'borrar_post(2)', true, false, true, 'NO', 'close', true, true);
			mydialog.center();
			return;
	}
	mydialog.procesando_inicio('Eliminando...', 'Borrar Post');
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url + '/posts-borrar.php',
		data: gget('postid', true),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1':
					mydialog.alert('Post Borrado', h.substring(3), true);
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){
			mydialog.error_500("borrar_post(2)");
            $('#loading').fadeOut(350);
		},
		complete: function(){
			mydialog.procesando_fin();
            $('#loading').fadeOut(350);
		}
	});
}

/* Votar post */
var votar_post_votado = false;
function show_votar_post(force_hide){
	if(votar_post_votado)
		return;
	if(!force_hide && $('.post-metadata .dar_puntos').css('display') == 'none')
		$('.post-metadata .dar_puntos').show();
	else
		$('.post-metadata .dar_puntos').hide();
}
function votar_post(puntos){
	if(votar_post_votado)
		return;
    if(puntos == null || isNaN(puntos) != false || puntos < 1) {
		mydialog.alert('Error', 'Debe introducir n&uacute;meros');
        return false;
    }
	votar_post_votado = true;
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url + '/posts-votar.php',
		data: 'puntos=' + puntos + gget('postid'),
		success: function(h){
			show_votar_post(true);
			$('.dar-puntos').slideUp();
			switch(h.charAt(0)){
				case '0': //Error
					$('.post-metadata .mensajes').addClass('error').html(h.substring(3)).slideDown();
					break;
				case '1': //OK
					$('.post-metadata .mensajes').addClass('ok').html(h.substring(3)).slideDown();
					$('#puntos_post').html(number_format(parseInt($('#puntos_post').html().replace(".", "")) + parseInt(puntos), 0, ',', '.'));
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){
			votar_post_votado = false;
			mydialog.error_500("votar_post('"+puntos+"')");
            $('#loading').fadeOut(350);
		}
	});
}

/* Agregar post a favoritos */
var add_favoritos_agregado = false;
function add_favoritos(){
	if(add_favoritos_agregado)
		return;
	if(!gget('key')){
		mydialog.alert('Login', 'Tienes que estar logueado para realizar esta operaci&oacute;n');
		return;
	}
	add_favoritos_agregado = true;
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url + '/favoritos-agregar.php',
		data: gget('postid', true),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					$('.post-metadata .mensajes').addClass('error').html(h.substring(3)).slideDown();
					break;
				case '1': //OK
					$('.post-metadata .mensajes').addClass('ok').html(h.substring(3)).slideDown();
					$('.favoritos_post').html(number_format(parseInt($('.favoritos_post').html().replace(".", "")) + 1, 0, ',', '.'));
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){
			add_favoritos_agregado = false;
			mydialog.error_500("add_favoritos()");
            $('#loading').fadeOut(250);
		}
	});
}



function error_avatar(obj, id, size){
	if (typeof id == 'undefined' || typeof size == 'undefined') obj.src = global_data.img + 'images/avatar.gif';
	else obj.src = global_data.img + 'images/a'+ size + '_' + (id % 10) + '.jpg';
}

function ir_a_categoria(cat){
	if(cat!='root' && cat!='linea')
		if(cat==-1)
			document.location.href= global_data.url + '/';
        else if(cat==-2)
            document.location.href= global_data.url + '/' + 'posts/';
		else
			document.location.href= global_data.url + '/' + lang['posts url categorias'] + '/' + cat + '/';
}

function menu(section, href){ //Simple Click
	if(menu_section_actual != section){
		$('#tabbed'+menu_section_actual).removeClass('here');
		$('#tabbed'+section).addClass('here');
	}
	menu_section_actual = section;
	window.location = href;
	return true;
}
function menu2(section, href){ //Con DobleClick
	if(menu_section_actual == section){
		window.location = href;
		return true;
	}else{
		$('#tabbed'+menu_section_actual).removeClass('here');
		$('#tabbed'+section).addClass('here');
		$('#subMenu'+menu_section_actual).fadeOut('fast');
		$('#subMenu'+section).fadeIn('fast');
	}
	menu_section_actual = section;
}

function set_checked(obj){
	document.getElementById(obj).checked=true;
}
function is_checked(obj){
	return document.getElementById(obj) && document.getElementById(obj).checked;
}

/* MasOportunidades Buscador */
function mo_intro(e){
  tecla=(document.all)?e.keyCode:e.which;
  if(tecla==13)
		mo_validar();
}

function mo_validar(){
	if($('#mo_ibuscador').val()=='' || $('#mo_ibuscador').val()=='Buscar'){
		alert('El campo esta vacio');
		$('#mo_ibuscador').focus();
	}else
		window.open('http://www.masoportunidades.com.ar/buscar/' + $('#mo_ibuscador').val());
}
/* FIN - MasOportunidades */

/* Buscador Home */
function change_search_engine(){
	if($('#c_search_engine').is(':checked'))
		var engine = 'g';
	else
		var engine = 't';
	document.cookie='search_engine='+engine+';expires=Thu, 26 Jul 2012 16:12:48 GMT;path=/;domain=.'+document.domain;
}
function ibuscador_intro(e){
  tecla=(document.all)?e.keyCode:e.which;
  if(tecla==13)
		home_search();
}
function home_search(){
	if($('#ibuscadorq').val()=='' || $('#ibuscadorq').val()==$('#ibuscadorq').attr('title')){
		$('#ibuscadorq').focus();
		return;
	}
	var q = encodeURIComponent($('#ibuscadorq').val());
	if(document.getElementById('c_search_engine') && document.getElementById('c_search_engine').checked)
		window.location = 'http://buscar.taringa.net/posts?engine=google&q='+q;
	else if(/poringa/.test(document.domain)) //Esta en Poringa!
		window.location = 'http://www.poringa.net/posts/buscador/taringa/?q='+q;
	else
		window.location = 'http://buscar.taringa.net/posts?q='+q;
}
/* FIN - Buscador Home */

/* Change Country */
function change_country(prefix){
	var site = global_data.ts_domain;
	document.cookie='site_prefix='+prefix+';expires=Thu, 26 Jul 2019 16:12:48 GMT;path=/;domain=.'+site;
	if(prefix=='la')
		prefix = 'www';
	window.location = 'http://'+prefix+'.'+site;
}
/* FIN - Change Country */

/* Editor */
//Botones posts
mySettings = {
	markupSet: [
		{name:lang['Negrita'], key:'B', openWith:'[b]', closeWith:'[/b]'},
		{name:lang['Cursiva'], key:'I', openWith:'[i]', closeWith:'[/i]'},
		{name:lang['Subrayado'], key:'U', openWith:'[u]', closeWith:'[/u]'},
		{separator:'-' },
		{name:lang['Alinear a la izquierda'], key:'', openWith:'[align=left]', closeWith:'[/align]'},
		{name:lang['Centrar'], key:'', openWith:'[align=center]', closeWith:'[/align]'},
		{name:lang['Alinear a la derecha'], key:'', openWith:'[align=right]', closeWith:'[/align]'},
		{separator:'-' },
		{name:lang['Color'], dropMenu: [
			{name:lang['Rojo oscuro'], openWith:'[color=darkred]', closeWith:'[/color]' },
			{name:lang['Rojo'], openWith:'[color=red]', closeWith:'[/color]' },
			{name:lang['Naranja'], openWith:'[color=orange]', closeWith:'[/color]' },
			{name:lang['Marron'], openWith:'[color=brown]', closeWith:'[/color]' },
			{name:lang['Amarillo'], openWith:'[color=yellow]', closeWith:'[/color]' },
			{name:lang['Verde'], openWith:'[color=green]', closeWith:'[/color]' },
			{name:lang['Oliva'], openWith:'[color=olive]', closeWith:'[/color]' },
			{name:lang['Cyan'], openWith:'[color=cyan]', closeWith:'[/color]' },
			{name:lang['Azul'], openWith:'[color=blue]', closeWith:'[/color]' },
			{name:lang['Azul oscuro'], openWith:'[color=darkblue]', closeWith:'[/color]' },
			{name:lang['Indigo'], openWith:'[color=indigo]', closeWith:'[/color]' },
			{name:lang['Violeta'], openWith:'[color=violet]', closeWith:'[/color]' },
			{name:lang['Negro'], openWith:'[color=black]', closeWith:'[/color]' }
		]},
		{name:lang['Tamano'], dropMenu :[
			{name:lang['Pequena'], openWith:'[size=9]', closeWith:'[/size]' },
			{name:lang['Normal'], openWith:'[size=12]', closeWith:'[/size]' },
			{name:lang['Grande'], openWith:'[size=18]', closeWith:'[/size]' },
			{name:lang['Enorme'], openWith:'[size=24]', closeWith:'[/size]' }
		]},
		{name:lang['Fuente'], dropMenu :[
			{name:'Arial', openWith:'[font=Arial]', closeWith:'[/font]' },
			{name:'Courier New', openWith:'[font=Courier New]', closeWith:'[/font]' },
			{name:'Georgia', openWith:'[font=Georgia]', closeWith:'[/font]' },
			{name:'Times New Roman', openWith:'[font=Times New Roman]', closeWith:'[/font]' },
			{name:'Verdana', openWith:'[font=Verdana]', closeWith:'[/font]' },
			{name:'Trebuchet MS', openWith:'[font=Trebuchet MS]', closeWith:'[/font]' },
			{name:'Lucida Sans', openWith:'[font=Lucida Sans]', closeWith:'[/font]' },
			{name:'Comic Sans', openWith:'[font=Comic Sans]', closeWith:'[/font]' }
		]},
		{separator:'-' },
		{name:lang['Insertar video de YouTube'], beforeInsert:function(h){ markit_yt(h); }},
		{name:lang['Insertar cancion de Goear'], beforeInsert:function(h){ markit_g(h); }},
		{name:lang['Insertar archivo SWF'], beforeInsert:function(h){ markit_swf(h); }},
		{name:lang['Insertar Imagen'], beforeInsert:function(h){ markit_img(h); }},
		{name:lang['Insertar Link'], beforeInsert:function(h){ markit_url(h); }},
		{name:lang['Citar'], beforeInsert:function(h){ markit_quote(h); }},
        {separator:'-' },
        {name:lang['Spoiler'], openWith:'[spoiler]', closeWith:'[/spoiler]' },        
        {name:lang['Upload'], beforeInsert:function(h){ markit_upload(h); }},
        /*{name:lang['Tu'], openWith:'[tu]', closeWith:'' },*/
	]
};

//Botones comentarios
mySettings_cmt = {
	nameSpace: 'markitcomment',
	resizeHandle: false,
	markupSet: [
		{name:lang['Negrita'], key:'B', openWith:'[b]', closeWith:'[/b]'},
		{name:lang['Cursiva'], key:'I', openWith:'[i]', closeWith:'[/i]'},
		{name:lang['Subrayado'], key:'U', openWith:'[u]', closeWith:'[/u]'},
		{name:lang['Insertar video de YouTube'], beforeInsert:function(h){ markit_yt(h); }},
		{name:lang['Insertar Imagen'], beforeInsert:function(h){ markit_img(h); }},
		{name:lang['Insertar Link'], beforeInsert:function(h){ markit_url(h); }},
		{name:lang['Citar'], beforeInsert:function(h){ markit_quote(h); }}
	]
};

//Funciones botones especiales
function markit_yt(h){
	var msg = prompt(lang['ingrese el id de yt'+(is_ie?' IE':'')], lang['ingrese solo el id de yt']);
	if(msg != null){
		h.replaceWith = '[align=center][swf=http://www.youtube.com/v/' + msg + ']Link: [url]http://www.youtube.com/watch?v=' + msg + '[/url][/align]\n';
		h.openWith = '';
		h.closeWith = '';
	}else{
		h.replaceWith = '';
		h.openWith = '';
		h.closeWith = '';
	}
}
function markit_g(h){
	var msg = prompt(lang['ingrese el id de g'+(is_ie?' IE':'')], lang['ingrese solo el id de g']);
	if(msg != null){
		h.replaceWith = '[align=center][goear=' + msg + ']Link: [url]http://www.goear.com/listen/' + msg + '/[/url][/align]\n';
		h.openWith = '';
		h.closeWith = '';
	}else{
		h.replaceWith = '';
		h.openWith = '';
		h.closeWith = '';
	}
}
function markit_swf(h){
	if(h.selection!='' && h.selection.substring(0,7)=='http://'){
		h.replaceWith = '[align=center][swf=' + h.selection + ']Link: [url]' + h.selection + '[/url][/align]\n';
		h.openWith = '';
		h.closeWith = '';
	}else{
		var msg = prompt(lang['ingrese la url de swf'], 'http://');
		if(msg != null){
			h.replaceWith = '[align=center][swf=' + msg + ']\nlink: [url]' + msg + '[/url][/align]\n';
			h.openWith = '';
			h.closeWith = '';
		}else{
			h.replaceWith = '';
			h.openWith = '';
			h.closeWith = '';
		}
	}
}
function markit_img(h){
	if(h.selection!='' && h.selection.substring(0,7)=='http://'){
		h.replaceWith = '';
		h.openWith = '[img=';
		h.closeWith = ']';				
	}else{
		var msg = prompt(lang['ingrese la url de img'], 'http://');
		if(msg != null){
			h.replaceWith = '[img=' + msg + ']';
			h.openWith = '';
			h.closeWith = '';
		}else{
			h.replaceWith = '';
			h.openWith = '';
			h.closeWith = '';
		}
	}
}
function markit_url(h){
	if(h.selection==''){
		var msg = prompt(lang['Ingrese la URL que desea postear'], 'http://');
		if(msg != null){
			h.replaceWith = '[url]' + msg + '[/url]';
			h.openWith = '';
			h.closeWith = '';
		}else{
			h.replaceWith = '';
			h.openWith = '';
			h.closeWith = '';
		}
	}else if(h.selection.substring(0,7)=='http://' || h.selection.substring(0,8)=='https://' || h.selection.substring(0,6)=='ftp://'){
		h.replaceWith = '';
		h.openWith='[url]';
		h.closeWith='[/url]';
	}else{
		var msg = prompt(lang['Ingrese la URL que desea postear'], 'http://');
		if(msg != null){
			h.replaceWith = '';
			h.openWith='[url=' + msg + ']';
			h.closeWith='[/url]';
		}else{
			h.replaceWith = '';
			h.openWith = '';
			h.closeWith = '';
		}
	}
}

function markit_quote(h){
	if(h.selection==''){
		var msg = prompt('Ingrese el texto a citar', '');
		if(msg != null){
			h.replaceWith = '[quote]' + msg + '[/quote]';
			h.openWith = '';
			h.closeWith = '';
		}else{
			h.replaceWith = '';
			h.openWith = '';
			h.closeWith = '';
		}
	}else{
		h.replaceWith = '';
		h.openWith='[quote]';
		h.closeWith='[/quote]';
	}
}

var upload = {
    newUpload: function(h){
        $('#protocolo').hide();
        $('#upload_form').fadeIn('slow');
    },
    agregar: function(img){
        // AGREGAR
        $.markItUp({ openWith:"\n[img=", closeWith: "]\n", replaceWith: img } );
    }
}

function markit_upload(h){
    upload.newUpload(h);
}

//Imprimir editores
function print_editor(){
	//Editor de posts
	if($('#markItUp') && !$('#markItUpMarkItUp').length){
		$('#markItUp').markItUp(mySettings);
		$('#emoticons a').live("click",function(){
			emoticon = ' ' + $(this).attr("smile") + ' ';
			$.markItUp({ replaceWith:emoticon });
			return false;
		});
	}
	//Editor de posts comentarios
	if($('#body_comm') && !$('#markItUpbody_comm').length){
		$('#body_comm').markItUp(mySettings_cmt);
	}

	//Editor de respuestas comunidades
	if($('#body_resp') && !$('#markItUpbody_resp').length){
		$('#body_resp').markItUp(mySettings_cmt);
	}
}
/* FIN - Editor */

var monitor_sections_here = 'Comentarios';
function monitor_sections(section, userid){
	if(!section) //Recargando por 500
		section = monitor_sections_here;
	else if(monitor_sections_here==section)
		return;
	$('.filterBy #'+monitor_sections_here).removeClass('here');
	monitor_sections_here = section;
	$('.filterBy #'+section).addClass('here');
	$('.gif_cargando').css('display', 'block');
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'GET',
		url: global_data.url + '/monitor.php',
		data: 'section='+section+'&ajax=1'+(userid?'&id='+userid:''),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					$('#showResult').html('<div class="warningData">'+$('#showResult').html(h.substring(3))+'</div>');
					break;
				case '1': //OK
					$('#showResult').html(h.substring(3));
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){
			$('#showResult').html('<div class="emptyData">'+lang['error procesar']+'. <a href="javascript:monitor_sections(\''+section+'\', \''+userid+'\')">Reintentar</a></div>');
            $('#loading').fadeOut(450);
        },
		complete: function(){
			$('.gif_cargando').css('display', 'none');
            $('#loading').fadeOut(450);
		}
	});
}

function gget(data, sin_amp){
	var r = data+'=';
	if(!sin_amp)
		r = '&'+r;
	switch(data){
		case 'key':
			if(global_data.user_key!='')
				return r+global_data.user_key;
			break;
		case 'postid':
			if(global_data.postid!='')
				return r+global_data.postid;
			break;
		case 'fotoid':
			if(global_data.fotoid!='')
				return r+global_data.fotoid;
			break;
		case 'temaid':
			if(global_data.temaid!='')
				return r+global_data.temaid;
			break;
	}
	return '';
}
function keypress_intro(e){
  tecla=(document.all)?e.keyCode:e.which;
  return (tecla==13);
}

function onfocus_input(o){
	if($(o).val()==$(o).attr('title')){
		$(o).val('');
		$(o).removeClass('onblur_effect');
	}
}
function onblur_input(o){
	if($(o).val()==$(o).attr('title') || $(o).val()==''){
		$(o).val($(o).attr('title'));
		$(o).addClass('onblur_effect');
	}
}
var form_ff = 0;
//Cargo el formulario
function registro_load_form(data){
	if (typeof data == 'undefined') {
		var data = '';
	}
	mydialog.class_aux = 'registro';
	mydialog.mask_close = false;
	mydialog.close_button = true;
	mydialog.show(true);
	mydialog.title('Registro');
	mydialog.body('<br /><br />', 305);
	mydialog.buttons(false);
	mydialog.procesando_inicio('Cargando...', 'Registro');
	mydialog.center();
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url + '/registro-form.php?ts=false',
		data: data,
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.procesando_fin();
					mydialog.alert('Error', h.substring(3));
					break;
				case '1': //OK. Ya es miembro
					mydialog.body(h.substring(3), 305);
					// TUBE PROBLEMAS CON FIREFOX 4 Y ESTE ES EL HACK QUE LO SOLUCIONO :D
					if($.browser.mozilla && form_ff == 0) { registro_load_form(data); form_ff++;}
					break;
			}
            $('#loading').fadeOut(350);
			mydialog.center();
		},
		error: function(){
			mydialog.procesando_fin();
			mydialog.error_500("registro.load_form("+data+")");
            $('#loading').fadeOut(350);
		}
	});
}

//Calcula la edad a partir de la fecha de nacimiento
function edad(mes, dia, anio){
	//Calcular edad
	now = new Date()
	born = new Date(anio, mes*1-1, dia);
	years = Math.floor((now.getTime() - born.getTime()) / (365.25 * 24 * 60 * 60 * 1000));
	return years;
}


function my_number_format(numero){
	return Number(numero).toLocaleString();
}

function bloquear(user, bloqueado, lugar, aceptar){
	if(!aceptar && bloqueado){
		mydialog.show();
		mydialog.title('Bloquear usuario');
		mydialog.body('&iquest;Realmente deseas bloquear a este usuario?');
		mydialog.buttons(true, true, 'SI', "bloquear('"+user+"', true, '"+lugar+"', true)", true, false, true, 'NO', 'close', true, true);
		mydialog.center();
		return;
	}
	if(bloqueado)
		mydialog.procesando_inicio('Procesando...', 'Bloquear usuario');
        $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: global_data.url + '/bloqueos-cambiar.php',
		data: 'user='+user+(bloqueado ? '&bloquear=1' : '')+gget('key'),
		success: function(h){
			mydialog.alert('Bloquear Usuarios', h.substring(3));
            //
            if(h.charAt(0) == 1){
    			switch(lugar){
    				case 'perfil':
    					if(bloqueado)
    						$('#bloquear_cambiar').html('Desbloquear').removeClass('bloquearU').addClass('desbloquearU').attr('href', "javascript:bloquear('"+user+"', false, '"+lugar+"')");
    					else
    						$('#bloquear_cambiar').html('Bloquear').removeClass('desbloquearU').addClass('bloquearU').attr('href', "javascript:bloquear('"+user+"', true, '"+lugar+"')");
    					break;
    				case 'respuestas':
    				case 'comentarios':
    					if (bloqueado) {
    						$('li.desbloquear_'+user).show();
    						$('li.bloquear_'+user).hide();
    					}
    					else {
    						$('li.bloquear_'+user).show();
    						$('li.desbloquear_'+user).hide();
    					}
    					break;
    				case 'mis_bloqueados':
    					if(bloqueado)
    						$('.bloquear_usuario_'+user).attr('title', 'Desbloquear Usuario').removeClass('bloqueadosU').addClass('desbloqueadosU').html('Desbloquear').attr('href', "javascript:bloquear('"+user+"', false, '"+lugar+"')");
    					else
    						$('.bloquear_usuario_'+user).attr('title', 'Bloquear Usuario').removeClass('desbloqueadosU').addClass('bloqueadosU').html('Bloquear').attr('href', "javascript:bloquear('"+user+"', true, '"+lugar+"')");
    					break;
                    case 'mensajes':
    					if(bloqueado)
    						$('#bloquear_cambiar').html('Desbloquear').attr('href', "javascript:bloquear('"+user+"', false, '"+lugar+"')");
    					else
    						$('#bloquear_cambiar').html('Bloquear').attr('href', "javascript:bloquear('"+user+"', true, '"+lugar+"')");
                    break;
    			}
            }
            $('#loading').fadeOut(350);
		},
		error: function(){
			mydialog.error_500("bloquear('"+user+"', '"+bloqueado+"', '"+lugar+"', true)");
            $('#loading').fadeOut(350);
		},
		complete: function(){
			mydialog.procesando_fin();
            $('#loading').fadeOut(350);
		}
	});
}

function muro_add(userid){
	$('.muro #add #error').hide();
	if($('#muro-mensaje').val()==$('#muro-mensaje').attr('title')){
		$('#muro-mensaje').focus();
		return;
	}
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: '/muro-agregar.php',
		data: 'userid='+userid+'&mensaje='+encodeURIComponent($('#muro-mensaje').val())+gget('key'),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					$('.muro #add #error').html(h.substring(3)).show();
					break;
				case '1': //OK
					mydialog.alert('OK', h.substring(3));
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){	
			mydialog.error_500("muro_add('"+userid+"')");
            $('#loading').fadeOut(350);
		}
	});
}
function muro_status(msgid, userid, borrar){
    $('#loading').fadeIn(250);
	$.ajax({
		type: 'POST',
		url: '/muro-status.php',
		data: 'msgid='+msgid + (userid ? '&userid='+userid : '') + gget('key') + (borrar ? '&borrar=1' : ''),
		success: function(h){
			switch(h.charAt(0)){
				case '0': //Error
					mydialog.alert('Error', h.substring(3));
					break;
				case '1': //OK
					mydialog.alert('OK', h.substring(3));
					break;
			}
            $('#loading').fadeOut(350);
		},
		error: function(){	
			mydialog.error_500("muro_status('"+msgid+"', '"+userid+"', '"+borrar+"')");
            $('#loading').fadeOut(350);
		}
	});
}

/* MyDialog */
var mydialog = {

is_show: false,
class_aux: '',
mask_close: true,
close_button: false,
show: function(class_aux){
	if(this.is_show)
		return;
	else
		this.is_show = true;
	if($('#mydialog').html() == '') //Primera vez
		$('#mydialog').html('<div id="dialog"><div id="title"></div><div id="cuerpo"><div id="procesando"><div id="mensaje"></div></div><div id="modalBody"></div><div id="buttons"></div></div></div>');

	if(class_aux==true)
		$('#mydialog').addClass(this.class_aux);
	else if(this.class_aux != ''){
		$('#mydialog').removeClass(this.class_aux);
		this.class_aux = '';
	}

	if(this.mask_close)
		$('#mask').click(function(){ mydialog.close() });
	else
		$('#mask').unbind('click');

	if(this.close_button)
		$('#mydialog #dialog').append('<img class="close_dialog" src="'+ global_data.img +'images/close.gif" onclick="mydialog.close()" />');
	else
		$('#mydialog #dialog .close_dialog').remove();

	$('#mask').css({'width':$(document).width(),'height':$(document).height(),'display':'block'});

	if(jQuery.browser.msie && jQuery.browser.version < 7) //Fix IE<7 <- fack you
		$('#mydialog #dialog').css('position', 'absolute');
	else
		$('#mydialog #dialog').css('position', 'fixed');
        $('#mydialog #dialog').fadeIn('fast');
},
close: function(){
	//Vuelve todos los parametros por default
	this.class_aux = '';
	this.mask_close = true;
	this.close_button = false;

	this.is_show = false;
	$('#mask').css('display', 'none');
	$('#mydialog #dialog').fadeOut('fast', function(){ $(this).remove() });
	this.procesando_fin();
},
center: function(){
	if($('#mydialog #dialog').height() > $(window).height()-60)
		$('#mydialog #dialog').css({'position':'absolute', 'top':20});
	else
		$('#mydialog #dialog').css('top', $(window).height()/2-$('#mydialog #dialog').height()/2);
	$('#mydialog #dialog').css('left', $(window).width()/2-$('#mydialog #dialog').width()/2);
},

title: function(title){
	$('#mydialog #title').html(title);
},
body: function(body, width, height){
	if(!width && (jQuery.browser.opera || (jQuery.browser.msie && jQuery.browser.version<7)))
		width = '400px';
	$('#mydialog #dialog').width(width?width:'').height(height?height:'');
	$('#mydialog #modalBody').html(body);
},
buttons: function(display_all, btn1_display, btn1_val, btn1_action, btn1_enabled, btn1_focus, btn2_display, btn2_val, btn2_action, btn2_enabled, btn2_focus){
	if(!display_all){
		$('#mydialog #buttons').css('display', 'none').html('');
		return;
	}

	if(btn1_action=='close')
		btn1_action='mydialog.close()';
	if(btn2_action=='close' || !btn2_val)
		btn2_action='mydialog.close()';
	if(!btn2_val){
		btn2_val = 'Cancelar';
		btn2_enabled = true;
	}

	var html = '';
	if(btn1_display)
		html += '<input type="button" class="mBtn btnOk'+(btn1_enabled?'':' disabled')+'" style="display:'+(btn1_display?'inline-block':'none')+'"'+(btn1_display?' value="'+btn1_val+'"':'')+(btn1_display?' onclick="'+btn1_action+'"':'')+(btn1_enabled?'':' disabled')+' />';
	if(btn2_display)
		html += ' <input type="button" class="mBtn btnCancel'+(btn1_enabled?'':' disabled')+'" style="display:'+(btn2_display?'inline-block':'none')+'"'+(btn2_display?' value="'+btn2_val+'"':'')+(btn2_display?' onclick="'+btn2_action+'"':'')+(btn2_enabled?'':' disabled')+' />';
	$('#mydialog #buttons').html(html).css('display', 'inline-block');

	if(btn1_focus)
		$('#mydialog #buttons .mBtn.btnOk').focus();
	else if(btn2_focus)
		$('#mydialog #buttons .mBtn.btnCancel').focus();
},
buttons_enabled: function(btn1_enabled, btn2_enabled){
	if($('#mydialog #buttons .mBtn.btnOk'))
		if(btn1_enabled)
			$('#mydialog #buttons .mBtn.btnOk').removeClass('disabled').removeAttr('disabled');
		else
			$('#mydialog #buttons .mBtn.btnOk').addClass('disabled').attr('disabled', 'disabled');

	if($('#mydialog #buttons .mBtn.btnCancel'))
		if(btn2_enabled)
			$('#mydialog #buttons .mBtn.btnCancel').removeClass('disabled').removeAttr('disabled');
		else
			$('#mydialog #buttons .mBtn.btnCancel').addClass('disabled').attr('disabled', 'disabled');
},
alert: function(title, body, reload){
	this.show();
	this.title(title);
	this.body(body);
	this.buttons(true, true, 'Aceptar', 'mydialog.close();' + (reload ? 'location.reload();' : 'close'), true, true, false);
	this.center();
},
error_500: function(fun_reintentar){
	setTimeout(function(){
		mydialog.procesando_fin();
		mydialog.show();
		mydialog.title('Error');
		mydialog.body(lang['error procesar']);
		mydialog.buttons(true, true, 'Reintentar', 'mydialog.close();'+fun_reintentar, true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
	}, 200);
},
procesando_inicio: function(value, title){
	if(!this.is_show){
		this.show();
		this.title(title);
		this.body('');
		this.buttons(false, false);
		this.center();
	}
	$('#mydialog #procesando #mensaje').html('<img src="'+global_data.img+'images/loading.gif" />');
	$('#mydialog #procesando').fadeIn('fast');
},
procesando_fin: function(){
	$('#mydialog #procesando').fadeOut('fast');
}

};


document.onkeydown = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key == 27) //escape, close mydialog
		mydialog.close();
};



function TopsTabs(parent, tab) {
		if($('.box_cuerpo ol.filterBy#filterBy'+tab).css('display') == 'block') return;
		$('#'+parent+' > .box_cuerpo div.filterBy a').removeClass('here');
		$('.box_cuerpo div.filterBy a#'+tab).addClass('here');
		$('#'+parent+' > .box_cuerpo ol').fadeOut();
		$('#'+parent+' > .box_cuerpo ol#filterBy'+tab).fadeIn();
}

$(document).ready(function(){
    var location_box_more = false;
    $('.location-box-more').click(function(){
        if (location_box_more) {
            $('.location-box ul').css('height', '170px');
            $(this).html("Ver más");
            location_box_more = false;
        }
        else {
            $('.location-box ul').css('height', '170%');
            $(this).html("Ver menos");
            location_box_more = true;
        }
    });
	$('body').click(function(e){ 
	   if ($('#mon_list').css('display') != 'none' && $(e.target).closest('#mon_list').length == 0 && $(e.target).closest('a[name=Monitor]').length == 0) notifica.last();
       if ($('#mp_list').css('display') != 'none' && $(e.target).closest('#mp_list').length == 0 && $(e.target).closest('a[name=Mensajes]').length == 0) mensaje.last(); 
    });
	print_editor();
	$('.autogrow').css('max-height', '500px').autogrow();
	$('.userInfoLogin a[class!=ver-mas], .comOfi, .post-compartir img, div.action > div.btn_follow > a[title], .dot-online-offline, .qtip').tipsy({gravity: 's'});
	$('.w-medallas span.icon-medallas').tipsy({ gravity: 's' });
	for(var i = 1; i <= 17; ++i) $('.markItUpButton'+i+' > a:first-child').tipsy({gravity: 's'});
	$('img.lazy').lazyload({ placeHolder: global_data.img+'images/space.gif', sensitivity: 300 });
	$('div.avatar-box').live("mouseenter",function(){ $(this).children('ul').show(); }).live("mouseleave",function(){ $(this).children('ul').hide() });
	var zIndexNumber = 99;
	$('div.avatar-box').each(function(){
		$(this).css('zIndex', zIndexNumber);
		zIndexNumber -= 1;
	});
	$('div.new-search > div.bar-options > ul > li > a').bind('click', function(){
		var at = $(this).parent('li').attr('class').split('-')[0];
		$('div.new-search > div.bar-options > ul > li.selected').removeClass('selected');
		$(this).parent('li').addClass('selected');
		$('div.new-search').attr('class', 'new-search '+at);
        at = (at == 'web') ? 'google' : 'web';
        $('input[name="e"]').val(at);
        // GOOGLE ID
        var gid = $('form[name="search"]').attr('gid');
        //Muestro/oculto los input google
		if(at == 'google'){ 
            //Ahora es google {/literal}
			$('form[name="search"]').append('<input type="hidden" name="cx" value="' + gid + '" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />');
            $('#search-home-cat-filter, #sh_options').hide();
            // {literal}
		}else { //El anterior fue google
			$('input[name="cx"]').remove();
			$('input[name="cof"]').remove();
			$('input[name="ie"]').remove();
            $('#search-home-cat-filter, #sh_options').css('display','');
		}
	});
	$('div.new-search > div.search-body > form > input[name=q]').bind('focus', function(){
		if ($(this).val() == 'Buscar') { $(this).val(''); }
		$(this).css('color', '#000');
	}).bind('blur', function(){
		if ($.trim($(this).val()) == '') { $(this).val('Buscar'); }
		$(this).css('color', '#999');
	});
	$('span.fb_share_no_count').each(function(){
		$(this).removeClass('fb_share_no_count');
		$('.fb_share_count_inner', this).html('0');
	});
	// EXTRAS
	$('.admin_actions img').tipsy({ gravity: 's' });
});

function search_set(obj, x) { 
    $('div.search-in > a').removeClass('search_active'); 
    $(obj).addClass('search_active');
    $('input[name="e"]').val(x);  
    // GOOGLE ID
    var gid = $('form[name=top_search_box]').attr('gid');
    //Muestro/oculto los input google
	if(x == 'google'){ 
        //Ahora es google {/literal}
		$('form[name=top_search_box]').append('<input type="hidden" name="cx" value="' + gid + '" /><input type="hidden" name="cof" value="FORID:10" /><input type="hidden" name="ie" value="ISO-8859-1" />');
        // {literal}
	}else { //El anterior fue google
		$('input[name="cx"]').remove();
		$('input[name="cof"]').remove();
		$('input[name="ie"]').remove();
	}
    // 
    $('#ibuscadorq').focus();
}

// hoverIntent by Brian Cherne
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);

var notifica = {

	cache: {},
	retry: Array(),
	userMenuPopup: function (obj) {
		var id = $(obj).attr('userid');
		var cache_id = 'following_'+id, list = $(obj).children('ul');
		$(list).children('li.check').slideUp();
		if (this.cache[cache_id] == 1) {
			$(list).children('li.follow').slideUp();
			$(list).children('li.unfollow').slideDown();
		}
		else {
			$(list).children('li.unfollow').slideUp();
			$(list).children('li.follow').slideDown();
		}
	},
    userInMencionHandle: function(r){
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
            var fid = x[1];
			$('a.mf_' + fid +', a.mf_' + fid).each(function(){
                $(this).toggle();
            });
			$('.mft_' + fid).html(number_format(parseInt(x[2])));
            vcard_cache['mf' + fid] = '';
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);  
    },
	userMenuHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			var cache_id = 'following_'+x[1];
			notifica.cache[cache_id] = parseInt(x[0]);
			$('div.avatar-box').children('ul').hide();
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[4]);
	},
	userInPostHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			$('a.follow_user_post, a.unfollow_user_post').toggle();
			$('div.metadata-usuario > span.nData.user_follow_count').html(number_format(parseInt(x[2])));
			notifica.userMenuHandle(r);
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
	},
	userInMonitorHandle: function (r, obj) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) $(obj).fadeOut(function(){ $(obj).remove(); });
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);	
	},
	inPostHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			$('a.follow_post, a.unfollow_post').parent('li').toggle();
			$('ul.post-estadisticas > li > span.icons.monitor').html(number_format(parseInt(x[2])));
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
	},
	inComunidadHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			$('a.follow_comunidad, a.unfollow_comunidad').toggle();
			$('li.comunidad_seguidores').html(number_format(parseInt(x[2]))+' Seguidores');
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
	},
	temaInComunidadHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			$('div.followBox > a.follow_tema, a.unfollow_tema').toggle();
			$('span.tema_notifica_count').html(number_format(parseInt(x[2]))+' Seguidores');
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
	},
	ruserInAdminHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) $('.ruser'+x[1]).toggle();
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);	
	},
	listInAdminHandle: function (r) {
		var x = r.split('-');
		if (x.length == 3 && x[0] == 0) {
			$('.list'+x[1]).toggle();
			$('.list'+x[1]+':first').parent('div').parent('li').children('div:first').fadeTo(0, $('.list'+x[1]+':first').css('display') == 'none' ? 0.5 : 1);
		}
		else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);	
	},
	spamPostHandle: function (r) {
		var x = r.split('-');
		if (x.length == 2) mydialog.alert('Notificaciones', x[1]);
		else mydialog.close();
	},
	spamTemaHandle: function (r) {
		var x = r.split('-');
		if (x.length == 2) mydialog.alert('Notificaciones', x[1]);
		else mydialog.close();
	},
	ajax: function (param, cb, obj) {
		if ($(obj).hasClass('spinner')) return;
		notifica.retry.push(param);
		notifica.retry.push(cb);
		var error = param[0]!='action=count';
		$(obj).addClass('spinner');
        $('#loading').fadeIn(250);
		$.ajax({
			url: global_data.url + '/notificaciones-ajax.php', type: 'post', data: param.join('&')+gget('key'),
			success: function (r) {
				$(obj).removeClass('spinner');
				cb(r, obj);
                $('#loading').fadeOut(350);
			},
			error: function () {
				if (error) mydialog.error_500('notifica.ajax(notifica.retry[0], notifica.retry[1])');
                $('#loading').fadeOut(350);                
			}
		});
	},
	follow: function (type, id, cb, obj) {
		this.ajax(Array('action=follow', 'type='+type, 'obj='+id), cb, obj);
	},
	unfollow: function (type, id, cb, obj) {
		this.ajax(Array('action=unfollow', 'type='+type, 'obj='+id), cb, obj);
	},
	spam: function (id, cb) {
		this.ajax(Array('action=spam', 'postid='+id), cb);
	},
	c_spam: function (id, cb) {
		this.ajax(Array('action=c_spam', 'temaid='+id), cb);
	},
	sharePost: function (id) {
		mydialog.show();
		mydialog.title('Recomendar');
		mydialog.body('¿Quieres recomendar este post a tus seguidores?');
		mydialog.buttons(true, true, 'Recomendar', 'notifica.spam('+id+', notifica.spamPostHandle)', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
	},
	shareTema: function (id) {
		mydialog.show();
		mydialog.title('Recomendar');
		mydialog.body('¿Quieres recomendar este tema a tus seguidores?');
		mydialog.buttons(true, true, 'Recomendar', 'notifica.c_spam('+id+', notifica.spamTemaHandle)', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
	},
	last: function () {
		var c = parseInt($('#alerta_mon > a > span').html());
        mensaje.close();
		if ($('#mon_list').css('display') != 'none') {
			$('#mon_list').fadeOut();
			$('a[name=Monitor]').parent('li').removeClass('monitor-notificaciones');
		}
		else {
			if (($('#mon_list').css('display') == 'none' && c > 0) || typeof notifica.cache.last == 'undefined') {
				$('a[name=Monitor]').children('span').addClass('spinner');
				$('a[name=Monitor]').parent('li').addClass('monitor-notificaciones');
				$('#mon_list').slideDown();
				notifica.ajax(Array('action=last'), function (r) {
					notifica.cache['last'] = r;
					notifica.show();
				});
			}
			else notifica.show();
		}
	},
	check: function () {
		notifica.ajax(Array('action=count'), notifica.popup);
	},
	popup: function (r) {
		var c = parseInt($('#alerta_mon > a > span').html());
		if (r != c && r > 0) {
			if (r != 1) var not_total = ' notificaciones'; else var not_total = ' notificaci&oacute;n';
			if (!$('#alerta_mon').length) $('div.userInfoLogin > ul > li.monitor').append('<div class="alertas" id="alerta_mon"><a title="' + r + not_total + '"><span></span></a></div>');
			$('#alerta_mon > a > span').html(r);
			$('#alerta_mon').animate({ top: '-=5px' }, 100, null, function(){ $('#alerta_mon').animate({ top: '+=5px' }, 100) });
		}
		else if (r == 0) $('#alerta_mon').remove();
	},
	show: function () {
		if (typeof notifica.cache.last != 'undefined') {
			$('#alerta_mon').remove();
			$('a[name=Monitor]').parent('li').addClass('monitor-notificaciones');
			$('a[name=Monitor]').children('span').removeClass('spinner');
			$('#mon_list').show().children('ul').html(notifica.cache.last);
			$('#mon_list > ul > li > a[title]').tipsy({ gravity: 's' });
		}
	},
	filter: function (x, obj) {
		$.ajax({url: global_data.url + '/notificaciones-filtro.php', type: 'post', data: 'fid=' + x});
        var v = $(obj).attr('checked') ? 1 : 0; 	   
	},
    close: function(){
		$('#mon_list').hide();
		$('a[name=Monitor]').parent('li').removeClass('monitor-notificaciones');   
    }
	
}
/* Mensajes */

var mensaje = {
    cache: {},
    vars: Array(),
    // CREAR HTML
    form: function (){
         var html = '';
        if(this.vars['error']) html += '<div class="emptyData">' + this.vars['error'] + '</div><br style="clear:both">'
        html += '<div class="m-col1">Para:</div>'
        html += '<div class="m-col2"><input type="text" value="' + this.vars['to'] + '" maxlength="16" tabindex="0" size="20" id="msg_to" name="msg_to"/> <span style="font-size: 10px;">(Ingrese el nombre de usuario)</span></div><br style="clear:both" />'
        html += '<div class="m-col1">Asunto:</div>'
        html += '<div class="m-col2"><input type="text" value="' + this.vars['sub'] + '" maxlength="100" tabindex="0" size="50" id="msg_subject" name="msg_subject"/></div><br /><br style="clear:both"/>'
        html += '<div class="m-col1">Mensaje:</div>'
        html += '<div class="m-col2"><textarea tabindex="0" rows="10" id="msg_body" name="msg_body" style="height:100px; width:350px">' + this.vars['msg'] + '</textarea></div><br style="clear:both"/>'
        return html;                          
    },
    // FUNCIONES AUX
    checkform: function (h){
        if(parseInt(h) == 0)
            mensaje.enviar(1);
        else if(parseInt(h) == 1) {
            mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'No es posible enviarse mensajes a s&iacute; mismo.');
        } else if(parseInt(h) == 2) {
            mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'Este usuario no existe. Por favor, verif&iacute;calo.');
        }    
    },
    alert: function(h){
      mydialog.procesando_fin();
      mydialog.alert('Aviso','<div class="emptyData">' + h + '</div>');  
    },
    mostrar: function(show, obj){
        //
        $('.GBTabset a').removeClass('here');
        //
        if(show == 'all'){
            $('#mensajes div').show();
            $(obj).addClass('here');
        } else if(show == 'unread'){
            $('#mensajes div.GBThreadRow').hide();
            $('#mensajes table.unread').parent().show();
            $(obj).addClass('here');
        }
    },
    select: function(act){
        //
        var inputs = $('#mensajes .GBThreadRow :input');
        inputs.each(function(){
           if(act == 'all'){
            $(this).attr({checked: 'checked'});
           } else if(act == 'read'){
                if($(this).attr('class') != 'inread'){
                    $(this).attr({checked: 'checked'});
                } else $(this).attr({checked: ''});
           } else if(act == 'unread'){
                if($(this).attr('class') == 'inread'){
                    $(this).attr({checked: 'checked'});
                } else $(this).attr({checked: ''});                
           } else if(act == 'none'){
            $(this).attr({checked: ''});
           }
        });
    },
    modificar: function(act){
        var inputs = $('#mensajes .GBThreadRow :input');
        var ids = new Array();
        var i = 0;
        //
        inputs.each(function(){
            var este = $(this).attr('checked');
            //
            if(este != false){
                // AGREGAR EL ID
                ids[i] = $(this).val();
                i++;
                // PARA LOS ESTILOS
                var cid = $(this).val().split(':');
                // MARCAR LEIDO
                if(act == 'read'){
                    $('#' + cid[0]).removeClass('unread');
                    $(this).removeClass('inread');
                // MARCAR NO LEIDO
                } else if(act == 'unread'){
                    $('#' + cid[0]).addClass('unread');
                    $(this).addClass('inread');
                // ELIMINAR
                } else if(act == 'delete'){
                    $('#' + cid[0]).parent().remove();
                }
            }
        });
        // ENVIAR CAMBIOS
        if(ids.length > 0){
            var params = ids.join(',');
            mensaje.ajax('editar','ids=' + params + '&act=' + act,function(r){
                //
            });   
        }
    },
    eliminar: function(id,type){
        mensaje.ajax('editar','ids=' + id + '&act=delete',function(r){
            if(type == 1){
                var cid = id.split(':');
                $('#mp_' + cid[0]).remove();
             }else if(type == 2){
                location.href = global_data.url + '/mensajes/';
             }
        });
    },
    marcar: function(id, a, type, obj){
        var act = (a == 0) ? 'read' : 'unread';
        var show = (act == 'read') ? 'unread' : 'read';
        
        //
        mensaje.ajax('editar','ids=' + id + '&act=' + act,function(r){
            // CAMBIAR ENTRE LEIDO Y NO LEIDO
            if(type == 1){
                var cid = id.split(':');
                if(act == 'read')
                $('#mp_' + cid[0]).removeClass('unread');
                else 
                $('#mp_' + cid[0]).addClass('unread');
                //
                $(obj).parent().find('a').hide();
                $(obj).parent().find('.' + show).show();
             } else {
                location.href = global_data.url + '/mensajes/';
             }
        });
    },
    // POST
    ajax: function(action, params, fn){
        $('#loading').fadeIn(250);
        $.ajax({
    		type: 'POST',
    		url: global_data.url + '/mensajes-' + action + '.php',
    		data: params,
    		success: function(h){
                fn(h);
                $('#loading').fadeOut(350);                
    		}
    	});
    },
    // PREPARAR EL ENVIO
	nuevo: function (para, asunto, body, error){
        // GUARDAR
        this.vars['to'] = para;
        this.vars['sub'] = asunto;
        this.vars['msg'] = body;
        this.vars['error'] = error;
        //
        mydialog.procesando_fin();
		mydialog.show(true);
		mydialog.title('Nuevo mensaje');
		mydialog.body(this.form());
		mydialog.buttons(true, true, 'Enviar', 'mensaje.enviar(0)', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
	},
    // ENVIAR...
    enviar: function (enviar){
        // DATOS
        this.vars['to'] = $('#msg_to').val();
        this.vars['sub'] = encodeURIComponent($('#msg_subject').val()); // FIX: 14/12/2014 - 1.1.000.9
        this.vars['msg'] = encodeURIComponent($('#msg_body').val()); // FIX: 14/12/2014 - 1.1.000.9
        // COMPROBAR
        if(enviar == 0){ // VERIFICAR...
            if(this.vars['to'] == '')
                mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'Por favor, especific&aacute; el destinatario.');
            if(this.vars['msg'] == '')
                mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'El mensaje esta vac&iacute;o.');
            //
            mydialog.procesando_inicio('Verificando...', 'Nuevo Mensaje');
            this.ajax('validar', 'para=' + this.vars['to'], mensaje.checkform);

        } else if(enviar == 1){
            mydialog.procesando_inicio('Enviando...', 'Nuevo Mensaje');
            // ENVIAR
            this.ajax('enviar', 'para=' + mensaje.vars['to'] + '&asunto=' + mensaje.vars['sub'] + '&mensaje=' + mensaje.vars['msg'], mensaje.alert);
        }
    },
    // RESPONDER
    responder: function(mp_id){
        this.vars['mp_id'] = $('#mp_id').val();
        this.vars['mp_body'] = encodeURIComponent($('#respuesta').val()); // Fix: 14/12/2014 - 1.1.000.9
        if(this.vars['mp_body'] == '') {
            $('#respuesta').focus();
            return;
        }
        //
        this.ajax('respuesta','id=' + this.vars['mp_id'] + '&body=' + this.vars['mp_body'], function(h){
            $('#respuesta').val(''); // LIMPIAMOS
            switch(h.charAt(0)){
                case '0':
                    mydialog.alert("Error", h.substring(3));
                break;
                case '1':
					$('#historial').append($(h.substring(3)).fadeIn('slow'));
                break;
            }
            $('#respuesta').focus();
        });
    },
	last: function () {
		var c = parseInt($('#alerta_mps > a > span').html());
        notifica.close();
        //
		if ($('#mp_list').css('display') != 'none') {
			$('#mp_list').hide();
			$('a[name=Mensajes]').parent('li').removeClass('monitor-notificaciones');
		}
		else {
			if (($('#mp_list').css('display') == 'none' && c > 0) || typeof mensaje.cache.last == 'undefined') {
				$('a[name=Mensajes]').children('span').addClass('spinner');
				$('a[name=Mensajes]').parent('li').addClass('monitor-notificaciones');
				$('#mp_list').show();
				mensaje.ajax('lista', '', function (r) {
					mensaje.cache['last'] = r;
					mensaje.show();
				});
			}
			else mensaje.show();
		}
	},
	popup: function (mps) {
		var c = parseInt($('#alerta_mps > a > span').html());
		if (mps != c && mps > 0) {
            if (mps != 1) var mps_total = ' mensajes'; else var mps_total = ' mensaje';
			if (!$('#alerta_mps').length) $('div.userInfoLogin > ul > li.mensajes').append('<div class="alertas" id="alerta_mps"><a title="' + mps + mps_total + '"><span></span></a></div>');
			$('#alerta_mps > a > span').html(mps);
			$('#alerta_mps').animate({ top: '-=5px' }, 100, null, function(){ $('#alerta_mps').animate({ top: '+=5px' }, 100) });
		}
		else if (mps == 0) $('#alerta_mps').remove();
	},
	show: function () {
		if (typeof mensaje.cache.last != 'undefined') {
			$('#alerta_mps').remove();
			$('a[name=Mensajes]').parent('li').addClass('monitor-notificaciones');
			$('a[name=Mensajes]').children('span').removeClass('spinner');
			$('#mp_list').show().children('ul').html(mensaje.cache.last);
			$('#mp_list > ul > li > a[title]').tipsy({ gravity: 's' });
		}
	},
    close: function(){
        $('#mp_list').slideUp();
        $('a[name=Mensajes]').parent('li').removeClass('monitor-notificaciones');
    }
}

var timelib = {
	current: false,
	iupd: 60,
	timetowords: function (x) {
		if (!this.current) return r;
		var r = false;
		var t = {
			s: {
				year: 'M&aacute;s de 1 a&ntilde;o',
				month: 'M&aacute;s de 1 mes',
				day: 'Ayer',
				hour: 'Hace 1 hora',
				minute: 'Hace 1 minuto',
				second: 'Menos de 1 minuto'
			},
			p: {
				year: 'M&aacute;s de $1 a&ntilde;os',
				month: 'M&aacute;s de $1 meses',
				day: 'Hace $1 d&iacute;as',
				hour: 'Hace $1 horas',
				minute: 'Hace $1 minutos',
				second: 'Menos de 1 minuto'
			}
		};
		var n = this.current - x;
		var d = { year: 31536000, month: 2678400, day: 86400, hour: 3600, minute: 60, second: 1 };
		for (k in d) {
			if (n >= d[k]) {
				var c = Math.floor(n / d[k]);
				if (c == 1) r = t.s[k];
				else if (c > 1) r = t.p[k].replace('$1', c);
				else r = 'Hace mucho tiempo';
				break;
			}
		}
		return r ? r : 'Hace instantes';	
	},
	upd: function () {
		setTimeout(function(){
			if (this.current) {
				timelib.current = timelib.current + timelib.iupd;
				$('span[ts]').each(function(){ $(this).html(timelib.timetowords($(this).attr('ts'))); });
			}
			timelib.upd()
		}, this.iupd * 1000);
	}
}

function brand_day(enable) {
	var site = global_data.domain;
	document.cookie = 'brandday='+(enable ? 'on' : 'off')+';expires=Tue, 25 May 2010 00:00:00 GMT-3;path=/;domain=.'+site;
	window.location.reload();
}


/* extras */
function emoticones(){ 
	var winpops=window.open(global_data.url + "/emoticones.php","","width=180px,height=500px,scrollbars,resizable");
}
// POST COMMENTS
	function com_page(postid, page, autor){
		$('#com_gif').show();
        $('#loading').fadeIn(250);
		//
		$.ajax({
			type: 'POST',
			url: global_data.url + '/comentario-ajax.php?page=' + page,
			data: 'postid=' + postid + '&autor=' + autor,
			success: function(h){
				$('#comentarios').html(h);
				//
				set_pages(postid, page, autor);
				//
                $('#loading').fadeOut(350);
                //
			}
		});
		//
		return false;
	}
	// PAGINAS PARA LOS COMENTARIOS EN POSTS
	function set_pages(postid, page, autor){
		var total = parseInt($('#ncomments').text());
		//
        $('#loading').fadeIn(250);
		$.ajax({
			type: 'POST',
			url: global_data.url + '/comentario-pages.php?page=' + page,
			data: 'postid=' + postid + '&autor=' + autor + '&total=' + total,
			success: function(h){
				$('.paginadorCom').html(h);
				$('#com_gif').fadeOut();
                $('#loading').fadeOut(350);
			}
		});
	}