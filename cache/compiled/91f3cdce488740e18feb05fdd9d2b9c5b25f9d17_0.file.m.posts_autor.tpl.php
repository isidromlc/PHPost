<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_autor.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b4923c7be5_55360529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91f3cdce488740e18feb05fdd9d2b9c5b25f9d17' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_autor.tpl',
      1 => 1561688467,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b4923c7be5_55360529 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                	<div class="post-autor vcard">
                    	<div class="box_title">
                        	<div class="box_txt post_autor">Posteado por:</div>
                            <div class="box_rss">
                            	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/rss/posts-usuario/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
">
                                	<span style="position:relative;">
                                    <img border="0" title="RSS con posts de <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
" alt="RSS con posts de Usuario" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/big1v12.png"/>
                                    <img border="0" style="width:14px;height:12px" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/space.gif"/>
                                    </span>
                                 </a>
                            </div>
                        </div>
                        <div class="box_cuerpo">
                        	<div class="avatarBox">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
">
                                    <img title="Ver perfil de <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
" alt="Ver perfil de <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
" class="avatar" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
_120.jpg"/>
                                </a>
							</div>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
" style="text-decoration:none">
								<span class="given-name" style="color:#<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['rango']['r_color'];?>
"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
</span>
							</a>
                            <br />
                            <span class="title"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['rango']['r_name'];?>
</span>
                            <br />
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/space.gif" class="status <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['status']['css'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['status']['t'];?>
"/>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/ran/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['rango']['r_image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['rango']['r_name'];?>
" />
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/<?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_sexo'] == 0) {?>female<?php } else { ?>male<?php }?>.png" title="<?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_sexo'] == 0) {?>Mujer<?php } else { ?>Hombre<?php }?>" />
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/flags/<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['pais']['icon'];?>
.png" style="padding:2px" title="<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['pais']['name'];?>
" />
                            <?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?><a href="#" onclick="<?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>registro_load_form();<?php } else { ?>mensaje.nuevo('<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_name'];?>
','','','');<?php }?>return false"><img title="Enviar mensaje privado" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/icon-mensajes-recibidos.gif"/></a><?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                            <hr class="divider"/>
                            <a class="btn_g follow_user_post" href="#" onclick="registro_load_form(); return false"><span class="icons follow">Seguir Usuario</span></a>
                            <?php } elseif ($_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?>
                            <hr class="divider"/>
                            <a class="btn_g unfollow_user_post" onclick="notifica.unfollow('user', <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
, notifica.userInPostHandle, $(this).children('span'))" <?php if (!$_smarty_tpl->tpl_vars['tsAutor']->value['follow']) {?>style="display: none;"<?php }?>><span class="icons unfollow">Dejar de seguir</span></a>
                            <a class="btn_g follow_user_post" onclick="notifica.follow('user', <?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
, notifica.userInPostHandle, $(this).children('span'))" <?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['follow'] > 0) {?>style="display: none;"<?php }?>><span class="icons follow">Seguir Usuario</span></a>
                            <?php }?>
                            <hr class="divider"/>
                            <div class="metadata-usuario">
                            	<span class="nData user_follow_count"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_seguidores'];?>
</span>
                                <span class="txtData">Seguidores</span>
                                <span class="nData" style="color: #0196ff"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_puntos'];?>
</span>
                                <span class="txtData">Puntos</span>
                                <span class="nData"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_posts'];?>
</span>
                                <span class="txtData">Posts</span>
                                <span style="color: #456c00" class="nData"><?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_comentarios'];?>
</span>
                                <span class="txtData">Comentarios</span>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?>
                            <hr class="divider"/>
                            <div class="mod-actions">
                                <b>Herramientas</b>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/buscador/1/1/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_ip'];?>
" class="geoip" target="_blank"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_ip'];?>
</a>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 1) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/users?act=show&amp;uid=<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
" class="edituser">Editar Usuario</a><?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?> <a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
, 'aviso', false); return false;" class="alert">Enviar Aviso</a><?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid && $_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?>
								<?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_baneado']) {?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
, 'users', 'unban', false); $(this).remove(); return false;" class="unban">Desuspender Usuario</a><?php }?>
                                <?php } else { ?>
                                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu']) {?><a href="#" onclick="mod.users.action(<?php echo $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'];?>
, 'ban', false); $(this).remove(); return false;" class="ban">Suspender Usuario</a><?php }?>
                                <?php }?>
								<?php }?>
                            </div>
                            <?php }?>
                        </div>
						
						<br />
						<div class="categoriaList estadisticasList" <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['m_total'] == 0) {?> style="display:none;"<?php }?>>
                        <h6>Medallas</h6>
                         <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['medallas']) {?>
						<ul style="margin-left:11px;">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPost']->value['medallas'], 'm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
?>
        			<img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/icons/med/<?php echo $_smarty_tpl->tpl_vars['m']->value['m_image'];?>
_16.png" style="margin-left:1px;margin-bottom:2px;" class="qtip" title="<?php echo $_smarty_tpl->tpl_vars['m']->value['m_title'];?>
 - <?php echo $_smarty_tpl->tpl_vars['m']->value['m_description'];?>
"/>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
						<?php } else { ?>
						 <div class="emptyData">No tiene medallas</div>
                          <?php }?>
                    </div>

						<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['visitas']) {?>
						<br />
						<div class="categoriaList estadisticasList">
                        <h6>&Uacute;ltimos visitantes</h6> 
						<ul style="margin-left:11px;">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPost']->value['visitas'], 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
        			         <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
" style="display:inline-block;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
_50.jpg" class="vctip" title="<?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['v']->value['date'],true);?>
" width="32" height="32"/></a> 
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
						</div>
                          <?php }?>

                    </div><?php }
}
