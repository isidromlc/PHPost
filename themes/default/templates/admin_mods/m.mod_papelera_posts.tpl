                                <div class="boxy-title">
								   <h3>Posts en la papelera</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								{if !$tsPospelera.datos}
								<div class="phpostAlfa">No hay posts eliminados</div>
								{else}
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>T&iacute;tulo</th>
										<th>Autor</th>
										<th>Moderador</th>
										<th>Raz&oacute;n</th>
										<th>Fecha</th>
										<th>IP</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										{foreach from=$tsPospelera.datos item=p}
										<tr id="report_{$p.post_id}">
											<td><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html" target="_blank">{$p.post_title|truncate:30}</a></td>
											<td><a href="{$tsConfig.url}/perfil/{$p.user_name}" class="hovercard" uid="{$p.user_id}">{$p.user_name}</a></td>
											<td><a href="{$tsConfig.url}/perfil/{$p.mod_name}" class="hovercard" uid="{$p.mod}">{$p.mod_name}</a></td>
											<td>{if $p.reason == 'undefined'}Indefinida{else}{$p.reason}{/if}</td>
											<td>{$p.date|hace:true}</td>
   										    <td id="moreinfo1_2">{$p.mod_ip}</td>
											<td class="admin_actions">
                                            <a href="#" onclick="mod.reboot({$p.post_id}, 'posts', 'reboot', false); return false;"><img src="{$tsConfig.images}/icons/reboot.png" title="Reactivar Post" /></a>
											</td>
										</tr>
										{/foreach}
									</tbody>
									<tfoot>
										<td colspan="7">P&aacute;ginas: {$tsPospelera.pages}</td>
									</tfoot>
								</table>
								{/if}
                                </div>