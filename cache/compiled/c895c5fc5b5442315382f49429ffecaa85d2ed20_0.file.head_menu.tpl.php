<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\sections\head_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc297dfb2_75593378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c895c5fc5b5442315382f49429ffecaa85d2ed20' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\head_menu.tpl',
      1 => 1561688277,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc297dfb2_75593378 (Smarty_Internal_Template $_smarty_tpl) {
?>        <?php echo '<script'; ?>
 type="text/javascript">
			var menu_section_actual = '<?php if ($_smarty_tpl->tpl_vars['tsDo']->value == 'posts') {?>posts<?php } else {
echo $_smarty_tpl->tpl_vars['tsPage']->value;
}?>';
		<?php echo '</script'; ?>
>
        <div id="menu">
        	<!--LEFT MENU-->
			<ul class="menuTabs">
                <?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_allow_portal'] && $_smarty_tpl->tpl_vars['tsUser']->value->is_member == true) {?>
                <li class="tabbed <?php if ($_smarty_tpl->tpl_vars['tsPage']->value != 'home' && $_smarty_tpl->tpl_vars['tsPage']->value != 'posts' && $_smarty_tpl->tpl_vars['tsPage']->value != 'tops' && $_smarty_tpl->tpl_vars['tsPage']->value != 'admin' && $_smarty_tpl->tpl_vars['tsPage']->value != 'fotos') {?>here<?php }?>" id="tabbedhome">
                    <a title="Ir a Inicio" onclick="menu('home', this.href); return false;" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mi/"><span>&nbsp;</span></a>
                </li>
                <?php }?>
                <li class="tabbed <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'posts' || $_smarty_tpl->tpl_vars['tsPage']->value == 'home') {?>here<?php }?>" id="<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_allow_portal'] && $_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>tabbedposts<?php } else { ?>tabbedhome<?php }?>">
                    <a title="Ir a Posts" onclick="menu('posts', this.href); return false;" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/">Posts <img alt="Drop Down" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/arrowdown.png"></a>
                </li>				
				<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_fotos_private'] == '1' && !$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {
} else { ?>								
                <li class="tabbed <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'fotos') {?>here<?php }?>" id="tabbedfotos">
                    <a title="Ir a Fotos" onclick="menu('fotos', this.href); return false;" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/">Fotos <img alt="Drop Down" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/arrowdown.png"></a>
                </li>								
				<?php }?>
                <li class="tabbed <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'tops') {?>here<?php }?>" id="tabbedtops">
                    <a title="Ir a TOPs" onclick="menu('tops', this.href); return false;" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/top/">TOPs <img alt="Drop Down" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/arrowdown.png"></a>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 1) {?>
                <li class="tabbed <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'admin') {?>here<?php }?>" id="tabbedAdmin">
                    <a class=qtip title="Panel de Administrador" onclick="menu('Admin', this.href); return false;" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/">Administraci&oacute;n <img alt="Drop Down" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/arrowdown.png"></a>
                </li>
   	                <?php }?>
                <?php } else { ?>
                <li class="tabbed registrate">
                    <a title="Registrate!" onclick="registro_load_form(); return false" href=""><b>Registrate!</b></a>
                </li>
                <?php }?>
                <li class="clearBoth"></li>
            </ul>
            <!--RIGHT MENU-->
            <div class="opciones_usuario <?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>anonimo<?php }?>">
            	<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                <div class="userInfoLogin">
                  <ul>
                    <li class="monitor" style="position: relative">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/monitor/" onclick="notifica.last(); return false" title="Monitor de usuario" name="Monitor">
                            <span class="systemicons monitor"></span>
                        </a>
                      <div class="notificaciones-list" id="mon_list">
                        <div style="padding: 10px 10px 0 10px;font-size:13px">
                            <strong style="cursor:pointer" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/monitor/'">Notificaciones</strong>
                        </div>
                        <ul>
                        </ul>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/monitor/" class="ver-mas">Ver m&aacute;s notificaciones</a>
                      </div>
                    </li>
                    <li class="mensajes" style="position:relative">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/" onclick="mensaje.last(); return false" title="Mensajes Personales" name="Mensajes">
                            <span class="systemicons mps"></span>
                        </a>
                        <div class="notificaciones-list" id="mp_list" style="width:270px">
                            <div style="padding: 10px 10px 0 10px;font-size:13px">
                                <strong style="cursor:pointer" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/'">Mensajes</strong>
                            </div>
                            <ul id="boxMail">
                            </ul>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/" class="ver-mas">Ver todos los mensajes</a>
                        </div>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['tsAvisos']->value) {?>
                    <li style="position:relative;">
                        <a title="Avisos" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/avisos/">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/megaphone.png" />
                        </a>
                        <div id="alerta_avs" class="alertas" style="top: -6px;"><a title="<?php echo $_smarty_tpl->tpl_vars['tsAvisos']->value;?>
 aviso<?php if ($_smarty_tpl->tpl_vars['tsAvisos']->value != 1) {?>s<?php }?>"><span><?php echo $_smarty_tpl->tpl_vars['tsAvisos']->value;?>
</span></a></div>
                    </li>
                    <?php }?>
                    <li>
                        <a title="Mis Favoritos" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/favoritos.php">
                            <span class="systemicons favoritos"></span>
                        </a>
                    </li>
                    <li>
                        <a title="Mis Borradores" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/borradores.php">
                            <span class="systemicons borradores"></span>
                        </a>
                    </li>
                    <li>
                        <a title="Mi cuenta" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/cuenta/">
                            <span class="systemicons micuenta"></span>
                        </a>
                    </li>
                    <li class="usernameMenu">
                        <a title="Mi Perfil" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsUser']->value->info['user_name'];?>
" class="username"><?php echo $_smarty_tpl->tpl_vars['tsUser']->value->nick;?>
</a>
                    </li>
                    <li class="logout">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/login-salir.php" style="vertical-align: middle" title="Salir">
                            <span class="systemicons logout"></span>
                        </a>
                    </li>
                    </ul>
                    <div style="clear:both"></div>
                </div>
                <?php } else { ?>
				<div class="identificarme">
					<a title="Identificarme" href="javascript:open_login_box()" class="iniciar_sesion">Identificarme</a>
				</div>
                <div id="login_box" style="display: none;">
                	<div class="login_header">
                    	<img title="Cerrar mensaje" onclick="close_login_box();" class="login_cerrar" src="http://o2.t26.net/images/cerrar.png" style="left:220px">
                    </div>
                	<div class="login_cuerpo">
	                  <span class="gif_cargando floatR" id="login_cargando" style="display: none;"></span>
    	              <div id="login_error" style="display: none; padding:3px 0;"></div>
        	            <form action="javascript:login_ajax()" method="post">
            	            <label>Usuario</label>
                	        <input type="text" class="ilogin" id="nickname" name="nick" maxlength="64">
                    	    <label>Contraseña</label>
                        	<input type="password" class="ilogin" id="password" name="pass" maxlength="64">
                            <input type="checkbox" id="rem" name="rem" value="true" checked="checked" /> <label for="rem">Recordar usuario</label>
	                        <input type="submit" title="Entrar" value="Entrar" style="width:198px; margin-top:5px;" class="mBtn btnOk">
            	        </form>
                	    <div class="login_footer">
	                      <a href="#" onclick="remind_password();">&#191;Olvidaste tu contrase&#241;a?</a>
        	                <br/>
							<a href="#" onclick="resend_validation();">&#191;No lleg&oacute; el correo de validaci&oacute;n?</a>
        	                <br/>
            	          <a style="color:green;" onclick="open_login_box(); registro_load_form(); return false" href="">
	                        <strong>Registrate Ahora!</strong>
    	                  </a>
                        </div>
                  </div>
                </div>
                <?php }?>
			</div>
            <div class="clearBoth"></div>
        </div><?php }
}
