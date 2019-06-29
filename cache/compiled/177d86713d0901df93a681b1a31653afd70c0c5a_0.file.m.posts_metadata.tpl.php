<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_metadata.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492846880_25257967',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '177d86713d0901df93a681b1a31653afd70c0c5a' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_metadata.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b492846880_25257967 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),));
?>
                	<div class="post-metadata floatL">
                    	<div style="padding: 12px">
                        	<div style="display:none" class="mensajes"></div>
                            <?php if (($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['godp']) && $_smarty_tpl->tpl_vars['tsUser']->value->is_member == 1 && $_smarty_tpl->tpl_vars['tsPost']->value['post_user'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid && $_smarty_tpl->tpl_vars['tsUser']->value->info['user_puntosxdar'] >= 1) {?>
                            <div class="dar-puntos">
							<?php if ($_smarty_tpl->tpl_vars['tsPunteador']->value['rango'] >= 50) {?>
							<center>
							<div align="center" style="background: #F2F2F2;width: 58px;padding: 2px;border: 1px solid #DDD;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
							<input type="number" id="points" style="width:50px;height:15px;" value="<?php echo $_smarty_tpl->tpl_vars['tsPunteador']->value['rango'];?>
" min="1" max="<?php echo $_smarty_tpl->tpl_vars['tsPunteador']->value['rango'];?>
"/> 	
							<input type="submit" onclick="votar_post(document.getElementById('points').value); return false;" value="Votar" class="btn_g" style="width: 55px;">  
							</div>
							</center>
							<?php } else { ?>
                                <span>Dar Puntos:</span>
                                <?php
$__section_puntos_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['tsUser']->value->info['user_puntosxdar']+1) ? count($_loop) : max(0, (int) $_loop));
$__section_puntos_0_start = min(1, $__section_puntos_0_loop);
$__section_puntos_0_total = min(($__section_puntos_0_loop - $__section_puntos_0_start), (int)@$_smarty_tpl->tpl_vars['tsPunteador']->value['rango'] < 0 ? $__section_puntos_0_loop : (int)@$_smarty_tpl->tpl_vars['tsPunteador']->value['rango']);
$_smarty_tpl->tpl_vars['__smarty_section_puntos'] = new Smarty_Variable(array());
if ($__section_puntos_0_total !== 0) {
for ($__section_puntos_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index'] = $__section_puntos_0_start; $__section_puntos_0_iteration <= $__section_puntos_0_total; $__section_puntos_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index']++){
?>
                                <a href="#" onclick="votar_post(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index'] : null);?>
); return false;"><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index'] : null);?>
</a> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_puntos']->value['index'] : null) < $_smarty_tpl->tpl_vars['tsPunteador']->value['rango']) {?>-<?php }?>
                                <?php
}
}
?>
								<?php }?>
                                 (de <?php echo $_smarty_tpl->tpl_vars['tsUser']->value->info['user_puntosxdar'];?>
 Disponibles)
                            </div>
                            <hr class="divider"/>
                            <?php }?>
                            <div class="post-acciones">
                            	<ul>
                                    <?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                                    <li><a class="btn_g follow_user_post" href="#" onclick="registro_load_form(); return false"><span class="icons follow_post follow">Seguir Post</span></a></li>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['tsPost']->value['post_user'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?>
                                    <li<?php if (!$_smarty_tpl->tpl_vars['tsPost']->value['follow']) {?> style="display: none;"<?php }?>>
                                    <a class="btn_g unfollow_post" onclick="notifica.unfollow('post', <?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, notifica.inPostHandle, $(this).children('span'))"><span class="icons follow_post unfollow">Dejar de seguir</span></a>
                                    </li>
                                    <li<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['follow'] > 0) {?> style="display: none;"<?php }?>>
                                    <a class="btn_g follow_post" onclick="notifica.follow('post', <?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, notifica.inPostHandle, $(this).children('span'))"><span class="icons follow_post follow">Seguir Post</span></a>
                                    </li>
									<li><a href="#" onclick="<?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>registro_load_form()<?php } else { ?>add_favoritos()<?php }?>; return false" class="btn_g"><span class="icons agregar_favoritos">Agregar a Favoritos</span></a></li>
									<li><a href="#" onclick="denuncia.nueva('post',<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_title'];?>
', '<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['user_name'];?>
'); return false;" class="btn_g"><span class="icons denunciar_post">Denunciar</span></a></li>
                                    <?php }?>
                                    </ul>
                            </div>
                            <ul class="post-estadisticas">
								<li><span class="icons medallas"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['m_total'];?>
</span><br />Medalla<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['m_total'] != 1) {?>s<?php }?></li>
                            	<li><span class="icons favoritos_post"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_favoritos'];?>
</span><br />Favoritos</li>
                                <li><span class="icons visitas_post"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_hits'];?>
</span><br />Visitas</li>
                                <li><span id="puntos_post" class="icons puntos_post"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_puntos'];?>
</span><br />Puntos</li>
                                <li><span class="icons monitor"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_seguidores'];?>
</span><br />Seguidores</li>
                            </ul>
                            <div class="clearfix"></div>
                            <hr class="divider"/>
                            <div class="tags-block">
                            	<span class="icons tags_title">Tags:</span>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPost']->value['post_tags'], 'tag', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['tag']->value) {
?>
                                <a rel="tag" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/buscador/?q=<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['tag']->value);?>
&e=tags"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a> <?php if ($_smarty_tpl->tpl_vars['i']->value < $_smarty_tpl->tpl_vars['tsPost']->value['n_tags']) {?>-<?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                            <ul class="post-cat-date">
                            	<li><strong>Categor&iacute;a:</strong> <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['categoria']['c_seo'];?>
/"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['categoria']['c_nombre'];?>
</a></li>
                                <li><strong>Creado:</strong><span> <?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_date'];?>
.</span></li>
                            </ul>
                            <div class="clearfix"></div>
										
						</div>
					
                        </div>
                    </div><?php }
}
