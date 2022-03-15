                                <div class="boxy-title">
									<h3>Buscador de Contenido</h3>
								</div>
								<div id="res" class="boxy-content">
									{if !$tsAct}
									 Esa herramienta le mostrar&aacute; las coindicencias del contenido o ip en una publicaci&oacute;n de un muro, usuario, post, foto o comentario.
									 <hr>
									 <p style="font-weight:bold;">IP</p>
									 <p>Se mostrar&aacute; todo el contenido relacionado con la IP introducida, si es parecida (parcial), o exactamente la misma (exacta).
									 <hr>
									 <p style="font-weight:bold;">Texto</p>
									 <p>El usuario se mostrar&aacute; por nombre.</p>
									 <p>En el muro, se buscar&aacute; por contenido de la publicaci&oacute;n</p>
									 <p>En los posts y las fotos, se buscar&aacute; por t&iacute;tulo o contenido/descripci&oacute;n.</p>
									 <p>En los comentarios, se buscar&aacute; por contenido o autor del comentario. Para buscar al autor, se introduce el ID de &eacute;ste.</p>
									<hr class="separator" />
									<form action="" method="post">
										<input type="search" name="texto" required>
											<select name="m">
												<option value="1">Parcial</option>
												<option value="2">Exacta</option>
											</select>
											<select name="t">
												<option value="1">IP</option>
												<option value="2">Texto</option>
											</select>
										<input type="submit" name="buscar" value="Buscar Contenido" class="btn_g"/>
									</form>
									{elseif $tsAct == 'search'}
									<form action="" method="post">
									<input type="search" name="texto" value="{$tsContenido.contenido}" required>
									<select name="m">
									<option value="1" {if $tsContenido.metodo == 1}selected{/if}>Parcial</option>
									<option value="2" {if $tsContenido.metodo != 1}selected{/if}>Exacta</option>
									</select>
									<select name="t">
									<option value="1" {if $tsContenido.tipo == 1}selected{/if}>IP</option>
									<option value="2" {if $tsContenido.tipo != 1}selected{/if}>Texto</option>
									</select>
									<input type="submit" name="buscar" value="Buscar Contenido" class="btn_g"/>
									</form>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="usuarios">
                                    	<thead>
                                        	<th>Usuario</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.usuarios}{foreach from=$tsContenido.usuarios item=u}
                                            <tr>
                                                <td><a href="{$tsConfig.url}/perfil/{$u.user_name}" class="hovercard" uid="{$u.user_id}">{$u.user_name}</a></td>
                                                <td><a href="http://oxi.mx/g/{$u.user_last_ip}" class="geoip" title="Información de IP" target="_blank">{$u.user_last_ip}</a></td>
												<td>{$u.user_lastlogin|hace:true}</td>
                                                <td class="admin_actions">
                                               <a href="#" onclick="mod.users.action({$u.user_id}, 'ban', false); return false;"><img src="{$tsConfig.images}/icons/power_off.png" title="Suspender Usuario" /></a>
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Usuarios.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
									<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="muro">
                                    	<thead>
                                        	<th>Autor</th>
											<th>Contenido</th>
											<th>IP</th>
											<th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.muro}{foreach from=$tsContenido.muro item=m}
                                            <tr>
                                                <td><a href="{$tsConfig.url}/perfil/{$m.user_name}" class="hovercard" uid="{$m.user_id}">{$m.user_name}</a></td>
                                                <td>{$m.p_body}</td>
												<td><a href="http://oxi.mx/g/{$m.p_ip}" class="geoip" title="Información de IP" target="_blank">{$m.p_ip}</a></td>
												<td>{$m.p_date|hace:true}</td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Muro.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="posts">
                                    	<thead>
                                        	<th>Post</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.posts}{foreach from=$tsContenido.posts item=p}
                                            <tr id="report_{$r.obj_id}">
                                                <td><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html" target="_blank">{$p.post_title}</a></td>
												<td><a href="{$tsConfig.url}/perfil/{$p.user_name}" class="hovercard" uid="{$p.post_user}">{$p.user_name}</a></td>
                                                <td><a href="http://oxi.mx/g/{$p.post_ip}" class="geoip" title="Información de IP" target="_blank">{$p.post_ip}</a></td>
												<td>{$p.post_date|hace:true}</td>
                                                <td class="admin_actions">
													<a href="#" onclick="mod.posts.borrar({$p.post_id}, 'posts'); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Post" /></a>
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Posts.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="fotos">
                                    	<thead>
                                        	<th>Foto</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.fotos}{foreach from=$tsContenido.fotos item=f}
                                            <tr>
                                                <td><a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title|seo}.html" target="_blank">{$f.f_title}</a></td>
												<td><a href="{$tsConfig.url}/perfil/{$f.user_name}" class="hovercard" uid="{$f.f_user}">{$f.user_name}</a></td>
                                                <td><a href="http://oxi.mx/g/{$f.f_ip}" class="geoip" title="Información de IP" target="_blank">{$f.f_ip}</a></td>
												<td>{$f.f_date|hace:true}</td>
                                                <td class="admin_actions">
														<a href="#" onclick="mod.fotos.borrar({$f.foto_id}); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Foto" /></a>                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en Fotos.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="p_comentarios">
                                    	<thead>
                                        	<th>Comentario</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.p_comentarios}{foreach from=$tsContenido.p_comentarios item=c}
                                            <tr id="comentario_{$c.cid}">
                                                <td>{$c.c_body|truncate:100}</td>
												<td><a href="{$tsConfig.url}/perfil/{$c.user_name}" class="hovercard" uid="{$c.c_user}">{$c.user_name}</a></td>
                                                <td><a href="http://oxi.mx/g/{$c.c_ip}" class="geoip" title="Información de IP" target="_blank">{$c.c_ip}</a></td>
												<td>{$c.c_date|hace:true}</td>
                                                <td class="admin_actions">
                                                    <a href="#" onclick="ocultar_com({$c.cid}, {$c.user_id}); return false"><img src="{$tsConfig.images}/reactivar.png" title="Mostrar/Ocultar Comentario" /></a>
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en comentarios de Posts.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									<hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center" id="f_comentarios">
                                    	<thead>
                                        	<th>Comentario</th>
											<th>Foto</th>
											<th>Autor</th>
											<th>IP</th>
											<th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsContenido.f_comentarios}{foreach from=$tsContenido.f_comentarios item=c}
                                            <tr>
                                                <td>{$c.c_body|truncate:45}</td>
                                                <td><a href="{$tsConfig.url}/fotos/{$c.user_name}/{$c.foto_id}/{$c.f_title|seo}.html" target="_blank">{$c.f_title}</a></td>
												<td><a href="{$tsConfig.url}/perfil/{$c.user_name}" class="hovercard" uid="{$c.c_user}">{$c.user_name}</a></td>
                                                <td><a href="http://oxi.mx/g/{$c.c_ip}" class="geoip" title="Información de IP" target="_blank">{$c.c_ip}</a></td>
												<td>{$c.c_date|hace:true}</td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay coincidencias en comentarios de fotos.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    {/if}
                                </div>