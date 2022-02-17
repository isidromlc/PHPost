login_ajax = () => {
	if( empty($("#nickname").val()) ) {
		$("#nickname").focus();return
	}
	if( empty($("#password").val()) ) {
		$("#password").focus();return
	}
	// Datos a enviar
	let dato = [
		'nick=' + encodeURIComponent($("#nickname").val()),
		'pass=' + encodeURIComponent($("#password").val()),
		'rem=' + $("#rem").is(':checked')
	].join("&");
	// Imagen de cargando
	$(".login_cuerpo").append('<div id="login_cargando"><img src="'+global_data.img+'images/large-loading.gif" width="32" height="32" alt="Iniciando sesion"></div>');
	// Envio los datos
	$.post(global_data.url + "/login-user.php", dato, response => {
		switch (response.charAt(0)) {
			case '0':
				$("#login_error").html(response.substring(3)).show()
				$("#login_cargando").remove()
			break;
			// Iniciamos sesion
			case '1':
				setTimeout(() => (response.charAt(0) != '1' ? location.href = response.substring(3) : location.reload()), 1500)
			break;
		}
	})
	.fail(() => {
		$("#login_error").html('Error al procesar la petici&oacute;n')
		$("#login_cargando").remove()
	})
}