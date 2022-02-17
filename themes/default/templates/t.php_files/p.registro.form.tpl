1:
<div id="RegistroForm">
	<!-- Paso Uno -->
	<div class="pasoUno">

		<div class="form-line">
			<label for="nick">Ingresa tu usuario</label>
			<input type="text" id="nick" class="field-input" tabindex="1" name="nick" placeholder="Ingrese un nombre de usuario &uacute;nico">
			<small id="helper"></small>
		</div>

		<div class="form-line">
			<label for="password">Contrase&ntilde;a deseada</label>
			<input name="password" type="password" id="password" class="field-input" tabindex="2" placeholder="Ingresa una contrase&ntilde;a segura" /> 
			<small id="helper"></small>
		</div>

		<div class="form-line">
			<label for="password2">Confirme contrase&ntilde;a</label>
			<input name="password2" type="password" id="password2" class="field-input" tabindex="3" title="Vuelve a ingresar la contrase&ntilde;a" /> 
			<small id="helper"></small>
		</div>

		<div class="form-line">
			<label for="email">E-mail</label>
			<input name="email" type="text" id="email" class="field-input" tabindex="4" title="Ingresa tu direcci&oacute;n de email" /> 
			<small id="helper"></small>
		</div>

		<div class="form-line">
			<label for="sexo">Sexo</label>
			<div class="switch-field">
				<input type="radio" id="sexo_m" name="sexo" value="1" checked/>
				<label for="sexo_m">Masculino</label>
				<input type="radio" id="sexo_f" name="sexo" value="0" />
				<label for="sexo_f">Femenino</label>
			</div>
			<small id="helper"></small>
		</div>

		<div class="form--input" id="mantener">
			<label for="terminos">
				<input type="checkbox" class="field-checkbox" name="terminos" id="terminos" tabindex="5">
				Acepto los <a href="{$tsConfig.url}/pages/terminos-y-condiciones/" style="text-decoration: underline;">términos y condiciones</a>
			</label>
		</div>

		<div class="buttons">
			<input type="hidden" name="response" id="response" class="g-recaptcha">
			<button class="mBtn btnOk disabled" disabled data-sitekey="{$public_key_captcha}" id="registrarme" disabled type="submit">Crear cuenta</button>
		</div>

	</div>
</div>
<script>

   grecaptcha.ready(
      () => grecaptcha.execute(public_key, { action: 'submit' })
      .then(token => response.value = token)
   );
</script>