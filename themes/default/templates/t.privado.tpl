{include file='sections/main_header.tpl'}
            <style>
            /* {literal} */
            .reg-login {
            	margin-top: 15px;
            }
            	.registro {
            		float: left;
            		width: 300px;
            	}
            	.login-panel {
            		float: left;
            		padding-left: 25px;
            	}
            	
            	.login-panel label {
            		font-weight: bold;
            		display: block;
            		margin: 5px 0;
            	}
            	
            	.login-panel .mBtn {
            		margin-top: 10px;
            	}
                /*{/literal}*/
            </style>
<div class="post-deleted post-privado clearbeta">
	<div class="content-splash">
		<h3>{if $tsType == 'post'}Este post es privado, s&oacute;lo los usuarios registrados de {$tsConfig.titulo} pueden acceder.{else}Registrate en {$tsConfig.titulo}{/if}</h3>
        {if $tsType == 'post'}Pero no te preocupes, tambi&eacute;n puedes formar parte de nuestra gran familia. <a title="Reg&iacute;strate!" href="{$tsConfig.url}/registro/"><b>Reg&iacute;strate!</b></a>{/if}
				<div class="reg-login">
			<div class="login-panel">
				<h4>...O identif&iacute;cate</h4>
				<div class="login_cuerpo"  style="float:left;">
					<span class="gif_cargando floatR" id="login_cargando"></span>
					<div id="login_error"></div>
					<form action="javascript:login_ajax('registro-logueo')" id="login-registro-logueo" method="POST">
						<input type="hidden" value="/registro" name="redirect">
						<label>Usuario</label>
						<input type="text" tabindex="20" class="ilogin" id="nickname" name="nick" maxlength="64"/>
						<label>Contrase&ntilde;a</label>
						<input type="password" tabindex="21" class="ilogin" id="password" name="pass" maxlength="64"/>
						<input type="submit" tabindex="22" title="Entrar" value="Entrar" class="mBtn btnOk"/>
						<div style="color: #666; padding:5px;font-weight: normal; display:none" class="floatR">
							<input type="checkbox"> Recordarme?
						</div>
					</form>
					<div class="login_footer">
						<a tabindex="23" href="#" onclick="remind_password();">&iquest;Olvidaste tu contrase&ntilde;a?</a> o <a tabindex="23" href="#" onclick="resend_validation();">&iquest;Quieres activar tu cuenta?</a>
					</div>
				</div>
				<div style="float:right;width:210px;font-size:13px;border: 5px solid rgb(195, 0, 20); background: none repeat scroll 0% 0% rgb(247, 228, 221); color: rgb(195, 0, 20); padding: 8px; margin: 10px 0;">
					<strong>&iexcl;Atenci&oacute;n!</strong>
					<br>Antes de ingresar tus datos asegurate que la URL de esta p&aacute;gina pertenece a <strong>{$tsConfig.titulo}</strong>
				</div>
			</div>
		</div>
	</div>
</div>
{include file='sections/main_footer.tpl'}