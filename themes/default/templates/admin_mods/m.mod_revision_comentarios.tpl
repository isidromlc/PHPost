                                <div class="boxy-title">
								   <h3>Comentarios desaprobados</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								{if !$tsComentarios.datos}
								<div class="phpostAlfa">No hay comentarios ocultos</div>
								{else}
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>ID</th>
										<th>Autor</th>
										<th>Contenido</th>
										<th>Post</th>
										<th>Fecha</th>
										<th>IP</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										{foreach from=$tsComentarios.datos item=c}
										<tr id="div_cmnt_{$c.cid}">
											<td>{$c.cid}</td>
											<td><a href="{$tsConfig.url}/perfil/{$c.user_name}" class="hovercard" uid="{$c.user_id}">{$c.user_name}</a></td>
											<td>{$c.c_body}</td>
											<td><a href="{$tsConfig.url}/posts/{$c.c_seo}/{$c.post_id}/{$c.post_title|seo}.html#pp_{$c.cid}" target="_blank">{$c.post_title}</a></td> 
											<td>{$c.c_date|hace:true}</td>                
   										    <td>{$c.c_ip}</td>
											<td class="admin_actions">
												<a href="#" onclick="ocultar_com({$c.cid}, {$c.c_user});"><img src="{$tsConfig.images}/icons/reboot.png" title="Reactivar/Ocultar Comentario" /></a>											
												<a href="#" onclick="borrar_com({$c.cid}, {$c.c_user}, {$c.post_id});"><img src="{$tsConfig.images}/icons/close.png" title="Eliminar comentario" /></a>											
											</td>
										</tr>
										{/foreach}
									</tbody>
									<tfoot>
										<td colspan="7">P&aacute;ginas: {$tsComentarios.pages}</td>
									</tfoot>
								</table>
								{/if}
                                </div>