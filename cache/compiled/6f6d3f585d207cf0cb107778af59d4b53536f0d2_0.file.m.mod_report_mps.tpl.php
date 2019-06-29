<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:53
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_report_mps.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc9e49ba4_35048880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f6d3f585d207cf0cb107778af59d4b53536f0d2' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_report_mps.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc9e49ba4_35048880 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de mensajes</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                <?php if ($_smarty_tpl->tpl_vars['tsSave']->value) {?><div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div><?php }?>
                                	<?php if ($_smarty_tpl->tpl_vars['tsAct']->value == '') {?>
                                    Recuerda leer el protocolo para poder moderar los mensajes que han sido denunciados por otros usuarios. Si no est&aacute; seguro de la acci&oacute;n a tomar, hable con el denunciante para obtener m&aacute;s informaci&oacute;n.
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                            <th>T&iacute;tulo</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsReports']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsReports']->value, 'r');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
?>
                                            <tr id="report_<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_id'];?>
">
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/leer/<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_id'];?>
" target="_blank"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['mp_subject'],30);?>
</a></td>
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['r']->value['d_date'],true);?>
</td>
                                                <td class="admin_actions">
												    <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/mps?act=info&obj=<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/details.png" title="Ver Detalles" /></a>
													<a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_from'];?>
, 'aviso', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/warning.png" title="Enviar alerta al autor" /></a>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?><a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_from'];?>
, 'ban', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_off.png" title="Suspender al autor" /></a><?php }?>
													<a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_to'];?>
, 'aviso', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/warning.png" title="Enviar alerta al receptor" /></a>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?><a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_to'];?>
, 'ban', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_off.png" title="Suspender al receptor" /></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocdm']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_id'];?>
, 'mps', 'reboot', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/reboot.png" title="Desechar denuncias" /></a><?php }?>
													<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moadm']) {?><a href="#" onclick="mod.mps.borrar(<?php echo $_smarty_tpl->tpl_vars['r']->value['mp_id'];?>
); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Borrar Mensaje" /></a><?php }?>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay mensajes denunciados hasta el momento.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<?php } elseif ($_smarty_tpl->tpl_vars['tsAct']->value == 'info') {?>
                                    <h2 style="border-bottom:1px dashed #CCC; padding-bottom:5px;">
                                    </h2>
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denunciante</th>
                                            <th>Fecha</th>
											<th>Acciones</th>
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
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['d']->value['d_date'],true);?>
</td>
												<td class="admin_actions">
                                                <a href="#" onclick="mensaje.nuevo('<?php echo $_smarty_tpl->tpl_vars['d']->value['user_name'];?>
','[Moderaci&oacute;n] Mensaje reportado','Hola <?php echo $_smarty_tpl->tpl_vars['d']->value['user_name'];?>
, me comunico con usted para pedirle informaci&oacute;n sobre...','Recuerde que este mensaje no ser&aacute; enviado como personal.'); return false"><span>MP</span></a>
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
