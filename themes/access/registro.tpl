{extends "layout_main.tpl"}

{block "main"}
<div class="container w-75 bg-dark rounded overflow-auto shadow">
	<div class="row align-items-stretch bg" id="RegistroForm">
		<div class="col d-none d-lg-flex justify-content-lg-center align-items-lg-center col-md-5 col-lg-5 col-xl-6 rounded-start">
			<i class="bi bi-lightning bi-icons"></i>
		</div>
		<div class="col bg-w50 p-5 rounded-end pasoUno">

			<div class="form-floating mb-4">
		      <input name="nick" onfocus="registro.focus(this);this.removeAttribute('readonly');" readonly type="text" id="nick" class="form-control" tabindex="1" placeholder=" " onblur="registro.blur(this)" onkeydown="registro.clear_time(this.name)" onkeyup="registro.set_time(this.name)" autocomplete="off" required /> 
		      <label for="nick">Crea tu nick</label>
		      <div class="help"><span><em></em></span></div>
		   </div>

			<div class="form-floating mb-4">
		      <input name="password" type="password" id="password" class="form-control" tabindex="2" onfocus="registro.focus(this);this.removeAttribute('readonly');" readonly placeholder=" " onblur="registro.blur(this)" autocomplete="off" required /> 
		      <label for="password">Contrase&ntilde;a</label>
		      <a title="Mostrar contraseña" id="show_password"><i class="bi bi-eye"></i></a>
		      <div class="help"><span><em></em></span></div>
		   </div>

		   <div class="form-floating mb-4">
		      <input name="email" type="text" id="email" class="form-control" tabindex="3" placeholder=" " onblur="registro.blur(this)" onfocus="registro.focus(this);this.removeAttribute('readonly');" readonly onkeydown="registro.clear_time(this.name)" onkeyup="registro.set_time(this.name)" autocomplete="off" required /> 
		      <label for="email">E-mail</label>
		      <div class="help"><span><em></em></span></div>
		   </div>
		   <div class="form-floating">
		      <input type="hidden" name="g-recaptcha-response" id="response" class="g-recaptcha">
		      <div class="help"><span><em></em></span></div>
		   </div>

		   <div class="form-floating mb-4">
	         <select id="genero" class="form-select" name="sexo" tabindex="4" onblur="registro.blur(this)" onchange="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Selecciona tu g&eacute;nero" required>
	            <option value="">Seleccionar g&eacute;nero</option>
	            <option value="1">Masculino</option>
	            <option value="0">Femenino</option>
	         </select>
	         <label for="sexo">G&eacute;nero</label>
	         <div class="help"><span><em></em></span></div>
	      </div>  

			<div class="d-grid gap-2">
				<a href="javascript:registro.submit()" class="btn btn-sm btn-primary btn-block btn-registro text-uppercase font-weight-bold mb-2">Registrarme</a>
				<small class="text-muted">Al registrarme en {$tsConfig.titulo} estoy aceptando los <a href="{$tsConfig.url}/pages/terminos-y-condiciones/" target="_blank">T&eacute;rminos y Condiciones</a> del sitio</small>
			</div>

		</div>
	</div>
</div>
{/block}

{block "foot-javascript"}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js?{$smarty.now}"></script>
{if $tsConfig.c_reg_active == 1}
<script src="https://www.google.com/recaptcha/api.js?render={$tsPKey}"></script>
<script src="{$tsConfig.url}/themes/access/assets/registro.js?{$smarty.now}"></script>
<script>
	$('input[name=password]').on('keyup', function() {
	   p = $(this).val().length;
	   t = 5;
	   if (p > t) $('#show_password').show();
	   else $('#show_password').hide();
	   // Mostramos contraseña
		$('#show_password').on('click', function(e){
		   e.preventDefault();
		   var newType = $('#password').attr('type') == 'text' ? 'password' : 'text';
		   $('#password').attr('type', newType);
		   $('#show_password > i').toggleClass('bi-eye-slash', 'bi-eye');
		});
	});

   grecaptcha.ready(function () {
      grecaptcha.execute('{$tsPKey}', {ldelim}action: 'submit'{rdelim}).then(function (token) {
         var response = document.getElementById('response');
         response.value = token;
      });
   });
</script>
{/if}
{/block}