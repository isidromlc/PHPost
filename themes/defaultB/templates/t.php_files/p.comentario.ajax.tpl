                        	{if $tsComments.num > 0}
                        	
							{foreach from=$tsComments.data item=c}
                        	
							<div id="div_cmnt_{$c.cid}" class="{if $tsPost.autor == $c.c_user}especial1{elseif $c.c_user == $tsUser->uid}especial3{/if}">
                            	
								<span id="citar_comm_{$c.cid}" style="display:none">{$c.c_body}</span>
                                
								<div class="comentario-post clearbeta">
                                	
									<div class="avatar-box" style="z-index: 99;">
                                    	
										<a href="{$tsConfig.url}/perfil/{$c.user_name}">
											
											<img width="48" height="48" title="Avatar de {$c.user_name} en {$tsConfig.titulo}" src="{$tsConfig.url}/files/avatar/{$c.c_user}_50.jpg" class="avatar-48 lazy" style="position: relative; z-index: 1; display: inline;">
										
										</a>
                                        
										{if $tsUser->is_member && $tsUser->info.user_id != $c.c_user}
                                        
										<ul style="display: none;">
                                          
											<li class="enviar-mensaje"><a href="#" onclick="mensaje.nuevo('{$c.user_name}','','',''); return false">Enviar Mensaje <span></span></a></li>
                                            
											<li class="bloquear {if $tsComments.block}des{/if}bloquear_1"><a href="javascript:bloquear({$c.c_user}, {if $tsComments.block}false{else}true{/if}, 'comentarios')">{if $tsComments.block}Desbloquear{else}Bloquear{/if}</a></li>
											
											</ul>
                                        
										{/if}
                                    
									</div>
                                    
									<div class="comment-box" id="pp_{$c.cid}" {if $c.c_status == 1 || !$c.user_activo && $tsUser->is_admod}style="opacity:0.5"{/if} >
                                    	
										<div class="dialog-c"></div>
                                        
										<div class="comment-info clearbeta">
                                        	
											<div class="floatL">
                                            	
												<a href="{$tsConfig.url}/perfil/{$c.user_name}" class="nick">{$c.user_name}</a> {if $tsUser->is_admod}(<span style="color:red;">IP:</span> <a href="{$tsConfig.url}/moderacion/buscador/1/1/{$c.c_ip}" class="geoip" target="_blank">{$c.c_ip}</a>){/if} dijo
                                                
												<span>{$c.c_date|hace}</span> :
                                            
											</div>
                                            
											{if $tsUser->is_member}
                                            
											<div class="floatR answerOptions" id="opt_{$c.cid}">
                                            	
												<ul id="ul_cmt_{$c.cid}">
													
													{*if $tsUser->info.user_rango || $tsUser->info.user_rango_post != 3*}
													
													<li class="numbersvotes" {if $c.c_votos == 0}style="display: none"{/if}>
                            							
														<div class="overview">
                            								
															<span class="{if $c.c_votos >= 0}positivo{else}negativo{/if}" id="votos_total_{$c.cid}">{if $c.c_votos != 0}{if $c.c_votos >= 0}+{/if}{$c.c_votos}{/if}</span>
                            							
														</div>
                            						
													</li>
                                                    
													{if $tsUser->uid != $c.c_user && $c.votado == 0 && ($tsUser->permisos.govpp || $tsUser->permisos.govpn || $tsUser->is_admod)}
                                                    
                                                    {if $tsUser->permisos.govpp || $tsUser->is_admod}
                                                    
													<li class="icon-thumb-up">
                                                        
														<a onclick="comentario.votar({$c.cid},1)">
                                                            
															<span class="voto-p-comentario"></span>
                                                        </a>
                                                    
													</li>
                                                    
                                                    {/if}
                                                    
                                                    {if $tsUser->permisos.govpn || $tsUser->is_admod}
                                                    
													<li class="icon-thumb-down">
                                                        
														<a onclick="comentario.votar({$c.cid},-1)">
                                                            
															<span class="voto-n-comentario"></span>
                                                        </a>
                                                    
													</li>
                                                    
                                                    {/if}
                                                    
													{/if}
                                                    
													{*/if*}
	                                                
													{if $tsUser->is_member}
                                                	
													<li class="answerCitar">
                                                    	
														<a onclick="citar_comment({$c.cid}, '{$c.user_name}')" title="Citar">
                                                            
															<span class="citar-comentario"></span>
                                                        
														</a>
                                                    
													</li>
                                                    
													{if ($c.c_user == $tsUser->uid && $tsUser->permisos.goepc) || $tsUser->is_admod || $tsUser->permisos.moedcopo}
                                                	
													<li>
                                                    	
														<a onclick="comentario.editar({$c.cid}, 'show')" title="Editar comentario">
                                                            
															<span class="{if $c.c_user == $tsUser->uid}editar{else}moderar{/if}-comentario"></span>
                                                        
														</a>
                                                    
													</li>
                                                    
													{/if}
                                                    
													{if ($c.c_user == $tsUser->uid && $tsUser->permisos.godpc) || $tsUser->is_admod || $tsUser->permisos.moecp}
                                                    
													<li class="iconDelete">
                                                    	
														<a onclick="borrar_com({$c.cid}, {$c.c_user}, {$c.c_post_id})" title="Borrar">
															
															<span class="borrar-comentario"></span>
														
														</a>
                                                    
													</li>
													
													{if $tsUser->is_admod || $tsUser->permisos.moaydcp}
													
													<li class="iconHide">
                                                    	
														<a onclick="ocultar_com({$c.cid}, {$c.c_user});" title="{if $c.c_status == 1}Mostrar/Ocultar{else}Ocultar/Mostrar{/if}">
															
															<span class="moderar-comentario"></span>
														
														</a>
                                                    
													</li>
													
													{/if}
                                                    
													{/if}
                                                    
													{/if}
                                                
												</ul>
                                            
											</div>
                                            
											{/if}
                                        
										</div>
                                        
										<div id="comment-body-{$c.cid}" class="comment-content">
                                        	
											{if $c.c_votos <= -3 || $c.c_status == 1 || !$c.user_activo || $c.user_baneado}<div>Escondido {if $c.c_status == 1}por un moderador{elseif $c.c_votos <= -3}por un puntaje bajo{elseif $c.user_activo == 0}por pertener a una cuenta desactivada{else}por pertenecer a una cuenta baneada{/if}. <a href="#" onclick="$('#hdn_{$c.cid}').slideDown(); $(this).parent().slideUp(); return false;">Click para verlo</a>.</div>
                                            
											<div id="hdn_{$c.cid}" style="display:none">{/if}
                                            
											{$c.c_html}
                                            
											{if $c.c_votos <= -3 || $c.c_status == 1 || !$c.user_activo}</div>{/if}
											
                                        </div>
                                    
									</div>
                                
								</div>
                            
							</div>
                            
							{/foreach}
                            
							{else}
                            	
								<div id="no-comments">Este post no tiene comentarios, S&eacute; el primero!</div>
                            
							{/if}
                            
							<!---->
                            
							<div id="nuevos"></div>
                            
							{literal}
                            
							<script type="text/javascript">
                            
							$(function(){
                            
							var zIndexNumber = 99;
                                	
									$('div.avatar-box').each(function(){
                                		
										$(this).css('zIndex', zIndexNumber);
                                		
										zIndexNumber -= 1;
                                	
									});
                            
							});
                            
							</script>
                            
							{/literal}