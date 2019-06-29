<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:57
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_buscador.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dcd176c47_02469598',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd39c479acffc4cc23940d75069f4f1c5a64ab099' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_buscador.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dcd176c47_02469598 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),2=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
                                <div class="boxy-title">
									<h3>Buscador de Contenido</h3>
								</div>
								<div id="res" class="boxy-content">
									<?php if (!$_smarty_tpl->tpl_vars['tsAct']->value) {?>
									 Esa herramienta le mostrar&aacute; las coindicencias del contenido o ip en una publicaci&oacute;n de un muro, usuario, post, foto o comentario.
									 <hr>
									 <p style="font-weight:bold;">IP</p>
									 <p>Se mostrar&aacute; todo el contenido relacionado con la IP introducida, si es parecida (parcial), o exactamente la misma (exacta).
									 <hr>
									 <p style="font-weight:bold;">Texto</p>
									 <p>El usuario se mostrar&aacute; por nombre.</p>
									 <p>En el muro, se buscar&aacute; por contenido de la publicaci&oacute;n</p>
									 <p>En los posts y las fotos, se buscar&aacute; por t&iacute;tulo o contenido/descripci&oacute;n.</p>
									 <p>En los comentarios, se buscar&aacute; por contenido o autor del comentario. Para buscar al autor, se introduce el ID de &eacute;ste.</p>
									<hr class="separator" />
									<form action="" method="post">
										<input type="search" name="texto" required>
											<select name="m">
												<option value="1">Parcial</option>
												<option value="2">Exacta</option>
											</select>
											<select name="t">
												<option value="1">IP</option>
												<option value="2">Texto</option>
											</select>
										<input type="submit" name="buscar" value="Buscar Contenido" class="btn_g"/>
									</form>
									<?php } elseif ($_smarty_tpl->tpl_vars['tsAct']->value == 'search') {?>
									<form action="" method="post">
									<input type="search" name="texto" value="<?php echo $_smarty_tpl->tpl_vars['tsContenido']->value['contenido'];?>
" required>
									<select name="m">
									<option value="1" <?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['metodo'] == 1) {?>selected<?php }?>>Parcial</option>
									<option value="2" <?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['metodo'] != 1) {?>selected<?php }?>>Exacta</option>
									</select>
									<select name="t">
									<option value="1" <?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['tipo'] == 1) {?>selected<?php }?>>IP</option>
									<option value="2" <?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['tipo'] != 1) {?>selected<?php }?>>Texto</option>
									</select>
									<input type="submit" name="buscar" value="Buscar Contenido" class="btn_g"/>
									</form>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="usuarios">
                                    	<thead>
                                        	<th>Usuario</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['usuarios']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['usuarios'], 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value) {
?>
                                            <tr>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
</a></td>
                                                <td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_last_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_last_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['u']->value['user_lastlogin'],true);?>
</td>
                                                <td class="admin_actions">
                                               <a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
, 'ban', false); return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_off.png" title="Suspender Usuario" /></a>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Usuarios.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
									<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="muro">
                                    	<thead>
                                        	<th>Autor</th>
											<th>Contenido</th>
											<th>IP</th>
											<th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['muro']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['muro'], 'm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
?>
                                            <tr>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['m']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['m']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['user_name'];?>
</a></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['m']->value['p_body'];?>
</td>
												<td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['m']->value['p_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['m']->value['p_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['m']->value['p_date'],true);?>
</td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Muro.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="posts">
                                    	<thead>
                                        	<th>Post</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['posts']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['posts'], 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                                            <tr id="report_<?php echo $_smarty_tpl->tpl_vars['r']->value['obj_id'];?>
">
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
</a></td>
												<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_user'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
</a></td>
                                                <td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['p']->value['post_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['p']->value['post_date'],true);?>
</td>
                                                <td class="admin_actions">
													<a href="#" onclick="mod.posts.borrar(<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
, 'posts'); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Borrar Post" /></a>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Posts.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="fotos">
                                    	<thead>
                                        	<th>Foto</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['fotos']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['fotos'], 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
                                            <tr>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['f']->value['foto_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['f']->value['f_title']);?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['f']->value['f_title'];?>
</a></td>
												<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['f']->value['f_user'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['user_name'];?>
</a></td>
                                                <td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['f']->value['f_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['f']->value['f_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['f']->value['f_date'],true);?>
</td>
                                                <td class="admin_actions">
														<a href="#" onclick="mod.fotos.borrar(<?php echo $_smarty_tpl->tpl_vars['f']->value['foto_id'];?>
); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/close.png" title="Borrar Foto" /></a>                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Fotos.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="p_comentarios">
                                    	<thead>
                                        	<th>Comentario</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['p_comentarios']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['p_comentarios'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                                            <tr id="comentario_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
">
                                                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['c']->value['c_body'],100);?>
</td>
												<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</a></td>
                                                <td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['c']->value['c_date'],true);?>
</td>
                                                <td class="admin_actions">
                                                    <a href="#" onclick="ocultar_com(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['user_id'];?>
); return false"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/reactivar.png" title="Mostrar/Ocultar Comentario" /></a>
                                                </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en comentarios de Posts.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="f_comentarios">
                                    	<thead>
                                        	<th>Comentario</th>
											<th>Foto</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	<?php if ($_smarty_tpl->tpl_vars['tsContenido']->value['f_comentarios']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsContenido']->value['f_comentarios'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                                            <tr>
                                                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['c']->value['c_body'],45);?>
</td>
                                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['foto_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['c']->value['f_title']);?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['c']->value['f_title'];?>
</a></td>
												<td><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</a></td>
                                                <td><a href="http://oxi.mx/g/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
" class="geoip" title="Información de IP" target="_blank"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
</a></td>
												<td><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['c']->value['c_date'],true);?>
</td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en comentarios de fotos.</div></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    <?php }?>
                                </div><?php }
}
