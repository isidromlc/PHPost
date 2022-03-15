{include file='sections/main_header.tpl'}

<div id="error"></div>
<div class="registro--main">

	<div class="registro--box" id="dualRegister">

		{if $tsAbierto}
			<div class="registro--box__head">
				<h4>Crear una cuenta</h4>
			</div>
			<form class="registro--box__form" id="RegistroForm" autocomplete="OFF" name="formulario">

				<div class="form--input">
					<label for="register_nick">Ingresa tu usuario</label>
					<input type="text" id="register_nick" class="field-input" name="nick" placeholder="Ingrese un nombre de usuario &uacute;nico">
					<small id="helper"></small>
				</div>

				<div class="form--input">
					<label for="register_password">Contrase&ntilde;a deseada</label>
					<input type="password" id="register_password" class="field-input" name="password" placeholder="Ingresa una contrase&ntilde;a segura">
					<small id="helper"></small>
				</div>

				<div class="form--input">
					<label for="register_password2">Confirmar contrase&ntilde;a</label>
					<input type="password" id="register_password2" class="field-input" name="password2" placeholder="Vuelve a ingresar la contrase&ntilde;a">
					<small id="helper"></small>
				</div>

				<div class="form--input">
					<label for="register_email">E-mail</label>
					<input type="email" id="register_email" class="field-input" name="email" placeholder="Ingresa tu direcci&oacute;n de email">
					<small id="helper"></small>
				</div>

				<div class="form--input">
					<label for="register_sexo">Sexo</label>
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
						<input type="checkbox" class="field-checkbox" name="terminos" id="terminos" tabindex="7">
						Acepto los <a href="{$tsConfig.url}/pages/terminos-y-condiciones/" style="text-decoration: underline;">términos y condiciones</a>
					</label>
				</div>

				<div class="buttons">
			  		<input type="hidden" name="response" id="response" class="g-recaptcha">
			  		<button class="mBtn btnOk disabled" disabled data-sitekey="{$public_key}" id="registrarme" disabled type="submit">Crear cuenta</button>
			  	</div>
			</form>
			<script>public_key = '{$public_key}';</script>
			<script src="{$tsRecaptcha}?render={$public_key}"></script>
			<script src="{$tsConfig.js}/registro.js?{$smarty.now}"></script>
		{else}
			<div class="box-end">
				<p>El registro se encuentra cerrado por el momento...</p>
			</div>
		{/if}
	</div>

</div>

{include file='sections/main_footer.tpl'}