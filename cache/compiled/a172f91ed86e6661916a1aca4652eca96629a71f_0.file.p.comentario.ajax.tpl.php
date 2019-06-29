<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:08
  from 'D:\xampp\htdocs\assets\templates\t.php_files\p.comentario.ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b4944ecc82_93204553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a172f91ed86e6661916a1aca4652eca96629a71f' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.php_files\\p.comentario.ajax.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b4944ecc82_93204553 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                        	<?php if ($_smarty_tpl->tpl_vars['tsComments']->value['num'] > 0) {?>
                        	
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsComments']->value['data'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                        	
							<div id="div_cmnt_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" class="<?php if ($_smarty_tpl->tpl_vars['tsPost']->value['autor'] == $_smarty_tpl->tpl_vars['c']->value['c_user']) {?>especial1<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['c_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?>especial3<?php }?>">
                            	
								<span id="citar_comm_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" style="display:none"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_body'];?>
</span>
                                
								<div class="comentario-post clearbeta">
                                	
									<div class="avatar-box" style="z-index: 99;">
                                    	
										<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
">
											
											<img width="48" height="48" title="Avatar de <?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
 en <?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
_50.jpg" class="avatar-48 lazy" style="position: relative; z-index: 1; display: inline;">
										
										</a>
                                        
										<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member && $_smarty_tpl->tpl_vars['tsUser']->value->info['user_id'] != $_smarty_tpl->tpl_vars['c']->value['c_user']) {?>
                                        
										<ul style="display: none;">
                                          
											<li class="enviar-mensaje"><a href="#" onclick="mensaje.nuevo('<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
','','',''); return false">Enviar Mensaje <span></span></a></li>
                                            
											<li class="bloquear <?php if ($_smarty_tpl->tpl_vars['tsComments']->value['block']) {?>des<?php }?>bloquear_1"><a href="javascript:bloquear(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
, <?php if ($_smarty_tpl->tpl_vars['tsComments']->value['block']) {?>false<?php } else { ?>true<?php }?>, 'comentarios')"><?php if ($_smarty_tpl->tpl_vars['tsComments']->value['block']) {?>Desbloquear<?php } else { ?>Bloquear<?php }?></a></li>
											
											</ul>
                                        
										<?php }?>
                                    
									</div>
                                    
									<div class="comment-box" id="pp_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" <?php if ($_smarty_tpl->tpl_vars['c']->value['c_status'] == 1 || !$_smarty_tpl->tpl_vars['c']->value['user_activo'] && $_smarty_tpl->tpl_vars['tsUser']->value->is_admod) {?>style="opacity:0.5"<?php }?> >
                                    	
										<div class="dialog-c"></div>
                                        
										<div class="comment-info clearbeta">
                                        	
											<div class="floatL">
                                            	
												<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
" class="nick"><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod) {?>(<span style="color:red;">IP:</span> <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/buscador/1/1/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
" class="geoip" target="_blank"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_ip'];?>
</a>)<?php }?> dijo
                                                
												<span><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['c']->value['c_date']);?>
</span> :
                                            
											</div>
                                            
											<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                                            
											<div class="floatR answerOptions" id="opt_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
">
                                            	
												<ul id="ul_cmt_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
">
													
																										
													<li class="numbersvotes" <?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] == 0) {?>style="display: none"<?php }?>>
                            							
														<div class="overview">
                            								
															<span class="<?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] >= 0) {?>positivo<?php } else { ?>negativo<?php }?>" id="votos_total_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
"><?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] != 0) {
if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] >= 0) {?>+<?php }
echo $_smarty_tpl->tpl_vars['c']->value['c_votos'];
}?></span>
                            							
														</div>
                            						
													</li>
                                                    
													<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->uid != $_smarty_tpl->tpl_vars['c']->value['c_user'] && $_smarty_tpl->tpl_vars['c']->value['votado'] == 0 && ($_smarty_tpl->tpl_vars['tsUser']->value->permisos['govpp'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['govpn'] || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod)) {?>
                                                    
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->permisos['govpp'] || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod) {?>
                                                    
													<li class="icon-thumb-up">
                                                        
														<a onclick="comentario.votar(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
,1)">
                                                            
															<span class="voto-p-comentario"></span>
                                                        </a>
                                                    
													</li>
                                                    
                                                    <?php }?>
                                                    
                                                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->permisos['govpn'] || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod) {?>
                                                    
													<li class="icon-thumb-down">
                                                        
														<a onclick="comentario.votar(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
,-1)">
                                                            
															<span class="voto-n-comentario"></span>
                                                        </a>
                                                    
													</li>
                                                    
                                                    <?php }?>
                                                    
													<?php }?>
                                                    
														                                                
													<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                                                	
													<li class="answerCitar">
                                                    	
														<a onclick="citar_comment(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, '<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
')" title="Citar">
                                                            
															<span class="citar-comentario"></span>
                                                        
														</a>
                                                    
													</li>
                                                    
													<?php if (($_smarty_tpl->tpl_vars['c']->value['c_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['goepc']) || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedcopo']) {?>
                                                	
													<li>
                                                    	
														<a onclick="comentario.editar(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, 'show')" title="Editar comentario">
                                                            
															<span class="<?php if ($_smarty_tpl->tpl_vars['c']->value['c_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?>editar<?php } else { ?>moderar<?php }?>-comentario"></span>
                                                        
														</a>
                                                    
													</li>
                                                    
													<?php }?>
                                                    
													<?php if (($_smarty_tpl->tpl_vars['c']->value['c_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['godpc']) || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moecp']) {?>
                                                    
													<li class="iconDelete">
                                                    	
														<a onclick="borrar_com(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['c_post_id'];?>
)" title="Borrar">
															
															<span class="borrar-comentario"></span>
														
														</a>
                                                    
													</li>
													
													<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moaydcp']) {?>
													
													<li class="iconHide">
                                                    	
														<a onclick="ocultar_com(<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['c']->value['c_user'];?>
);" title="<?php if ($_smarty_tpl->tpl_vars['c']->value['c_status'] == 1) {?>Mostrar/Ocultar<?php } else { ?>Ocultar/Mostrar<?php }?>">
															
															<span class="moderar-comentario"></span>
														
														</a>
                                                    
													</li>
													
													<?php }?>
                                                    
													<?php }?>
                                                    
													<?php }?>
                                                
												</ul>
                                            
											</div>
                                            
											<?php }?>
                                        
										</div>
                                        
										<div id="comment-body-<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" class="comment-content">
                                        	
											<?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] <= -3 || $_smarty_tpl->tpl_vars['c']->value['c_status'] == 1 || !$_smarty_tpl->tpl_vars['c']->value['user_activo'] || $_smarty_tpl->tpl_vars['c']->value['user_baneado']) {?><div>Escondido <?php if ($_smarty_tpl->tpl_vars['c']->value['c_status'] == 1) {?>por un moderador<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['c_votos'] <= -3) {?>por un puntaje bajo<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['user_activo'] == 0) {?>por pertener a una cuenta desactivada<?php } else { ?>por pertenecer a una cuenta baneada<?php }?>. <a href="#" onclick="$('#hdn_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
').slideDown(); $(this).parent().slideUp(); return false;">Click para verlo</a>.</div>
                                            
											<div id="hdn_<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" style="display:none"><?php }?>
                                            
											<?php echo $_smarty_tpl->tpl_vars['c']->value['c_html'];?>

                                            
											<?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos'] <= -3 || $_smarty_tpl->tpl_vars['c']->value['c_status'] == 1 || !$_smarty_tpl->tpl_vars['c']->value['user_activo']) {?></div><?php }?>
											
                                        </div>
                                    
									</div>
                                
								</div>
                            
							</div>
                            
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            
							<?php } else { ?>
                            	
								<div id="no-comments">Este post no tiene comentarios, S&eacute; el primero!</div>
                            
							<?php }?>
                            
							<!---->
                            
							<div id="nuevos"></div>
                            
							
                            
							<?php echo '<script'; ?>
 type="text/javascript">
                            
							$(function(){
                            
							var zIndexNumber = 99;
                                	
									$('div.avatar-box').each(function(){
                                		
										$(this).css('zIndex', zIndexNumber);
                                		
										zIndexNumber -= 1;
                                	
									});
                            
							});
                            
							<?php echo '</script'; ?>
>
                            
							<?php }
}
