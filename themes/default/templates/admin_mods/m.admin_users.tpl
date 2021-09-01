                                <div class="boxy-title">
									<h3>Administrar Usuarios</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
								{if !$tsAct}
								{if !$tsMembers.data}
								<div class="phpostAlfa">No hay usuarios registrados.</div>
								{else}
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>Rango</th>
										<th>Usuario</th>
										<th><a class="qtip" title="Ordenar por email ascendente" href="{$tsConfig.url}/admin/users?o=c&m=a"><</a> Email <a class="qtip" title="Ordenar por email descendente" href="{$tsConfig.url}/admin/users?o=c&m=d">></a></th>
										<th><a class="qtip" title="Ordenar por &uacute;ltima vez activo ascendente" href="{$tsConfig.url}/admin/users?o=u&m=a"><</a> &Uacute;ltima actividad <a class="qtip" title="Ordenar por &uacute;ltima vez activo desccendente" href="{$tsConfig.url}/admin/users?o=u&m=d">></a></th>
										<th>Registro</th>
										<th><a class="qtip" title="Ordenar por IP ascendente" href="{$tsConfig.url}/admin/users?o=i&m=a"><</a> IP <a class="qtip" title="Ordenar por IP descendente" href="{$tsConfig.url}/admin/users?o=i&m=d">></a> </th>
										<th><a class="qtip" title="Ordenar por estado ascendente" href="{$tsConfig.url}/admin/users?o=e&m=a"><</a> Estado <a class="qtip" title="Ordenar por estado descendente" href="{$tsConfig.url}/admin/users?o=e&m=d">></a></th>
										<th>Acciones</th>
									</thead>
									<tbody>
										{foreach from=$tsMembers.data item=m}
										<tr>
											<td><img src="{$tsConfig.default}/images/icons/ran/{$m.r_image}" /></td>
											<td align="left"><a href="{$tsConfig.url}/perfil/{$m.user_name}" class="hovercard" uid="{$m.user_id}" style="color:#{$m.r_color};">{$m.user_name}</a></td>
											<td>{$m.user_email}</td>
											<td>{if $m.user_lastactive == 0} Nunca{else}{$m.user_lastactive|hace:true}{/if}</td>
											<td>{$m.user_registro|date_format:"%d/%m/%Y"}</td>
											<td><a href="{$tsConfig.url}/moderacion/buscador/1/1/{$m.user_last_ip}" class="geoip" target="_blank">{$m.user_last_ip}</a></td>
											<td id="status_user_{$m.user_id}">{if $m.user_baneado == 1}<font color="red">Suspendido</font>{elseif $m.user_activo == 0}<font color="purple">Inactivo</font>{else}<font color="green">Activo</font>{/if}</td>
											<td class="admin_actions">
												<a href="{$tsConfig.url}/admin/users?act=show&uid={$m.user_id}"><img src="{$tsConfig.default}/images/icons/editar.png" title="Editar Usuario" /></a>												
												<a onclick="admin.users.setInActive({$m.user_id}); return false;"><img src="{$tsConfig.default}/images/reactivar.png" title="Activar/Desactivar Usuario" /></a>
                                                <a href="#" onclick="mod.users.action({$m.user_id}, 'aviso', false); return false;"><img src="{$tsConfig.default}/images/icons/warning.png" title="Enviar Alerta" /></a>
												<a href="#" onclick="mod.{if $m.user_baneado == 1}reboot({$m.user_id}, 'users', 'unban', false){else}users.action({$m.user_id}, 'ban', false){/if}; return false;"><img src="{$tsConfig.default}/images/icons/power_{if $m.user_baneado == 1}on{else}off{/if}.png" title="{if $m.user_baneado == 1}Reactivar{else}Suspender{/if} Usuario" /></a>
											</td>
										</tr>
										{/foreach}
									</tbody>
									<tfoot>
										<td colspan="8">P&aacute;ginas: {$tsMembers.pages}</td>
									</tfoot>
								</table>
								{/if}
								{elseif $tsAct == 'show'}
								<div class="admin_header">
								<h1>Administrar: <strong>{$tsUsername}</strong></h1>
								<div class="floatR"><strong>Seleccionar:</strong> 
									<select onchange="location.href='{$tsConfig.url}/admin/users?act=show&uid={$tsUserID}&t=' + this.value;">
										<option value="1"{if $tsType == 1} selected="true"{/if}>Vista general</option>
										<option value="5"{if $tsType == 5} selected="true"{/if}>Preferencias</option>
                                        <option value="6"{if $tsType == 6} selected="true"{/if}>Borrar Contenido</option>
										<option value="7"{if $tsType == 7} selected="true"{/if}>Rango</option>
										<option value="8"{if $tsType == 8} selected="true"{/if}>Firma</option>
									</select>
								</div>
								<div class="clearBoth"></div>
								</div>
								{if $tsSave}<div class="mensajes ok">Tus cambios han sido guardados.</div>{/if}
								{if $tsError}<div class="mensajes error">{$tsError}</div>{/if}
								<form action="" method="post">
									<fieldset>
									{if !$tsType || $tsType == 1}
										<legend>Vista general</legend>
										<dl>
											<dt><label for="user">Nombre de Usuario:</label></dt>
											<dd><input type="text" name="nick" id="user" value="{$tsUserD.user_name}" class="qtip" title="El nick s&oacute;lo se cambiar&aacute; si escribe una nueva contrase&ntilde;a" /></dd>
										</dl>
										<dl>
											<dt><label for="user">Rango:</label></dt>
											<dd><strong style="color:#{$tsUserD.r_color}">{$tsUserD.r_name}</strong></dd>
										</dl>
										<dl>
											<dt><label for="registro">Registrado:</label></dt>
											<dd><strong>{$tsUserD.user_registro|date_format:"%d/%m/%Y a las %H:%M"}</strong></dd>
										</dl>
										<dl>
											<dt><label>&Uacute;ltima vez activo:</label></dt>
											<dd><strong>{$tsUserD.user_lastactive|hace}</strong></dd>
										</dl>
										<dl>
											<dt><label>Puntos:</label></dt>
											<dd><input type="text" name="points" id="points" value="{$tsUserD.user_puntos}" style="width:10%" /></dd>
										</dl>
										<dl>
											<dt><label>Puntos para dar:</label></dt>
											<dd><input type="text" name="pointsxdar" id="pointsxdar" value="{$tsUserD.user_puntosxdar}" style="width:10%" /></dd>
										</dl>
										<dl>
											<dt><label>Cambios de nick disponibles:</label></dt>
											<dd><input type="text" name="changenicks" id="changenicks" value="{$tsUserD.user_name_changes}" style="width:10%" /></dd>
										</dl>
										<hr />
										<dl>
											<dt><label for="email">E-mail:</label></dt>
											<dd><input type="text" name="email" id="email" value="{$tsUserD.user_email}" /></dd>
										</dl>
										<dl>
											<dt><label for="pwd">Nueva contrase&ntilde;a:</label><br /><span>Debe tener entre 5 y 35 caracteres.</span></dt>
											<dd><input type="password" name="pwd" id="pwd" onkeypress="if($('#cpwd').val() != '') $('#sendata').fadeIn();"/></dd>
										</dl>
										<dl>
											<dt><label for="cpwd">Confirmar contrase&ntilde;a:</label><br /><span>Necesita confirmar su contrase&ntilde;a s&oacute;lo si la ha cambiado arriba.</span></dt>
											<dd><input type="password" name="cpwd" id="cpwd" onkeypress="if($('#pwd').val() != '') $('#sendata').fadeIn();"/></dd>
										</dl>
										 <dl id="sendata" style="display:none;">
											<dt><label for="sendata">Informar al usuario</label><br /><span>Marque esta casilla si quiere enviar un e-mail al usuario con los nuevos datos</span></dt>
											<dd><input type="checkbox" name="sendata"/></dd>
										</dl>
									{elseif $tsType == 5}
									<legend>Modificar privacidad del usuario</legend>
										<h2 class="active">&iquest;Qui&eacute;n puede...</h2>
									<div class="field">
										<dl>
											<dt><label>ver su muro?</label></dt>
											<dd>
												<select name="muro" style="width:270px;">
												{foreach from=$tsPrivacidad item=p key=i}
												<option value="{$i}"{if $tsPerfil.p_configs.m == $i} selected="true"{/if}>{$p}</option>
												{/foreach}
												</select>
											</dd>
										</dl>                    				
									</div>
									{$tsPerfil.p_configs.muro}
									<div class="field">
										<dl>
										<dt><label>firmar su muro?</label></dt>
											<dd>
												<select name="muro_firm" style="width:270px;">
												{foreach from=$tsPrivacidad item=p key=i}
												{if $i != 6}<option value="{$i}"{if $tsPerfil.p_configs.mf == $i}selected{/if}>{$p}</option>{/if}
												{/foreach}
												</select>
											</dd>
										</dl>
									</div>
									<div class="field">
										<dl>
										<dt><label>ver visitantes recientes?</label></dt>
											<dd>
												<select name="last_hits" style="width:270px;">
												{foreach from=$tsPrivacidad item=p key=i}
												{if $i != 1 && $i != 2}<option value="{$i}"{if $tsPerfil.p_configs.hits == $i}selected{/if}>{$p}</option>{/if}
												{/foreach}
												</select>
											</dd>
										</dl>
									</div>
									<div class="field">
											<dl>
												<dt><label>enviarles mensajes privados?</label><br /><span>Esta opci&oacute;n no se aplica a moderadores y administradores.</span></dt>
												<dd>
													<select name="rec_mps" style="width:270px;">
														{foreach from=$tsPrivacidad item=p key=i}
														{if $i != 6}<option value="{$i}"{if $tsPerfil.p_configs.rmp == $i}selected{/if}>{$p}</option>{/if}
														{/foreach}
														<option value="8"{if $tsPerfil.p_configs.rmp == 8}selected{/if}>Deshabilitar mensajer&iacute;a (opci&oacute;n administrativa)</option>
													</select>
												</dd>
											</dl>
									</div>
                                    {elseif $tsType == 6}
									<legend>Eliminaci&oacute;n de contenidos</legend>
										<input type="checkbox" id="bocuenta" name="bocuenta" onclick="$('#ext').slideToggle();"/><label style="font-weight:bold;" for="bocuenta">Cuenta Completa</label><label for="bocuenta"> &nbsp; Se eliminar&aacute; la cuenta y todo el contenido relacionado a {$tsUsername}.</label>
										<div id="ext">
                                        <br /><hr/>
                                        <input type="checkbox" id="boposts" name="boposts"/><label style="font-weight:bold;" for="boposts">Posts</label><label for="boposts"> &nbsp; Se eliminar&aacute;n todos sus posts y sus comentarios.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bofotos" name="bofotos"/><label style="font-weight:bold;" for="bofotos">Fotos</label><label for="bofotos"> &nbsp; Se eliminar&aacute;n todas sus fotos publicadas y sus comentarios.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boestados" name="boestados"/><label style="font-weight:bold;" for="boestados">Estados</label><label for="boestados"> &nbsp; Se eliminar&aacute;n todas sus publicaciones de muros</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomposts" name="bocomposts"/><label style="font-weight:bold;" for="bocomposts">Comentarios de Posts</label><label for="bocomposts"> &nbsp; Se eliminar&aacute;n todos sus comentarios en posts.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomfotos" name="bocomfotos"/><label style="font-weight:bold;" for="bocomfotos">Comentarios de Fotos</label><label for="bocomfotos"> &nbsp; Se eliminar&aacute;n todos sus comentarios en fotos.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomestados" name="bocomestados"/><label style="font-weight:bold;" for="bocomestados">Comentarios en Estados</label><label for="bocomestados"> &nbsp; Se eliminar&aacute;n todos sus comentarios en estados</label>
										<br /><hr/>
                                        <input type="checkbox" id="bolike" name="bolike"/><label style="font-weight:bold;" for="bolike">Like</label><label for="bolike"> &nbsp; Se eliminar&aacute;n sus likes en estados y comentarios en estados</label>
										<br /><hr/>
                                        <input type="checkbox" id="boseguidores" name="boseguidores"/><label style="font-weight:bold;" for="boseguidores">Seguidores</label><label for="boseguidores"> &nbsp; Se eliminar&aacute; la lista de todos sus seguidores.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bosiguiendo" name="bosiguiendo"/><label style="font-weight:bold;" for="bosiguiendo">Siguiendo</label><label for="bosiguiendo"> &nbsp; Se eliminar&aacute; la lista de todos a los que sigue.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bofavoritos" name="bofavoritos"/><label style="font-weight:bold;" for="bofavoritos">Favoritos</label><label for="bofavoritos"> &nbsp; Se eliminar&aacute; la lista de favoritos que haya agregado.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovotosposts" name="bovotosposts"/><label style="font-weight:bold;" for="bovotosposts">Votos en Posts</label><label for="bovotosposts"> &nbsp; Se eliminar&aacute;n los votos de puntos que haya dejado en posts.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovotosfotos" name="bovotosfotos"/><label style="font-weight:bold;" for="bovotosfotos">Votos en Fotos</label><label for="bovotosfotos"> &nbsp; Se eliminar&aacute;n los votos positivos y negativos que haya dejado en fotos.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boactividad" name="boactividad"/><label style="font-weight:bold;" for="boactividad">Actividad</label><label for="boactividad"> &nbsp; Se eliminar&aacute; toda su actividad.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boavisos" name="boavisos"/><label style="font-weight:bold;" for="boavisos">Avisos</label><label for="boavisos"> &nbsp; Se eliminar&aacute;n todos los avisos que ha recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bobloqueos" name="bobloqueos"/><label style="font-weight:bold;" for="bobloqueos">Bloqueos</label><label for="bobloqueos"> &nbsp; Se eliminar&aacute;n todos los bloqueos que ha recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bomensajes" name="bomensajes"/><label style="font-weight:bold;" for="bomensajes">Mensajes Privados</label><label for="bomensajes"> &nbsp; Se eliminar&aacute;n todos los mensajes que ha enviado y recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bosesiones" name="bosesiones"/><label style="font-weight:bold;" for="bosesiones">Sesiones</label><label for="bosesiones"> &nbsp; Se eliminar&aacute;n todas las sesiones.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovisitas" name="bovisitas"/><label style="font-weight:bold;" for="boavisos">Visitas</label><label for="bovisitas"> &nbsp; Se eliminar&aacute;n todo rastro de visitas de este usuario en perfiles, posts y fotos.</label>
										</div>
                                        <br /><hr/>
                                        Introduzca su contrase&ntilde;a para continuar: <input type="password" name="password"/>
                                        
									{elseif $tsType == 7}
									<legend>Modificar rango de usuario</legend>
										<dl>
											<dt><label>Rango actual:</label></dt>
											<dd><strong style="color:#{$tsUserR.user.r_color}">{$tsUserR.user.r_name}</strong></dd>
										</dl>
										<dl>
											<dt><label for="user">Nuevo rango:</label></dt>
											<dd><select name="new_rango">
											{foreach from=$tsUserR.rangos item=r}
											<option value="{$r.rango_id}" style="color:#{$r.r_color}" {if $r.rango_id == $tsUserR.user.rango_id}selected="selected"{/if}>{$r.r_name}</option>
											{/foreach}
											</select></dd>
										</dl>
									{elseif $tsType == 8}
									<legend>Modificar firma de usuario</legend>
									<textarea name="firma" rows="3" cols="50">{$tsUserF.user_firma}</textarea>
									{else}
									<div class="phpostAlfa">Pendiente</div>
									{/if}
									<p><input type="submit" name="save" value="Enviar Cambios" class="btn_g"/></p>
									</fieldset>
								</form>
								{/if}
								</div>