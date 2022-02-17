<div id="menu">
   <!--LEFT MENU-->
	<ul class="menuTabs">
      {if $tsConfig.c_allow_portal && $tsUser->is_member == true}
         <li class="tabbed {if $tsPage != 'home' && $tsPage != 'posts' && $tsPage != 'tops' && $tsPage != 'admin' && $tsPage != 'fotos'}here{/if}">
            <a title="Ir a Inicio" href="{$tsConfig.url}/mi/"><span>&nbsp;</span></a>
         </li>
      {/if}
      <li class="tabbed {if $tsPage == 'posts' || $tsPage == 'home'}here{/if}">
         <a title="Ir a Posts" href="{$tsConfig.url}/posts/">Posts <img alt="Drop Down" src="{$tsConfig.images}/arrowdown.png"></a>
      </li>				
		{if $tsConfig.c_fotos_private == '1' && !$tsUser->is_member}{else}								
         <li class="tabbed {if $tsPage == 'fotos'}here{/if}">
            <a title="Ir a Fotos" href="{$tsConfig.url}/fotos/">Fotos <img alt="Drop Down" src="{$tsConfig.images}/arrowdown.png"></a>
         </li>								
		{/if}
      <li class="tabbed {if $tsPage == 'tops'}here{/if}">
         <a title="Ir a TOPs" href="{$tsConfig.url}/top/">TOPs <img alt="Drop Down" src="{$tsConfig.images}/arrowdown.png"></a>
      </li>
      {if $tsUser->is_member}
         {if $tsUser->is_admod == 1}
            <li class="tabbed {if $tsPage == 'admin'}here{/if}">
               <a title="Panel de Administrador" href="{$tsConfig.url}/admin/">Administraci&oacute;n <img alt="Drop Down" src="{$tsConfig.images}/arrowdown.png"></a>
            </li>
         {/if}
      {else}
         <li class="tabbed registrate">
            <a title="Registrate!" href="{$tsConfig.url}/registro/"><b>Registrate!</b></a>
         </li>
      {/if}
      <li class="clearBoth"></li>
   </ul>
   <!--RIGHT MENU-->
   <div class="opciones_usuario {if !$tsUser->is_member}anonimo{/if}">
      {if $tsUser->is_member}
         <div class="userInfoLogin">
            <ul>
               <li class="monitor" style="position: relative">
                  <a href="{$tsConfig.url}/monitor/" onclick="notifica.last(); return false" title="Monitor de usuario" name="Monitor"><span class="systemicons monitor"></span></a>
                  <div class="notificaciones-list" id="mon_list">
                     <div style="padding: 10px 10px 0 10px;font-size:13px">
                        <strong style="cursor:pointer" onclick="location.href='{$tsConfig.url}/monitor/'">Notificaciones</strong>
                     </div>
                     <ul></ul>
                     <a href="{$tsConfig.url}/monitor/" class="ver-mas">Ver m&aacute;s notificaciones</a>
                  </div>
               </li>
               <li class="mensajes" style="position:relative">
                  <a href="{$tsConfig.url}/mensajes/" onclick="mensaje.last(); return false" title="Mensajes Personales" name="Mensajes"><span class="systemicons mps"></span></a>
                  <div class="notificaciones-list" id="mp_list" style="width:270px">
                     <div style="padding: 10px 10px 0 10px;font-size:13px">
                        <strong style="cursor:pointer" onclick="location.href='{$tsConfig.url}/mensajes/'">Mensajes</strong>
                     </div>
                     <ul id="boxMail"></ul>
                     <a href="{$tsConfig.url}/mensajes/" class="ver-mas">Ver todos los mensajes</a>
                  </div>
               </li>
               {if $tsAvisos}
                  <li style="position:relative;">
                     <a title="Avisos" href="{$tsConfig.url}/mensajes/avisos/"><img src="{$tsConfig.default}/images/icons/megaphone.png" /></a>
                     <div id="alerta_avs" class="alertas" style="top: -6px;"><a title="{$tsAvisos} aviso{if $tsAvisos != 1}s{/if}"><span>{$tsAvisos}</span></a></div>
                  </li>
               {/if}
               <li>
                  <a title="Mis Favoritos" href="{$tsConfig.url}/favoritos.php"><span class="systemicons favoritos"></span></a>
               </li>
               <li>
                  <a title="Mis Borradores" href="{$tsConfig.url}/borradores.php"><span class="systemicons borradores"></span></a>
               </li>
               <li>
                  <a title="Mi cuenta" href="{$tsConfig.url}/cuenta/">
                      <span class="systemicons micuenta"></span>
                  </a>
               </li>
               <li class="usernameMenu">
                  <a title="Mi Perfil" href="{$tsConfig.url}/perfil/{$tsUser->info.user_name}" class="username">{$tsUser->nick}</a>
               </li>
               <li class="logout">
                  <a href="{$tsConfig.url}/login-salir.php" style="vertical-align: middle" title="Salir"><span class="systemicons logout"></span></a>
               </li>
            </ul>
            <div style="clear:both"></div>
         </div>
      {else}
         <div class="identificarme">
			   <a title="Identificarme" href="javascript:open_login_box()" class="iniciar_sesion">Identificarme</a>
         </div>
         <script src="{$tsConfig.js}/login.js?{$smarty.now}"></script>
         <div id="login_box" style="display:;">
          	<div class="login_cuerpo">
               <!-- Cerrar el login -->
               <img title="Cerrar mensaje" onclick="close_login_box();" class="login_cerrar" src="{$tsConfig.images}/cross-button.png" style="left:220px">
               <!-- Mensaje de error -->
               <div id="login_error" style="display: none; padding:3px 0;margin-bottom: 8px;"></div>
               <!-- Formulario para logue -->
               <form action="javascript:login_ajax()" name="login_user" method="post">
                  <div class="form-line">
                     <label for="nickname">Usuario</label>
                     <div class="error"></div>
                     <input type="text" class="ilogin" id="nickname" name="nick" maxlength="64">
                  </div>
                  <div class="form-line">
                     <label for="password">Contrase&ntilde;a</label>
                     <div class="error"></div>
                     <input type="password" class="ilogin" id="password" name="pass" maxlength="64">
                  </div>
                  <div class="form-line">
                     <input type="checkbox" id="rem" name="rem" value="true" checked="checked" /> 
                     <label for="rem">Recordar usuario</label>
                  </div>
                  <input type="submit" title="Entrar" value="Entrar" style="width:198px; margin-top:5px;" class="mBtn btnOk">
               </form>
               <div class="login_footer">
                  <a href="javascript:remind_password();">&#191;Olvidaste tu contrase&#241;a?</a>
                  <a href="javascript:resend_validation();">&#191;No lleg&oacute; el correo de validaci&oacute;n?</a>
                  <a style="color:green;" href="{$tsConfig.url}/registro/"><strong>Registrate Ahora!</strong></a>
               </div>
            </div>
         </div>
      {/if}
	</div>
   <div class="clearBoth"></div>
</div>