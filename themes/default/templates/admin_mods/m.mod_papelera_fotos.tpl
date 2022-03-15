                                <div class="boxy-title">
								   <h3>Fotos en la papelera</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								{if !$tsFopelera.datos}
								<div class="phpostAlfa">No hay fotos eliminadas</div>
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
										{foreach from=$tsFopelera.datos item=f}
										<tr id="report_{$f.foto_id}">
											<td><a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title}.html" target="_blank">{$f.f_title|truncate:30}</a></td>
											<td><a href="{$tsConfig.url}/perfil/{$f.user_name}" class="hovercard" uid="{$f.user_id}">{$f.user_name}</a></td>
											<td><a href="{$tsConfig.url}/perfil/{$f.mod_name}" class="hovercard" uid="{$f.mod}">{$f.mod_name}</a></td>
											<td>{if $f.reason == 'undefined'}Indefinida{else}{$f.reason}{/if}</td>											
											<td>{$f.date|hace:true}</td>                
   										    <td>{$f.mod_ip}</td>
											<td class="admin_actions">
                                                    <a href="#" onclick="mod.reboot({$f.foto_id}, 'fotos', 'reboot', false); return false;"><img src="{$tsConfig.images}/icons/reboot.png" title="Reactivar Foto" /></a>
											</td>
										</tr>
										{/foreach}
									</tbody>
									<tfoot>
										<td colspan="7">P&aacute;ginas: {$tsFopelera.pages}</td>
									</tfoot>
								</table>
								{/if}
                                </div>