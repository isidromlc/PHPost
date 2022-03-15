                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de mensajes</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                {if $tsSave}<div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div>{/if}
                                	{if $tsAct == ''}
                                    Recuerda leer el protocolo para poder moderar los mensajes que han sido denunciados por otros usuarios. Si no est&aacute; seguro de la acci&oacute;n a tomar, hable con el denunciante para obtener m&aacute;s informaci&oacute;n.
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                            <th>T&iacute;tulo</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsReports}{foreach from=$tsReports item=r}
                                            <tr id="report_{$r.mp_id}">
                                                <td><a href="{$tsConfig.url}/mensajes/leer/{$r.mp_id}" target="_blank">{$r.mp_subject|truncate:30}</a></td>
                                                <td>{$r.d_date|hace:true}</td>
                                                <td class="admin_actions">
												    <a href="{$tsConfig.url}/moderacion/mps?act=info&obj={$r.mp_id}"><img src="{$tsConfig.images}/icons/details.png" title="Ver Detalles" /></a>
													<a href="#" onclick="mod.users.action({$r.mp_from}, 'aviso', false); return false;"><img src="{$tsConfig.images}/icons/warning.png" title="Enviar alerta al autor" /></a>
                                                    {if $tsUser->is_admod || $tsUser->permisos.mosu}<a href="#" onclick="mod.users.action({$r.mp_from}, 'ban', false); return false;"><img src="{$tsConfig.images}/icons/power_off.png" title="Suspender al autor" /></a>{/if}
													<a href="#" onclick="mod.users.action({$r.mp_to}, 'aviso', false); return false;"><img src="{$tsConfig.images}/icons/warning.png" title="Enviar alerta al receptor" /></a>
                                                    {if $tsUser->is_admod || $tsUser->permisos.mosu}<a href="#" onclick="mod.users.action({$r.mp_to}, 'ban', false); return false;"><img src="{$tsConfig.images}/icons/power_off.png" title="Suspender al receptor" /></a>{/if}
                                                    {if $tsUser->is_admod || $tsUser->permisos.mocdm}<a href="#" onclick="mod.reboot({$r.mp_id}, 'mps', 'reboot', false); return false;"><img src="{$tsConfig.images}/icons/reboot.png" title="Desechar denuncias" /></a>{/if}
													{if $tsUser->is_admod || $tsUser->permisos.moadm}<a href="#" onclick="mod.mps.borrar({$r.mp_id}); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Mensaje" /></a>{/if}
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay mensajes denunciados hasta el momento.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
									{elseif $tsAct == 'info'}
                                    <h2 style="border-bottom:1px dashed #CCC; padding-bottom:5px;">
                                    </h2>
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denunciante</th>
                                            <th>Fecha</th>
											<th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{foreach from=$tsDenuncia.denun item=d}
                                            <tr>
                                            	<td><a href="{$tsConfig.url}/perfil/{$d.user_name}">{$d.user_name}</a></td>
                                                <td>{$d.d_date|hace:true}</td>
												<td class="admin_actions">
                                                <a href="#" onclick="mensaje.nuevo('{$d.user_name}','[Moderaci&oacute;n] Mensaje reportado','Hola {$d.user_name}, me comunico con usted para pedirle informaci&oacute;n sobre...','Recuerde que este mensaje no ser&aacute; enviado como personal.'); return false"><span>MP</span></a>
												</td>
                                            </tr>
                                            {/foreach}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    {/if}
                                </div>