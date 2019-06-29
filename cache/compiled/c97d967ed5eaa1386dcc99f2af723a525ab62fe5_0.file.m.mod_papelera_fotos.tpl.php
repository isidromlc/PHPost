<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:58
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_papelera_fotos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dce456368_00437310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c97d967ed5eaa1386dcc99f2af723a525ab62fe5' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_papelera_fotos.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dce456368_00437310 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
								   <h3>Fotos en la papelera</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								<?php if (!$_smarty_tpl->tpl_vars['tsFopelera']->value['datos']) {?>
								<div class="phpostAlfa">No hay fotos eliminadas</div>
								<?php } else { ?>
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>T&iacute;tulo</th>
										<th>Autor</th>
										<th>Moderador</th>
										<th>Raz&oacute;n</th>
										<th>Fecha</th>
										<th>IP</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsFopelera']->value['datos'], 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
										<tr id="report_<?php echo $_smarty_tpl->tpl_vars['f']->value['foto_id'];?>
">
											<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['f']->value['foto_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['f']->value['f_title'];?>
.html" target="_blank"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['f']->value['f_title'],30);?>
</a></td>
											<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['f']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
</a></td>
											<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['f']->value['mod_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['f']->value['mod'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['mod_name'];?>
</a></td>
											<td><?php if ($_smarty_tpl->tpl_vars['f']->value['reason'] == 'undefined') {?>Indefinida<?php } else {
echo $_smarty_tpl->tpl_vars['f']->value['reason'];
}?></td>											
											<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['f']->value['date'],true);?>
</td>                
   										    <td><?php echo $_smarty_tpl->tpl_vars['f']->value['mod_ip'];?>
</td>
											<td class="admin_actions">
                                                    <a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['f']->value['foto_id'];?>
, 'fotos', 'reboot', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/reboot.png" title="Reactivar Foto" /></a>
											</td>
										</tr>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</tbody>
									<tfoot>
										<td colspan="7">P&aacute;ginas: <?php echo $_smarty_tpl->tpl_vars['tsFopelera']->value['pages'];?>
</td>
									</tfoot>
								</table>
								<?php }?>
                                </div><?php }
}
