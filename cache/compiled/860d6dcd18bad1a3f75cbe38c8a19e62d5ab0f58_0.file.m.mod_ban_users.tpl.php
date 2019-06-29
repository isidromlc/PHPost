<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:56
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_ban_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dcc8bdc39_29260140',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '860d6dcd18bad1a3f75cbe38c8a19e62d5ab0f58' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_ban_users.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dcc8bdc39_29260140 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de usuarios</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod != 1) {?>S&oacute;lo puedes quitar la suspenci&oacute;n a los usuarios que t&uacute; hayas suspendido.<hr class="separator" /><?php }?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Usuario</th>
                                            <th>Causa</th>
                                            <th><a class="qtip" title="Ascendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=inicio&m=a"><</a>  Suspendido <a class="qtip" title="Descendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=inicio&m=d">></a> </th>
                                            <th><a class="qtip" title="Ascendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=fin&m=a"><</a>  Termina <a class="qtip" title="Descendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=fin&m=d">></a> </th>
                                            <th><a class="qtip" title="Ordenar por moderador ascendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=mod&m=a"><</a>  Lo suspendi&oacute; <a class="qtip" title="Ordenar por moderador descendente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers?o=mod&m=d">></a> </th>
                                            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu']) {?>
											<th>Acciones</th>
											<?php }?>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsSuspendidos']->value['bans']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsSuspendidos']->value['bans'], 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
?>
                                            <tr id="report_<?php echo $_smarty_tpl->tpl_vars['s']->value['user_id'];?>
">
                                            	<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['s']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['s']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['user_name'];?>
</a></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['s']->value['susp_causa'];?>
</td>
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['s']->value['susp_date'],true);?>
</td>
                                                <td><?php if ($_smarty_tpl->tpl_vars['s']->value['susp_termina'] == 0) {?>Indefinidamente<?php } elseif ($_smarty_tpl->tpl_vars['s']->value['susp_termina'] == 1) {?>Permanentemente<?php } else {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['s']->value['susp_termina'],"%d/%m/%Y a las %H:%M:%S");
}?></td>
                                                <td><a href="#" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['s']->value['susp_mod'];?>
"><?php echo $_smarty_tpl->tpl_vars['tsUser']->value->getUserName($_smarty_tpl->tpl_vars['s']->value['susp_mod']);?>
</a></td>
                                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu']) {?>
												<td class="admin_actions">
                                                    <a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['s']->value['user_id'];?>
, 'users', 'unban', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_on.png" title="Reactivar usuario" /></a>
                                                </td>
												<?php }?>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="6"><div class="emptyData">No hay usuarios suspendidos hasta el momento.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                    	
										<td colspan="6">P&aacute;ginas: <?php echo $_smarty_tpl->tpl_vars['tsSuspendidos']->value['pages'];?>
</td>
                                    
									</tfoot>
                                    </table>
                                </div>
                                    <?php }
}
