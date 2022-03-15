                                <div class="boxy-title">
								   <h3>Posts desaprobados</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">                          
								{if !$tsPosts.datos}
								<div class="phpostAlfa">No hay posts esperando aprobaci&oacute;n</div>
								{else}
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>ID</th>
										<th>Post</th>
										<th>Moderador</th>							
                                        <th>Raz&oacute;n</th>										
										<th>Fecha</th>                                                           
										<th>IP</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										{foreach from=$tsPosts.datos item=p}
										<tr id="report_{$p.post_id}">                                            
											<td>{$p.post_id}</td>
											<td><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html#pp_{$p.cid}" target="_blank">{$p.post_title|truncate:30}</a></td> 
											<td><a href="{$tsConfig.url}/perfil/{$p.user_name}" class="hovercard" uid="{$p.user_id}">{$p.user_name}</a></td>
											<td>{$p.reason}</td>
											<td>{$p.date|hace:true}</td> 
											<td>{$p.mod_ip}</td>                					
											<td class="admin_actions">
													<a href="#" onclick="mod.posts.view({$p.post_id}); return false;"><img src="{$tsConfig.images}/icons/find.png" title="Ver Post" /></a>
													<a href="#" onclick="mod.reboot({$p.post_id}, 'posts', 'reboot', false); return false;"><img src="{$tsConfig.images}/icons/reboot.png" title="Reactivar Post" /></a>
													<a href="{$tsConfig.url}/posts/editar/{$p.post_id}" target="_blank"><img src="{$tsConfig.images}/icons/edit.png" title="Editar Post" /></a>
													<a href="#" onclick="mod.posts.borrar({$p.post_id}, false); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Post" /></a>
											</td>
										</tr>
										{/foreach}
									</tbody>
									<tfoot>
										<td colspan="8">P&aacute;ginas: {$tsPosts.pages}</td>
									</tfoot>
								</table>
								{/if}								
                                </div>