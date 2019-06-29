<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:50
  from 'D:\xampp\htdocs\assets\templates\t.moderacion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc6ad8d17_23822031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77508aa845985d40eb1d80f3b0356ecc74ac22d4' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.moderacion.tpl',
      1 => 1561763255,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/main_header.tpl' => 1,
    'file:admin_mods/m.mod_sidemenu.tpl' => 1,
    'file:admin_mods/m.mod_buscador_stats.tpl' => 1,
    'file:admin_mods/m.mod_welcome.tpl' => 1,
    'file:admin_mods/m.mod_report_posts.tpl' => 1,
    'file:admin_mods/m.mod_report_fotos.tpl' => 1,
    'file:admin_mods/m.mod_report_mps.tpl' => 1,
    'file:admin_mods/m.mod_report_users.tpl' => 1,
    'file:admin_mods/m.mod_ban_users.tpl' => 1,
    'file:admin_mods/m.mod_papelera_posts.tpl' => 1,
    'file:admin_mods/m.mod_papelera_fotos.tpl' => 1,
    'file:admin_mods/m.mod_buscador.tpl' => 1,
    'file:admin_mods/m.mod_revision_comentarios.tpl' => 1,
    'file:admin_mods/m.mod_revision_posts.tpl' => 1,
    'file:sections/main_footer.tpl' => 1,
  ),
),false)) {
function content_5d169dc6ad8d17_23822031 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:sections/main_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/js/moderacion.js"><?php echo '</script'; ?>
>
                <div id="borradores">
					<div class="clearfix">
                    	<div class="left" style="float:left;width:210px">
                   			<div class="boxy">
                                <div class="boxy-title">
                                    <h3>Opciones</h3>
                                    <span></span>
                                </div><!-- boxy-title -->
                                <div class="boxy-content" id="admin_menu">
									<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_sidemenu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                </div><!-- boxy-content -->
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'buscador' && $_smarty_tpl->tpl_vars['tsAct']->value == 'search') {?>
                                <?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_buscador_stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                            <?php }?>
                        </div>
                        <div class="right" style="float:left;margin-left:10px;width:720px">
                            <div class="boxy" id="admin_panel">
                            	                            	<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == '') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_welcome.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'posts') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_report_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'fotos') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_report_fotos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'mps') {?>
                                <?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_report_mps.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'users') {?>
                            	<?php $_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_report_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'banusers') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['movub']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_ban_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'pospelera') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morp']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_papelera_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'fopelera') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morf']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_papelera_fotos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'buscador') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moub']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_buscador.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'comentarios') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocc']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_revision_comentarios.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
								<?php } elseif ($_smarty_tpl->tpl_vars['tsAction']->value == 'revposts') {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocp']) {
$_smarty_tpl->_subTemplateRender('file:admin_mods/m.mod_revision_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
                
<?php $_smarty_tpl->_subTemplateRender('file:sections/main_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
