<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:55
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_report_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dcbefa797_09911389',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96a657428ae2d274f80dd31f40c564e3d52785ff' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_report_users.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dcbefa797_09911389 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de usuarios</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                	<?php if ($_smarty_tpl->tpl_vars['tsAct']->value == '') {?>
                                     No suspendas a un usuario sin una causa razonable, si no tu podr&iacute;as hacerle compa&ntilde;ia.
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denuncias</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Raz&oacute;n</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsReports']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsReports']->value, 'r');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
?>
                                            <tr id="report_<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
">
                                            	<td><?php echo $_smarty_tpl->tpl_vars['r']->value['total'];?>
</td>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
</a></td>
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['r']->value['d_date'],true);?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['tsDenuncias']->value[$_smarty_tpl->tpl_vars['r']->value['d_razon']];?>
</td>
                                                <td class="admin_actions">
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/users?act=info&obj=<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/details.png" title="Ver Detalles" /></a>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/user.png" title="Ver Perfil" /></a>
                                                    <a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
, 'aviso', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/warning.png" title="Enviar Alerta" /></a>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?><a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
, 'ban', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_off.png" title="Suspender Usuario" /></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
, 'users', 'reboot', false); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Cancelar denuncias" /></a><?php }?>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay usuarios denunciados hasta el momento.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['tsAct']->value == 'info') {?>
                                    <h2 style="border-bottom:1px dashed #CCC; padding-bottom:5px;">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_name'];?>
</a> 
                                        <span class="floatR admin_actions">
                                            <a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_id'];?>
, 'aviso', true); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/warning.png" title="Enviar Advertencia" /></a>
                                            <a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_id'];?>
, 'ban', true); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_off.png" title="Suspender Usuario" /></a>
                                            <a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_id'];?>
, 'users', 'reboot', true); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Cancelar denuncias" /></a>
                                        </span>
                                    </h2>
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denunciante</th>
                                            <th>Raz&oacute;n</th>
                                            <th>Informaci&oacute;n extra</th>
                                            <th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsDenuncia']->value['denun'], 'd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['d']->value) {
?>
                                            <tr>
                                            	<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['d']->value['user_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['d']->value['user_name'];?>
</a></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['tsDenuncias']->value[$_smarty_tpl->tpl_vars['d']->value['d_razon']];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['d']->value['d_extra'];?>
</td>
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['d']->value['d_date'],true);?>
</td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    <?php }?>
                                </div><?php }
}
