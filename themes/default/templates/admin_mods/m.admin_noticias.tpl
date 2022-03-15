								<div class="boxy-title">
									<h3>Noticias</h3>
								</div>
								<div id="res" class="boxy-content">
								{if $tsSave}<div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div>{/if}																{if $tsDelete == 'true'}<div style="display: block;" class="mensajes ok">Noticia eliminada.</div>{/if}
									{if $tsAct == ''}
									Si necesitas hacer un comunicado a todos los usuarios en general, desde aqu&iacute; podr&aacute;s administrar tus anuncios y los usuarios sin importar donde se encuentren navegando podr&aacute;n visualizarlos.
									<hr class="separator" />
									<b>Lista de noticias</b>
									<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
										<thead>
											<th>ID</th>
											<th>Noticia</th>
											<th>Autor</th>
											<th>Fecha</th>
											<th>Estado</th>
											<th>Acciones</th>
										</thead>
										<tbody>
											{foreach from=$tsNews item=n}
											<tr>
												<td>{$n.not_id}</td>
												<td>{$n.not_body}</td>
												<td><a href="{$tsConfig.url}/perfil/{$n.user_name}" class="hovercard" uid="{$n.user_id}">{$n.user_name}</a></td>
												<td>{$n.not_date|hace:true}</td>
												<td id="status_noticia_{$n.not_id}">{if $n.not_active == 0}<font color="purple">Inactiva</font>{else}<font color="green">Activa</font>{/if}</td>
												<td class="admin_actions">
													<a href="{$tsConfig.url}/admin/news/editar/{$n.not_id}"><img src="{$tsConfig.images}/icons/editar.png" title="Editar" /></a>
													<a onclick="admin.news.accion({$n.not_id}); return false"><img src="{$tsConfig.images}/reactivar.png" title="Activar/Desactivar Noticia" /></a>
													<a href="{$tsConfig.url}/admin/news?act=borrar&nid={$n.not_id}"><img src="{$tsConfig.images}/icons/close.png" title="Borrar" /></a>
												</td>
											</tr>
											{/foreach}
										</tbody>
										<tfoot>
											<th colspan="6" style="text-align:right;"><input type="button" onclick="location.href = '{$tsConfig.url}/admin/news/nueva'" class="mBtn btnOk" value="Nueva noticia"/></th>
										</tfoot>
									</table>
									{elseif $tsAct == 'nuevo' || $tsAct == 'editar'}
									<form action="" method="post" autocomplete="off">
									<fieldset>
										<legend>{if $tsAct == 'nuevo'}Agregar nueva{else}Editar{/if} noticia</legend>
										<dl>
											<dt><label for="ai_new">Noticia:</label><br /><span>Puedes utilizar los siguentes BBCodes [url], [i] [b] y [u]. El m&aacute;ximo de caracteres permitidos es de <b>190</b>.</span></dt>
											<dd><textarea name="not_body" id="ai_new" rows="3" cols="50">{$tsNew.not_body}</textarea></dd>
										</dl>
										<dl>
											<dt><label for="ai_not_active">Activar noticia:</label><br /><span>Activar inmediatamente esta noticia en {$tsConfig.titulo}.</span></dt>
											<dd>
												<label><input name="not_active" type="radio" id="ai_not_active" value="1" {if $tsNew.not_active == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
												<label><input name="not_active" type="radio" id="ai_not_active" value="0" {if $tsNew.not_active != 1}checked="checked"{/if} class="radio"/>No</label>
											</dd>
										</dl>
										<p><input type="submit" name="save" value="{if $tsAct == 'new'}Agregar noticia{else}Guardar Cambios{/if}" class="btn_g"/></p>
									</fieldset>
									</form>
									{elseif $tsAct == 'borrar'}                                   
									<form action="" method="post" id="admin_form" autocomplete="off">									                                    
									<center><font color="red">Noticia eliminada</font>																		
									<hr />									                                    
									<input type="button" name="confirm" style="cursor:pointer;" onclick="location.href = '/admin/news?borrar=true'" value="Volver &#187;" class="btn_g">									
									{/if}									
								</div>