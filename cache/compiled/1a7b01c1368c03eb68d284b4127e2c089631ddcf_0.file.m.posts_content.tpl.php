<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b49263a110_76693941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a7b01c1368c03eb68d284b4127e2c089631ddcf' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_content.tpl',
      1 => 1561688467,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/m.global_ads_728.tpl' => 2,
    'file:modules/m.posts_metadata.tpl' => 1,
  ),
),false)) {
function content_5d16b49263a110_76693941 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),));
?>
                	<div class="post-contenedor">
					
                    	<div class="post-title">
							
							<h1><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_title'];?>
</h1>
                            
							<a title="Post Anterior (m&aacute;s viejo)" class="icons anterior" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/prev?id=<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
"></a>
                            
							<a class="fortuitare" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/fortuitae"><img class="qtip" title="Post aleatorio" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/arrow-join.png"/></a>
							
							<a title="Post Siguiente (m&aacute;s nuevo)" class="icons siguiente" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/next?id=<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
"></a>
                        
                        <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['puntos'] && ($_smarty_tpl->tpl_vars['tsPost']->value['post_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod)) {?>
                        
                        <div style="display:none;" id="ver_puntos">
                        
                        <br />
                        
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPost']->value['puntos'], 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
        			         
                             <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
" style="display:inline-block;"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['p']->value['user_id'];?>
_50.jpg" class="vctip" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
 ha dejado <?php echo $_smarty_tpl->tpl_vars['p']->value['cant'];?>
 puntos" width="32" height="32"/></a>
                        
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        
                        </div>
                        
                        <img style="margin-top: 5px; margin-bottom: -21px; cursor:pointer;" title="Puntos entregados" onclick="$('#ver_puntos').slideToggle(); return false" src="http://png-2.findicons.com/files//icons/1689/splashy/16/arrow_state_grey_expanded.png"/>
                        
                        <?php }?>
                                                
                        </div>
                        
						<div class="post-contenido">
                        
							<?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {
$_smarty_tpl->_subTemplateRender('file:modules/m.global_ads_728.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                            
							<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid && $_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 0 && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['most'] == false && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moayca'] == false && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moo'] == false && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moep'] == false && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedpo'] == false) {?>
							
							<div class="floatR">
                                
								<a title="Borrar Post" onclick="borrar_post(); return false;" href="" class="btnActions">
                                    
									<img alt="Borrar" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/borrar.png"/> Borrar</a>
                                
								<a title="Editar Post" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/editar/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
'; return false" href="" class="btnActions">
                                    
									<img alt="Editar" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/editar.png"/> Editar</a>
                            </div>
                            
							<?php } elseif (($_smarty_tpl->tpl_vars['tsUser']->value->is_admod && $_smarty_tpl->tpl_vars['tsPost']->value['post_status'] == 0) || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['most'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moayca'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moop'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moep'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedpo']) {?>
                            							
							<div class="mod-actions inline">
                                
								<strong>Moderar Post:</strong>
                                
								<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['most']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, 'posts', 'sticky', false); if($(this).text() == 'Poner Sticky') $(this).text('Quitar Sticky'); else $(this).text('Poner Sticky'); return false;" class="sticky"><?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_sticky'] == 1) {?>Quitar<?php } else { ?>Poner<?php }?> Sticky</a><?php }?>
                                
								<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moayca']) {?><a href="#" onclick="mod.reboot(<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, 'posts', 'openclosed', false); if($(this).text() == 'Cerrar Post') $(this).text('Abrir Post'); else $(this).text('Cerrar Post'); return false;" class="openclosed"><?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_block_comments'] == 1) {?>Abrir<?php } else { ?>Cerrar<?php }?> Post</a><?php }?>
								
								<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moop']) {?><a id="desaprobar" href="#" onclick="$('#desapprove').slideToggle(); $(this).fadeOut().remove();" class="des_approve">Ocultar Post</a><?php }?>
								
								<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedpo'] || $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/editar/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
" class="edit">Editar</a><?php }?>
                                
								<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moep'] || $_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?><a href="#" onclick="<?php if ($_smarty_tpl->tpl_vars['tsAutor']->value['user_id'] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?>mod.posts.borrar(<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
, 'posts', null);<?php } else { ?>borrar_post();<?php }?> return false;" class="delete">Borrar</a><?php }?>
                                
                            </div>
							
							<div id="desapprove" style="display:none;">
							                            
							<span style="display: none;" class="errormsg"></span>
                            
							<input type="text" id="d_razon" name="d_razon" maxlength="150" size="60" class="text-inp" placeholder="Raz&oacute;n de la revisi&oacute;n" style="width:578px"/ required>
									
							<input type="button" class="mBtn btnDelete" name="desapprove" value="Continuar" href="#" onclick="mod.posts.ocultar('<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
'); return false;"/>
							
							</div>
                            
							<br />
                            
							<?php }?>
							                            
							<span>
                            	
								<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_body'];?>

                            
							</span>
                            
							<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['user_firma'] && $_smarty_tpl->tpl_vars['tsConfig']->value['c_allow_firma']) {?>
                            
							<hr class="divider" />
                            
							<span>
                            	
								<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['user_firma'];?>

                            
							</span>
                            
							<?php }?>
                            
							<div class="compartir-mov" style="text-align: right; color:#888; font-size: 14px;margin: 30px 0 10px">
                            	
								<div class="m-left"></div>
                                
								<div class="m-right"></div>
                                
								<ul class="post-compartir clearbeta">
                                    
									<li class="share-big">
                                    	
										<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
" data-lang="es">Tweet</a><?php echo '<script'; ?>
 type="text/javascript" src="http://platform.twitter.com/widgets.js"><?php echo '</script'; ?>
>
									
									</li>
                                    
									<li class="share-big">
									 	
										<a name="fb_share" share_url="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['categoria']['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['tsPost']->value['post_title']);?>
.html" type="box_count" href="http://www.facebook.com/sharer.php">Compartir</a><?php echo '<script'; ?>
 src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"><?php echo '</script'; ?>
>
									
									</li>
                                    
									<li class="share-big">
									 	
										<span class="share-t-count"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_shared'];?>
</span>
										
										<a href="<?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>javascript:registro_load_form(); return false<?php } else { ?>javascript:notifica.sharePost(<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
)<?php }?>" class="share-t"></a>
									
									</li>
                                    
									<li class="txt-movi">Compartir en:</li>
                                
								</ul>
                            
							</div>
                            
							<?php $_smarty_tpl->_subTemplateRender('file:modules/m.global_ads_728.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        
						</div>
	                    
						<?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_metadata.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    
					</div><?php }
}
