<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:59
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_revision_comentarios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dcf772b62_14150552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84152bf65a70b8de148a8aafcc8eff3049e32f93' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_revision_comentarios.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dcf772b62_14150552 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
								   <h3>Comentarios desaprobados</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								<?php if (!$_smarty_tpl->tpl_vars['tsComentarios']->value['datos']) {?>
								<div class="phpostAlfa">No hay comentarios ocultos</div>
								<?php } else { ?>
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>ID</th>
										<th>Autor</th>
										<th>Contenido</th>
										<th>Post</th>
										<th>Fecha</th>
										<th>IP</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsComentarios']->value['datos'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
										<tr id="div_cmnt_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
">
											<td><?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
</td>
											<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['c']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</a></td>
											<td><?php echo $_smarty_tpl->tpl_vars['c']->value['c_body'];?>
</td>
											<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['c']->value['post_title']);?>
.html#pp_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['c']->value['post_title'];?>
</a></td> 
											<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['c']->value['c_date'],true);?>
</td>                
   										    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
</td>
											<td class="admin_actions">
												<a href="#" onclick="ocultar_com(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/reboot.png" title="Reactivar/Ocultar Comentario" /></a>											
												<a href="#" onclick="borrar_com(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['post_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Eliminar comentario" /></a>											
											</td>
										</tr>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</tbody>
									<tfoot>
										<td colspan="7">P&aacute;ginas: <?php echo $_smarty_tpl->tpl_vars['tsComentarios']->value['pages'];?>
</td>
									</tfoot>
								</table>
								<?php }?>
                                </div><?php }
}
