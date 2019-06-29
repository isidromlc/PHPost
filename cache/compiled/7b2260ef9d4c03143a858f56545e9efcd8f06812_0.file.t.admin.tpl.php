<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:49
  from 'D:\xampp\htdocs\assets\templates\t.admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc51682f0_16627236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b2260ef9d4c03143a858f56545e9efcd8f06812' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.admin.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/main_header.tpl' => 1,
    'file:admin_mods/m.admin_sidemenu.tpl' => 1,
    'file:admin_mods/m.admin_welcome.tpl' => 1,
    'file:admin_mods/m.admin_creditos.tpl' => 1,
    'file:admin_mods/m.admin_configs.tpl' => 1,
    'file:admin_mods/m.admin_temas.tpl' => 1,
    'file:admin_mods/m.admin_noticias.tpl' => 1,
    'file:admin_mods/m.admin_publicidad.tpl' => 1,
    'file:admin_mods/m.admin_medallas.tpl' => 1,
    'file:admin_mods/m.admin_stats.tpl' => 1,
    'file:admin_mods/m.admin_posts.tpl' => 1,
    'file:admin_mods/m.admin_fotos.tpl' => 1,
    'file:admin_mods/m.admin_afiliados.tpl' => 1,
    'file:admin_mods/m.admin_posts_configs.tpl' => 1,
    'file:admin_mods/m.admin_cats.tpl' => 1,
    'file:admin_mods/m.admin_users.tpl' => 1,
    'file:admin_mods/m.admin_sesiones.tpl' => 1,
    'file:admin_mods/m.admin_nicks.tpl' => 1,
    'file:admin_mods/m.admin_blacklist.tpl' => 1,
    'file:admin_mods/m.admin_badwords.tpl' => 1,
    'file:admin_mods/m.admin_rangos.tpl' => 1,
    'file:sections/main_footer.tpl' => 1,
  ),
),false)) {
function content_5d169dc51682f0_16627236 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:sections/main_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/admin.js"><?php echo '</script'; ?>
>
                <div id="borradores">
					<div class="clearfix">
                    	<div class="left" style="float:left;width:200px">
                   			<div class="boxy">
                                <div class="boxy-title">
                                    <h3>Men&uacute;</h3>
                                    <span></span>
                                </div><!-- boxy-title -->
                                <div class="boxy-content" id="admin_menu">
									<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_sidemenu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                </div><!-- boxy-content -->
                            </div>
                        </div>
                        <div class="right" style="float:left;margin-left:10px;width:730px">
                            <div class="boxy" id="admin_panel">
                            	                            	<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == '') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_welcome.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'creditos') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_creditos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'configs') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_configs.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'temas') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_temas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'news') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_noticias.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'ads') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_publicidad.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'medals') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_medallas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'stats') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'posts') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'fotos') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_fotos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'afs') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_afiliados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'pconfigs') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_posts_configs.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'cats') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_cats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'users') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'sesiones') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_sesiones.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'nicks') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_nicks.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'blacklist') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_blacklist.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'badwords') {?>
                                <?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_badwords.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'rangos') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.admin_rangos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
<?php $_smarty_tpl->_subTemplateRender('file:sections/main_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
