<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:52
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_report_fotos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc8de66c7_65473191',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f78dbeffd9caa4eb68e2f64710fbd6348926cd33' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_report_fotos.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc8de66c7_65473191 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),2=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de fotos</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                <?php if ($_smarty_tpl->tpl_vars['tsSave']->value) {?><div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div><?php }?>
                                	<?php if ($_smarty_tpl->tpl_vars['tsAct']->value == '') {?>
                                    Recuerda leer el protocolo para poder moderar las fotos que han sido denunciadas por otros usuarios, si te es posible y se puede editar una foto, no la borres, <b>Ed&iacute;tala!</b> 
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denuncias</th>
                                            <th>Foto</th>
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
                                            <tr id="report_<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
">
                                            	<td><?php echo $_smarty_tpl->tpl_vars['r']->value['total'];?>
</td>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['r']->value['f_title']);?>
.html" target="_blank"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['f_title'],30);?>
</a></td>
                                                <td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['r']->value['d_date'],true);?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['tsDenuncias']->value[$_smarty_tpl->tpl_vars['r']->value['d_razon']];?>
</td>
                                                <td class="admin_actions">
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/fotos?act=info&obj=<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/details.png" title="Ver Detalles" /></a>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocdf']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
, 'fotos', 'reboot', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/reboot.png" title="<?php if ($_smarty_tpl->tpl_vars['r']->value['f_status'] == 1) {?>Reactivar Foto<?php } else { ?>Desechar denuncias<?php }?>" /></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedfo']) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/editar.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/edit.png" title="Editar Foto" /></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moef']) {?><a href="#" onclick="mod.fotos.borrar(<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Borrar Foto" /></a><?php }?>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay fotos denunciadas hasta el momento.</div></td>
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
/fotos/<?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['r']->value['foto_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['r']->value['f_title']);?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['r']->value['f_title'];?>
</a><?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['f_title'];?>
</a> de <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['user_name'];?>
</a> 
                                        <span class="floatR admin_actions">
                                            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocdf']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['foto_id'];?>
, 'fotos', 'reboot', true); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/reboot.png" title="<?php if ($_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['f_status'] == 1) {?>Reactivar Fotos<?php } else { ?>Desechar denuncias<?php }?>" /></a><?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedfo']) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/editar.php?id=<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['foto_id'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/edit.png" title="Editar Fotos" /></a><?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moef']) {?><a href="#" onclick="mod.fotos.borrar(<?php echo $_smarty_tpl->tpl_vars['tsDenuncia']->value['data']['foto_id'];?>
); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Borrar Foto" /></a><?php }?>
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
