                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de usuarios</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                    {if $tsUser->is_admod != 1}S&oacute;lo puedes quitar la suspenci&oacute;n a los usuarios que t&uacute; hayas suspendido.<hr class="separator" />{/if}
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Usuario</th>
                                            <th>Causa</th>
                                            <th><a class="qtip" title="Ascendente" href="{$tsConfig.url}/moderacion/banusers?o=inicio&m=a"><</a>  Suspendido <a class="qtip" title="Descendente" href="{$tsConfig.url}/moderacion/banusers?o=inicio&m=d">></a> </th>
                                            <th><a class="qtip" title="Ascendente" href="{$tsConfig.url}/moderacion/banusers?o=fin&m=a"><</a>  Termina <a class="qtip" title="Descendente" href="{$tsConfig.url}/moderacion/banusers?o=fin&m=d">></a> </th>
                                            <th><a class="qtip" title="Ordenar por moderador ascendente" href="{$tsConfig.url}/moderacion/banusers?o=mod&m=a"><</a>  Lo suspendi&oacute; <a class="qtip" title="Ordenar por moderador descendente" href="{$tsConfig.url}/moderacion/banusers?o=mod&m=d">></a> </th>
                                            {if $tsUser->is_admod || $tsUser->permisos.modu}
											<th>Acciones</th>
											{/if}
                                        </thead>
                                        <tbody>
                                        	{if $tsSuspendidos.bans}{foreach from=$tsSuspendidos.bans item=s}
                                            <tr id="report_{$s.user_id}">
                                            	<td><a href="{$tsConfig.url}/perfil/{$s.user_name}" class="hovercard" uid="{$s.user_id}">{$s.user_name}</a></td>
                                                <td>{$s.susp_causa}</td>
                                                <td>{$s.susp_date|hace:true}</td>
                                                <td>{if $s.susp_termina == 0}Indefinidamente{elseif $s.susp_termina == 1}Permanentemente{else}{$s.susp_termina|date_format:"%d/%m/%Y a las %H:%M:%S"}{/if}</td>
                                                <td><a href="#" class="hovercard" uid="{$s.susp_mod}">{$tsUser->getUserName($s.susp_mod)}</a></td>
                                                {if $tsUser->is_admod || $tsUser->permisos.modu}
												<td class="admin_actions">
                                                    <a href="#" onclick="mod.reboot({$s.user_id}, 'users', 'unban', false); return false;"><img src="{$tsConfig.images}/icons/power_on.png" title="Reactivar usuario" /></a>
                                                </td>
												{/if}
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="6"><div class="emptyData">No hay usuarios suspendidos hasta el momento.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                    	
										<td colspan="6">P&aacute;ginas: {$tsSuspendidos.pages}</td>
                                    
									</tfoot>
                                    </table>
                                </div>
                                    