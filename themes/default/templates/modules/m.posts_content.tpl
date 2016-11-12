                	<div class="post-contenedor">
					
                    	<div class="post-title">
							
							<h1>{$tsPost.post_title}</h1>
                            
							<a title="Post Anterior (m&aacute;s viejo)" class="icons anterior" href="{$tsConfig.url}/posts/prev?id={$tsPost.post_id}"></a>
                            
							<a class="fortuitare" href="{$tsConfig.url}/posts/fortuitae"><img class="qtip" title="Post aleatorio" src="{$tsConfig.tema.t_url}/images/arrow-join.png"/></a>
							
							<a title="Post Siguiente (m&aacute;s nuevo)" class="icons siguiente" href="{$tsConfig.url}/posts/next?id={$tsPost.post_id}"></a>
                        
                        {if $tsPost.puntos && ($tsPost.post_user == $tsUser->uid || $tsUser->is_admod)}
                        
                        <div style="display:none;" id="ver_puntos">
                        
                        <br />
                        
                        {foreach from=$tsPost.puntos item=p}
        			         
                             <a href="{$tsConfig.url}/perfil/{$p.user_name}" style="display:inline-block;"><img src="{$tsConfig.url}/files/avatar/{$p.user_id}_50.jpg" class="vctip" title="{$p.user_name} ha dejado {$p.cant} puntos" width="32" height="32"/></a>
                        
                        {/foreach}
                        
                        </div>
                        
                        <img style="margin-top: 5px; margin-bottom: -21px; cursor:pointer;" title="Puntos entregados" onclick="$('#ver_puntos').slideToggle(); return false" src="http://png-2.findicons.com/files//icons/1689/splashy/16/arrow_state_grey_expanded.png"/>
                        
                        {/if}
                                                
                        </div>
                        
						<div class="post-contenido">
                        
							{if !$tsUser->is_member}{include file='modules/m.global_ads_728.tpl'}{/if}
                            
							{if $tsPost.post_user == $tsUser->uid && $tsUser->is_admod == 0 && $tsUser->permisos.most == false && $tsUser->permisos.moayca == false && $tsUser->permisos.moo == false && $tsUser->permisos.moep ==  false && $tsUser->permisos.moedpo == false}
							
							<div class="floatR">
                                
								<a title="Borrar Post" onclick="borrar_post(); return false;" href="" class="btnActions">
                                    
									<img alt="Borrar" src="{$tsConfig.images}/borrar.png"/> Borrar</a>
                                
								<a title="Editar Post" onclick="location.href='{$tsConfig.url}/posts/editar/{$tsPost.post_id}'; return false" href="" class="btnActions">
                                    
									<img alt="Editar" src="{$tsConfig.images}/editar.png"/> Editar</a>
                            </div>
                            
							{elseif ($tsUser->is_admod && $tsPost.post_status == 0) || $tsUser->permisos.most || $tsUser->permisos.moayca || $tsUser->permisos.moop || $tsUser->permisos.moep || $tsUser->permisos.moedpo}
                            							
							<div class="mod-actions inline">
                                
								<strong>Moderar Post:</strong>
                                
								{if $tsUser->is_admod || $tsUser->permisos.most}<a href="#" onclick="mod.reboot({$tsPost.post_id}, 'posts', 'sticky', false); if($(this).text() == 'Poner Sticky') $(this).text('Quitar Sticky'); else $(this).text('Poner Sticky'); return false;" class="sticky">{if $tsPost.post_sticky == 1}Quitar{else}Poner{/if} Sticky</a>{/if}
                                
								{if $tsUser->is_admod || $tsUser->permisos.moayca}<a href="#" onclick="mod.reboot({$tsPost.post_id}, 'posts', 'openclosed', false); if($(this).text() == 'Cerrar Post') $(this).text('Abrir Post'); else $(this).text('Cerrar Post'); return false;" class="openclosed">{if $tsPost.post_block_comments == 1}Abrir{else}Cerrar{/if} Post</a>{/if}
								
								{if $tsUser->is_admod || $tsUser->permisos.moop}<a id="desaprobar" href="#" onclick="$('#desapprove').slideToggle(); $(this).fadeOut().remove();" class="des_approve">Ocultar Post</a>{/if}
								
								{if $tsUser->is_admod || $tsUser->permisos.moedpo || $tsAutor.user_id == $tsUser->uid}<a href="{$tsConfig.url}/posts/editar/{$tsPost.post_id}" class="edit">Editar</a>{/if}
                                
								{if $tsUser->is_admod || $tsUser->permisos.moep || $tsAutor.user_id == $tsUser->uid}<a href="#" onclick="{if $tsAutor.user_id != $tsUser->uid}mod.posts.borrar({$tsPost.post_id}, 'posts', null);{else}borrar_post();{/if} return false;" class="delete">Borrar</a>{/if}
                                
                            </div>
							
							<div id="desapprove" style="display:none;">
							                            
							<span style="display: none;" class="errormsg"></span>
                            
							<input type="text" id="d_razon" name="d_razon" maxlength="150" size="60" class="text-inp" placeholder="Raz&oacute;n de la revisi&oacute;n" style="width:578px"/ required>
									
							<input type="button" class="mBtn btnDelete" name="desapprove" value="Continuar" href="#" onclick="mod.posts.ocultar('{$tsPost.post_id}'); return false;"/>
							
							</div>
                            
							<br />
                            
							{/if}
							                            
							<span>
                            	
								{$tsPost.post_body}
                            
							</span>
                            
							{if $tsPost.user_firma && $tsConfig.c_allow_firma}
                            
							<hr class="divider" />
                            
							<span>
                            	
								{$tsPost.user_firma}
                            
							</span>
                            
							{/if}
                            
							<div class="compartir-mov" style="text-align: right; color:#888; font-size: 14px;margin: 30px 0 10px">
                            	
								<div class="m-left"></div>
                                
								<div class="m-right"></div>
                                
								<ul class="post-compartir clearbeta">
                                    
									<li class="share-big">
                                    	
										<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="{$tsConfig.titulo}" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
									
									</li>
                                    
									<li class="share-big">
									 	
										<a name="fb_share" share_url="{$tsConfig.url}/posts/{$tsPost.categoria.c_seo}/{$tsPost.post_id}/{$tsPost.post_title|seo}.html" type="box_count" href="http://www.facebook.com/sharer.php">Compartir</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
									
									</li>
                                    
									<li class="share-big">
									 	
										<span class="share-t-count">{$tsPost.post_shared}</span>
										
										<a href="{if !$tsUser->is_member}javascript:registro_load_form(); return false{else}javascript:notifica.sharePost({$tsPost.post_id}){/if}" class="share-t"></a>
									
									</li>
                                    
									<li class="txt-movi">Compartir en:</li>
                                
								</ul>
                            
							</div>
                            
							{include file='modules/m.global_ads_728.tpl'}
                        
						</div>
	                    
						{include file='modules/m.posts_metadata.tpl'}
                    
					</div>