const ButtonLoading = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Iniciando...`;

function regresar(name) {
   name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
   var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
   results = regex.exec(location.search);
   return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
/* Buscamos el parámetros | Mostramos URL | Si se usa en xampp | Reemplazamos /login por nada */
var Redireccionar = regresar('r'), 
MyUrl = window.location.origin, 
Local = window.location.pathname, 
l2 = Local.replace('/acceder', '');

function codificar(campo) {
	codificado = encodeURIComponent(campo);
	return codificado; 
}
//.fadeIn(250)

function msg(tipo, msg) {
	return Swal.fire({
  		icon: (tipo == 0) ? 'error' : 'success',
  		html: msg
	});
}

var login = {
	iniciar: function() {
		param = 'nick=' + codificar($('#usuario').val());
		param += '&pass=' + codificar($('#contraseña').val());	
		param += '&rem=' + ($('#recordarme').is(':checked') ? $('#recordarme').is(':checked') : false);
		url = window.location.pathname;
		url = url.replace('/acceder', '');
		$.ajax({
			type: 'POST',
			url: global_data.url + '/login-user.php',
			cache: false,
			data: param,
			beforeSend: function() {
				$('#antes').html(ButtonLoading);
			}
		}).done(function(rsp) {
			switch(rsp.charAt(0)) {
				case '0':
					msg(0, rsp.substring(3));
					$('#antes').html('Iniciar sesión');
				break;
				case '1':
					(Redireccionar != '') ? location.href = Redireccionar : (window.location.pathname) ? location.href = MyUrl + l2 : location.href = MyUrl;
	            $('#loading').fadeOut(350);
					$('#antes').html('Iniciar sesión');
				break;
				case '2':
					mydialog.show(true);
					mydialog.title('Doble factor');
					mydialog.body("<div class=\"form-floating\"><input type=\"text\" class=\"form-control shadow\" placeholder=\" \" name=\"code\" required><label for=\"usuario\">Código de autentificación</label><div class=\"text-secondary pt-1 fst-italic small\">Abra la aplicación de autenticación de dos factores en su dispositivo para ver su código de autenticación y verificar su identidad.</div></div>");
					mydialog.buttons(true, true, 'Continuar', `javascript:twoFactor()`, true, true, true, 'Cancelar', 'close', true, false);		
					mydialog.center();
				break;
			}
		}).fail(function(fail) {
			msg(0, 'Error al processar!');
		}).always(function(h) {
			$('#load').css('background-color', '#285e61CC');
			$('#load p').html('Redireccionando a <b>'+global_data.s_title+'</b>');
			$('#loading').fadeOut(250);
		});
	},
}

function twoFactor() {
	input = 'code='+$('input[name=code]').val();
	input += '&user='+$('input[name=nick]').val();
	input += '&rem='+$('input[name=rem]').is(':checked');
	$.post(global_data.url + '/login-validate.php', input, function(rsp) {
		if(rsp == true) {
			location.href = (window.location.pathname) ? MyUrl + l2 : MyUrl;
		}
	});
}

function rememberVerification(gew, type){
   var file = (type == 'pass') ? 'recover-pass' : 'recover-validation';
	
	if(!gew){
		mydialog.show(true);
		mydialog.title((type == 'pass') ? 'Recuperar Contrase&ntilde;a' : 'Reenviar validaci&oacute;n');
		mydialog.body('<div class="form-floating"><input type="text" tabindex="1" name="r_email" id="r_email" class="form-control" placeholder=" " maxlength="35"/><label for="r_email">Correo electr&oacute;nico:</label></div>');
		mydialog.buttons(true, true, 'Continuar', `javascript:rememberVerification(true, '${type}')`, true, true, true, 'Cancelar', 'close', true, false);		
		mydialog.center();
	} else {
		var r_email = $('#r_email').val();
		$.ajax({
			type: 'POST',
			url: global_data.url + '/' + file + '.php',
			data: 'r_email=' + r_email,
			beforeSend: function(e) {
				mydialog.body('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...');
			},
			success: function(a) {
				console.log(a);
				Swal.fire({
					icon:(a.charAt(0) ? 'error' : 'success'),
					title:(a.charAt(0) ? 'Opps!' : 'Hecho!'),
					html:a.substring(3)
				});
			}
		});
	}
}

$('#usuario').on('keyup', function(){
	$.post(global_data.url + '/login-usuario.php', 'user=' + $(this).val(), function(uid) {
		src = (uid != 0) ? '/files/avatar/' + uid + '_120.jpg' : '/assets/images/favicon.ico';
		$('.nr__logo > img').attr('src', global_data.url + src);
	});
});
$('#facebook, #google').on('click', function(e) {
	Swal.fire({icon:'warning',text:'El acceso con las redes no esta habilitado.'});
});