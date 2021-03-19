/** 
 * https://locutus.io/php/strpos/ 
 * https://locutus.io/php/empty/ 
*/
function strpos(e,r,t){var n=(e+"").indexOf(r,t||0);return-1!==n&&n}
function empty(e){var r,t,n,i=[void 0,null,!1,0,"","0"];for(t=0,n=i.length;t<n;t++)if(e===i[t])return!0;if("object"==typeof e){for(r in e)if(e.hasOwnProperty(r))return!1;return!0}return!1}

/* Registro */
var registro = {
   datos: new Array(),
   datos_status: new Array(),
   datos_text: new Array(),
   cache: new Array(),
   times: new Array(),
   times_sets: new Array(),
   //Un elemento obtiene el foco
   focus: function(el) {
      var name = $(el).attr('name');     
      $(el).addClass('selected');
      this.show_status(el, 'info', $(el).attr('title'), true);
   },
   //Un elemento pierde el foco
   blur: function(el) {
      var name = $(el).attr('name');
      switch (name) {
         case 'nick':
         case 'email':
            this.clear_time(name);
            $(el).removeClass('selected');
            this.check_campo(el, false, true);
         break;
         default:
            $(el).removeClass('selected');
            this.check_campo(el, false, true);
         break;
      }  
   },
   set_time: function(name) {
      if (this.times_sets[name]) return false;
      this.times_sets[name] = true;
      this.times[name] = setTimeout("registro.time('" + name + "')", 500);
   },
   clear_time: function(name) {
      if (!this.times_sets[name]) return false;
      this.times_sets[name] = false;
      clearTimeout(this.times[name]);
   },
   time: function(name) {
      var el = $('#' + name);
      if (empty($(el).val())) this.show_status(el, 'info', $(el).attr('title'), true);
      else this.check_campo(el, false, true);
   },
   // Chequeamos los campos
   check_campo: function(el, no_empty, force_check) {
      var campo = $(el).attr('name'), value = $(el).val();
      switch (campo) {
         /* Nick */
         case 'nick':
            //Si ya paso por aca y no hubieron cambios, devuelvo el mismo status
            if (!force_check && this.datos[campo] === value) {
               if (this.datos_status[campo] == 'empty') {
                  return no_empty ? this.show_status(el, this.datos_status[campo], this.datos_text[campo]) : this.hide_status(el, this.datos_status[campo], this.datos_text[campo]);
               } else {
                  return this.show_status(el, this.datos_status[campo], this.datos_text[campo]);
               }
            }
            //Almaceno el dato
            this.datos[campo] = value;
            //!empty
            if (empty(value)) {
               var status = 'empty';
               var text = 'El campo es requerido';
               if (no_empty) {
                  return this.show_status(el, status, text);
               } else {
                  return this.hide_status(el, status, text);
               }
            }
            // Tamaño min y max
            if (value.length < 4 || value.length > 16) return this.show_status(el, 'error', 'Debe tener entre 4 y 16 caracteres');
            //No solo numeros
            if (!/[^0-9]/.test(value))
               return this.show_status(el, 'error', 'No puede contener solo numeros');
            //Caracteres validos
            if (/[^a-zA-Z0-9_]/.test(value))
               return this.show_status(el, 'error', 'S&oacute;lo se permiten letras, n&uacute;meros y guiones(_)');
            //Compruebo el Cache
            var value_lower = value.toLowerCase();
            if (!this.cache[campo]) {
               this.cache[campo] = new Array();
               this.cache[campo][value_lower] = new Array();
            } else if (this.cache[campo][value_lower]) {
               if (this.cache[campo][value_lower]['status']) {
                  return registro.show_status(el, 'ok', this.cache[campo][value_lower]['text']);
               } else {
                  return registro.show_status(el, 'error', this.cache[campo][value_lower]['text']);
               }
            }
            this.show_status(el, 'loading', 'Comprobando nick...');
            $('#loading').fadeIn(250);
            $.ajax({
               type: 'POST',
               url: global_data.url + '/registro-check-nick.php?t=nombre de usuario',
               data: 'nick=' + value,
               success: function(h) {
                  registro.cache[campo][value_lower] = new Array();
                  registro.cache[campo][value_lower]['text'] = h.substring(3);
                  switch (h.charAt(0)) {
                     case '0': //Estaba en uso
                        registro.cache[campo][value_lower]['status'] = false;
                        registro.show_status(el, 'error', h.substring(3));
                     break;
                     case '1': //No esta en uso
                        registro.cache[campo][value_lower]['status'] = true;
                        registro.show_status(el, 'ok', h.substring(3));
                     break;
                  }
                  $('#loading').fadeOut(350);
               },
               error: function() {
                  registro.show_status(el, 'error', 'Hubo un error al intentar procesar lo solicitado');
                  registro.datos[campo] = '';
               }
            });
         break;
         /* password */
         case 'password':
            //Si ya paso por aca y no hubieron cambios, devuelvo el mismo status
            if (!force_check && this.datos[campo] === value) {
               if (this.datos_status[campo] == 'empty') {
                  return no_empty ? this.show_status(el, this.datos_status[campo], this.datos_text[campo]) : this.hide_status(el, this.datos_status[campo], this.datos_text[campo]);
               } else {
                  return this.show_status(el, this.datos_status[campo], this.datos_text[campo]);
               }
            }
            //Almaceno el dato
            this.datos[campo] = value;
            //!empty
            if (empty(value)) {
               var status = 'empty', text = 'El campo es requerido';
               if (no_empty) {
                  return this.show_status(el, status, text);
               } else {
                  return this.hide_status(el, status, text);
               }
            }
            //ContraseÃ±a === nick
            if (value === this.datos['nick']) return this.show_status(el, 'error', 'La contrase&ntilde;a tiene que ser distinta que el nick');
            // Tamaño
            if (value.length < 5 || value.length > 35) return this.show_status(el, 'error', 'Debe tener entre 5 y 35 caracteres');
            //OK
            return this.show_status(el, 'ok', 'OK');
         break;
         /* email */
         case 'email':
            value = value.toLowerCase();
            //Si ya paso por aca y no hubieron cambios, devuelvo el mismo status
            if (!force_check && this.datos[campo] === value){
               if (this.datos_status[campo] == 'empty') {
                  return no_empty ? this.show_status(el, this.datos_status[campo], this.datos_text[campo]) : this.hide_status(el, this.datos_status[campo], this.datos_text[campo]);
               } else {
                  return this.show_status(el, this.datos_status[campo], this.datos_text[campo]);
               }
            }
            //Almaceno el dato
            this.datos[campo] = value;
            if (empty(value)) {
               var status = 'empty', text = 'El campo es requerido';
               if (no_empty) return this.show_status(el, status, text);
               else return this.hide_status(el, status, text);
            }
            // Tamaño
            if (value.length > 35) return this.show_status(el, 'error', 'El email es demasiado largo');
            //Caracteres validos
            if (!/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.exec(value)) return this.show_status(el, 'error', 'El formato es incorrecto');
            //Compruebo el Cache
            if (!this.cache[campo]) {
               this.cache[campo] = new Array();
               this.cache[campo][value] = new Array();
            } else if (this.cache[campo][value]) {
               if (this.cache[campo][value]['status']) {
                  return registro.show_status(el, 'ok', this.cache[campo][value]['text']);
               }else {
                  return registro.show_status(el, 'error', this.cache[campo][value]['text']);
               }
            }
            this.show_status(el, 'loading', 'Comprobando email...');
            $('#loading').fadeIn(250);
            $.ajax({
               type: 'POST',
               url: global_data.url + '/registro-check-email.php?t=email',
               data: 'email=' + value,
               success: function(h) {
                  registro.cache[campo][value] = new Array();
                  registro.cache[campo][value]['text'] = h.substring(3);
                  switch (h.charAt(0)) {
                     case '0': //Estaba en uso
                        registro.cache[campo][value]['status'] = false;
                        registro.show_status(el, 'error', h.substring(3));
                     break;
                     case '1': //No esta en uso
                        registro.cache[campo][value]['status'] = true;
                        registro.show_status(el, 'ok', 'OK');
                     break;
                  }
                  $('#loading').fadeOut(350);
               },
               error: function() {
                  registro.show_status(el, 'error', 'Hubo un error al intentar procesar lo solicitado');
                  registro.datos[campo] = '';
                  $('#loading').fadeOut(350);
               }
            });
         break;
         /* Sexo */
         case 'sexo':
            $(document).on('change', '#genero', function(event) {
               value = $("#genero option:selected").val();
            });
            //Si ya paso por aca y no hubieron cambios, devuelvo el mismo status
            if (this.datos[campo] === value){
               if (this.datos_status[campo] == 'empty') {
                  return no_empty ? this.show_status(el, this.datos_status[campo], this.datos_text[campo]) : this.hide_status(el, this.datos_status[campo], this.datos_text[campo]);
               } else {
                  return this.show_status(el, this.datos_status[campo], this.datos_text[campo]);
               }
            }
            //Almaceno el dato
            this.datos[campo] = value;
            //!empty
            if (empty(value)) {
               var status = 'empty', text = 'El campo es requerido';
               if (no_empty) return this.show_status(el, status, text);
               else return this.hide_status(el, status, text);
            }
            return this.show_status(el, 'ok', 'OK');
         break;
         /* ReCaptcha V3 */
         case 'recaptcha_response_field':﻿﻿﻿
            this.datos['g-recaptcha-response'] = $('#response').val();﻿﻿﻿﻿
         break;
         /* reCAPTCHA */
         case 'g-recaptcha-response':
            this.datos[campo] = value;
            //!empty
            if (!value) {
               return this.show_status($('.g-recaptcha'), 'empty', 'Demuestra que eres humano');
            }
            return registro.show_status($('.g-recaptcha'), 'ok', 'OK');
         break;
      }
   },

   show_status: function(el, status_aux, text, no_cache_data) {
      var campo = $(el).attr('name');
      var status = (status_aux == 'empty') ? 'error' : status_aux;
      //Si es reCAPTCHA, lo busco directamente
      if (campo == 'recaptcha_response_field') el = $('.pasoUno .help');
      else { //Paso al siguiente elemento hasta encontrar un .help
         do {
            el = $(el).next();
         } while (!$(el).is('.help'));
      }
      $(el).removeClass('ok').removeClass('error').removeClass('info').removeClass('loading').addClass(status).show().children().children().html(text);

      if (!no_cache_data) {
         this.datos_status[campo] = status_aux;
         this.datos_text[campo] = text;
      }
      return (status == 'ok');
   },
   hide_status: function(el, status, text) {
      var campo = $(el).attr('name');
      //Si es reCAPTCHA, lo busco directamente
      if (campo == 'recaptcha_response_field') el = $('.pasoUno .help');
      else { //Paso al siguiente elemento hasta encontrar un .help
         do {
            el = $(el).next();
         } while (!$(el).is('.help'));
      }

      $(el).hide();

      this.datos_status[campo] = status;
      this.datos_text[campo] = text;
      return (status == 'ok');
   },

   //Envio los datos y completo el registro
   submit: function(h) {
      var inputs = $('.pasoUno :input');
      inputs.each(function() { if (!registro.check_campo(this, true)) ok = false; });
      //Oculto todos los mensajes informativos
      $('.help').hide();

      var params = '', amp = '';
      for (var campo in this.datos) {
         params += amp + campo + '=' + encodeURIComponent(this.datos[campo]);
         amp = '&';
      }
      //Envio los datos
      $('#loading').fadeIn(250);
      $.ajax({
         type: 'POST',
         url: global_data.url + '/registro-nuevo.php',
         data: params,
         beforeSend: function() {
            $('.d-grid > a').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creando el perfil del usuario...');
         },
         success: function(h) {
            switch (h.substring(0, strpos(h, ':'))) {
               case 'nick': //Error nick
                  registro.show_status($('#nick'), 'error', h.substring(strpos(h, ':') + 2));
               break;
               case 'password': //Password
                  registro.show_status($('#password'), 'error', h.substring(strpos(h, ':') + 2));
               break;
               case 'email': //Email
                  registro.show_status($('#email'), 'error', h.substring(strpos(h, ':') + 2));
               break;
               case 'sexo': //Email
                  registro.show_status($('#sexo'), 'error', h.substring(strpos(h, ':') + 2));
               break;
               case 'recaptcha': //reCAPTCHA
                  registro.show_status($('#response'), 'error', h.substring(strpos(h, ':') + 2));
               break;
               case '0':
               break;
               case '1':
                  $('#RegistroForm').html(h.substring(strpos(h, ':') + 2));
               break;
               case '2':
                  $('#RegistroForm').html(h.substring(strpos(h, ':') + 2));
               break;
            }
            $('#loading').fadeOut(350);
         },
         error: function() {
            $('#load').hide();
            $('#loading').fadeOut(350);
            $('.d-grid > a').html('Registrarme');
         },
         complete: function() {
            $('#loading').fadeOut(450);
         }
      });
   }
}


// REDIRECCIONAR
function redireccionar() {
   $('#load').append('<div id="load"><svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g fill="none" fill-rule="evenodd"><g transform="translate(1 1)" stroke-width="2"><circle stroke-opacity=".5" cx="18" cy="18" r="18"/><path d="M36 18c0-9.94-8.06-18-18-18"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"/></path></g></g></svg><p>Redireccionando a tu cuenta...</p></div>');
   location.href = global_data.url + '/cuenta/';
}