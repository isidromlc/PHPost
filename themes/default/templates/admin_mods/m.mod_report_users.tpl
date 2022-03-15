                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de usuarios</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                	{if $tsAct == ''}
                                     No suspendas a un usuario sin una causa razonable, si no tu podr&iacute;as hacerle compa&ntilde;ia.
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denuncias</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Raz&oacute;n</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsReports}{foreach from=$tsReports item=r}
                                            <tr id="report_{$r.obj_id}">
                                            	<td>{$r.total}</td>
                                                <td><a href="{$tsConfig.url}/perfil/{$r.user_name}" class="hovercard" uid="{$r.obj_id}">{$r.user_name}</a></td>
                                                <td>{$r.d_date|hace:true}</td>
                                                <td>{$tsDenuncias[$r.d_razon]}</td>
                                                <td class="admin_actions">
                                                    <a href="{$tsConfig.url}/moderacion/users?act=info&obj={$r.obj_id}"><img src="{$tsConfig.images}/icons/details.png" title="Ver Detalles" /></a>
                                                    <a href="{$tsConfig.url}/perfil/{$r.user_name}" target="_blank"><img src="{$tsConfig.images}/icons/user.png" title="Ver Perfil" /></a>
                                                    <a href="#" onclick="mod.users.action({$r.obj_id}, 'aviso', false); return false;"><img src="{$tsConfig.images}/icons/warning.png" title="Enviar Alerta" /></a>
                                                    {if $tsUser->is_admod || $tsUser->permisos.mosu}<a href="#" onclick="mod.users.action({$r.obj_id}, 'ban', false); return false;"><img src="{$tsConfig.images}/icons/power_off.png" title="Suspender Usuario" /></a>{/if}
                                                    {if $tsUser->is_admod || $tsUser->permisos.modu}<a href="#" onclick="mod.reboot({$r.obj_id}, 'users', 'reboot', false); return false"><img src="{$tsConfig.images}/icons/close.png" title="Cancelar denuncias" /></a>{/if}
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay usuarios denunciados hasta el momento.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    {elseif $tsAct == 'info'}
                                    <h2 style="border-bottom:1px dashed #CCC; padding-bottom:5px;">
                                        <a href="{$tsConfig.url}/perfil/{$tsDenuncia.data.user_name}">{$tsDenuncia.data.user_name}</a> 
                                        <span class="floatR admin_actions">
                                            <a href="#" onclick="mod.users.action({$tsDenuncia.data.user_id}, 'aviso', true); return false;"><img src="{$tsConfig.images}/icons/warning.png" title="Enviar Advertencia" /></a>
                                            <a href="#" onclick="mod.users.action({$tsDenuncia.data.user_id}, 'ban', true); return false;"><img src="{$tsConfig.images}/icons/power_off.png" title="Suspender Usuario" /></a>
                                            <a href="#" onclick="mod.reboot({$tsDenuncia.data.user_id}, 'users', 'reboot', true); return false"><img src="{$tsConfig.images}/icons/close.png" title="Cancelar denuncias" /></a>
                                        </span>
                                    </h2>
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denunciante</th>
                                            <th>Raz&oacute;n</th>
                                            <th>Informaci&oacute;n extra</th>
                                            <th>Fecha</th>
                                        </thead>
                                        <tbody>
                                        	{foreach from=$tsDenuncia.denun item=d}
                                            <tr>
                                            	<td><a href="{$tsConfig.url}/perfil/{$d.user_name}">{$d.user_name}</a></td>
                                                <td>{$tsDenuncias[$d.d_razon]}</td>
                                                <td>{$d.d_extra}</td>
                                                <td>{$d.d_date|hace:true}</td>
                                            </tr>
                                            {/foreach}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    {/if}
                                </div>