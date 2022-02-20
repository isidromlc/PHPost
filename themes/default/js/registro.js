// Comprobamos con patrones
var expresiones = {
   nick: /^[a-zA-Z0-9\_\-]{4,20}$/,
   password: /^.{4,32}$/,
   email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}
// Verificamos
var Approved = {
   nick: false,
   password: false,
   email: false
}
/**
 * Función para mostrar errores
*/
mostrarError = params => {
   $(params.campo).parent().addClass(params.clase).removeClass(params.quitar).find("#helper").html(params.mensaje);
   return (params.clase == 'invalid' ? false : true);
}
/**
 * Función para chequear campos
*/
ChequearCampos = params => {
   // Primero chequeamos con las expresiones regulares
   let texto = $(params.campo).val();
   if(params.expresion.test(texto)) {
      // Si es 0 = FALSE | Si es 1 = TRUE
      return mostrarError({
         campo: params.campo,
         mensaje: params.mensaje,
         clase: (parseInt(params.accion) === 0 ? 'invalid' : 'valid'),
         quitar: (parseInt(params.accion) !== 0 ? 'invalid' : 'valid')
      });

   } else return false;
}

// Cargamos el token
$(document).ready(() => {
   grecaptcha.ready(
      () => grecaptcha.execute(public_key, {action: 'submit'})
      .then(token => response.value = token)
   );
});

var validar = e => {
   target = e.target;
   var helper = $(`#register_${target.name}`).parent().find("#helper").addClass("text-muted");

   switch (target.name) {
      case 'nick':
      case 'email':
         campo = target.name;
         helper.html("<em>Comprobando "+campo+"</em>");
         data = (campo == 'nick') ? {nick:target.value} : {email:target.value};
         $.post(`${global_data.url}/registro-check-${campo}.php`, data, h => {
            Approved[campo] = ChequearCampos({
               expresion: (campo == 'nick' ? expresiones.nick : expresiones.email),
               campo: (campo == 'nick' ? '#register_nick' : '#register_email'), 
               mensaje: h.substring(3), 
               accion: h.charAt(0)
            });
         });
      break;
      case 'password':
      case 'password2':
         helper.html("<em>Comprobando constraseña</em>");
         pass1 = $("#register_password")
         pass2 = $("#register_password2")
         nick2 = $("#register_nick")
         if(target.name == 'password') {
            msg = (pass1.val() === nick2.val()) ? 'No puede ser igual al Nick' : '';
            accion = (pass1.val() === nick2.val()) ? '0' : '1';
         } else {
            msg = (pass2.val() !== pass1.val()) ? 'Tus contraseñas deben ser iguales' : '';
            accion = (pass2.val() !== pass1.val()) ? '0' : '1';
         }
         Approved['password'] = ChequearCampos({
            expresion: expresiones.password,
            campo: (target.name == 'password' ? "#register_password" : "#register_password2"),
            mensaje: msg,
            accion: accion
         });
         
      break;
   }
}

var inputs = [].slice.call(document.querySelectorAll("form[name=formulario] input"))
inputs.forEach( input => {
   $(input).on('focus blur', validar)
   $(input).on('keyup', validar)
})

$("#terminos").on('click', () => {
   if(open) $("#registrarme").removeClass('disabled').removeAttr('disabled');
   else $("#registrarme").addClass('disabled').attr('disabled');
   open = (!open) ? true : false;
})
$('form[name=formulario]').on('submit', e => {
   e.preventDefault();
   $("#dualRegister").append('<div class="registro--box__loading"><div class="loading"></div></div>')
   if(Approved.nick && Approved.password && Approved.email && document.formulario.terminos.checked) {
      $.post(`${global_data.url}/registro-nuevo.php`, $('form[name=formulario]').serialize(), h => {

         switch(h.charAt(0)){
            case '0':
               mydialog.alert('Error', h.substring(3));
               $("#dualRegister").remove();
            break;
            case '1':
            case '2':
               mydialog.show(true);
               mydialog.title('Vamos');
               mydialog.body(h.substring(3));
               mydialog.buttons(true, true, 'Aceptar', (h.charAt(0) == 1 ? 'mydialog.close()' : 'recargar()'), true, false, false);
               mydialog.center();
               $("#dualRegister").remove();
            break;
         }
      })
   } else mydialog.alert('Error', 'Por favor, rellene todos los campos.');
});

recargar = () => location.href = global_data.url + '/cuenta/';