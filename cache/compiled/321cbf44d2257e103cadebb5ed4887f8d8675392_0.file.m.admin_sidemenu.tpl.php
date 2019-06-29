<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:49
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.admin_sidemenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc52b7cf1_46000748',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '321cbf44d2257e103cadebb5ed4887f8d8675392' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.admin_sidemenu.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc52b7cf1_46000748 (Smarty_Internal_Template $_smarty_tpl) {
?>                                    <?php echo '<script'; ?>
 type="text/javascript">
										var action_menu = '<?php echo $_smarty_tpl->tpl_vars['tsAction']->value;?>
';
										// <-- no borrar
										$(function(){
											if(action_menu != '') $('#a_' + action_menu).addClass('active');
											else $('#a_main').addClass('active');
										});
									<?php echo '</script'; ?>
>
                                    
                                    <h4>General</h4>
                                    <ul class="cat-list">
                                        <li id="a_main"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/">Centro de Administraci&oacute;n</a></span></li>
                                        <li id="a_creditos"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/creditos">Soporte y Cr&eacute;ditos</a></span></li>
                                    </ul>
                                    <h4>Configuraci&oacute;n de PHPost</h4>
                                    <ul class="cat-list">
                                        <li id="a_configs"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/configs">Configuraci&oacute;n </a></span></li>
                                        <li id="a_temas"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/temas">Temas y apariencia</a></span></li>
                                        <li id="a_news"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/news">Noticias</a></span></li>
                                        <li id="a_ads"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/ads">Publicidad</a></span></li>
                                    </ul>
                                    <h4>Control de PHPost</h4>
                                    <ul class="cat-list">
                                        <li id="a_medals"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/medals">Medallas</a></span></li>
                                        <li id="a_afs"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/afs">Afiliados</a></span></li>
										<li id="a_stats"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/stats">Estad&iacute;sticas</a></span></li>
                                        <li id="a_blacklist"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/blacklist">Bloqueos</a></span></li>
                                        <li id="a_badwords"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/badwords">Censuras</a></span></li>
                                    </ul>
                                    <h4>Control de Contenido</h4>
                                    <ul class="cat-list">
                                        <li id="a_posts"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/posts">Todos los Posts</a></span></li>
                                        <li id="a_fotos"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/fotos">Todas las Fotos</a></span></li>
										<li id="a_cats"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/cats">Categor&iacute;as</a></span></li>
                                    </ul>
                                    <h4>Control de Usuarios</h4>
                                    <ul class="cat-list">
                                    	<li id="a_users"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/users">Todos los Usuarios</a></span></li>
                                    	<li id="a_sesiones"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/sesiones">Sesiones</a></span></li>
                                    	<li id="a_nicks"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/nicks">Cambios de Nicks</a></span></li>
                                        <li id="a_rangos"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/rangos">Rangos de Usuarios</a></span></li>
                                    </ul><?php }
}
