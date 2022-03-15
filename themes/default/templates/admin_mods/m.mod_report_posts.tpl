                                <div class="boxy-title">
                                    <h3>Moderaci&oacute;n de posts</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                {if $tsSave}<div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div>{/if}
                                	{if $tsAct == ''}
                                    Recuerda leer el protocolo para poder moderar los post que han sido denunciados por otros usuarios, si te es posible y se puede editar un post no lo borres, <b>Editalo!</b> 
                                    <hr class="separator" />
                                    <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
                                    	<thead>
                                        	<th>Denuncias</th>
                                            <th>Post</th>
                                            <th>Fecha</th>
                                            <th>Raz&oacute;n</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                        	{if $tsReports}{foreach from=$tsReports item=r}
                                            <tr id="report_{$r.post_id}">
                                            	<td>{$r.total}</td>
                                                <td><a href="{$tsConfig.url}/posts/{$r.c_seo}/{$r.post_id}/{$r.post_title|seo}.html" target="_blank">{$r.post_title|truncate:30}</a></td>
                                                <td>{$r.d_date|hace:true}</td>
                                                <td>{$tsDenuncias[$r.d_razon]}</td>
                                                <td class="admin_actions">
                                                    <a href="{$tsConfig.url}/moderacion/posts?act=info&obj={$r.post_id}"><img src="{$tsConfig.images}/icons/details.png" title="Ver Detalles" /></a>
                                                    <a href="#" onclick="mod.posts.view({$r.post_id}); return false;"><img src="{$tsConfig.images}/icons/find.png" title="Ver Post" /></a>
                                                    {if $tsUser->is_admod || $tsUser->permisos.mocdp}<a href="#" onclick="mod.reboot({$r.post_id}, 'posts', 'reboot', false); return false;"><img src="{$tsConfig.images}/icons/reboot.png" title="{if $r.post_status == 1}Reactivar Post{else}Desechar denuncias{/if}" /></a>{/if}
                                                    {if $tsUser->is_admod || $tsUser->permisos.moedpo}<a href="{$tsConfig.url}/posts/editar/{$r.post_id}" target="_blank"><img src="{$tsConfig.images}/icons/edit.png" title="Editar Post" /></a>{/if}
                                                    {if $tsUser->is_admod || $tsUser->permisos.moep}<a href="#" onclick="mod.posts.borrar({$r.post_id}, false); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Post" /></a>{/if}
                                                </td>
                                            </tr>
                                            {/foreach}{else}
                                            <tr>
                                                <td colspan="5"><div class="emptyData">No hay post denunciados hasta el momento.</div></td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">&nbsp;</th>
                                        </tfoot>
                                    </table>
                                    {elseif $tsAct == 'info'}
                                    <h2 style="border-bottom:1px dashed #CCC; padding-bottom:5px;">
                                        <a href="{$tsConfig.url}/posts/{$tsDenuncia.data.c_seo}/{$tsDenuncia.data.post_id}/{$tsDenuncia.data.post_title|seo}.html" target="_blank">{$tsDenuncia.data.post_title}</a> de <a href="{$tsConfig.url}/perfil/{$tsDenuncia.data.user_name}">{$tsDenuncia.data.user_name}</a> 
                                        <span class="floatR admin_actions">
                                            <a href="#" onclick="mod.posts.view({$tsDenuncia.data.post_id}); return false"><img src="{$tsConfig.images}/icons/find.png" title="Ver Post" /></a>
                                            {if $tsUser->is_admod || $tsUser->permisos.mocdp}<a href="#" onclick="mod.reboot({$tsDenuncia.data.post_id}, 'posts', 'reboot', true); return false"><img src="{$tsConfig.images}/icons/reboot.png" title="{if $tsDenuncia.data.post_status == 1}Reactivar Post{else}Desechar denuncias{/if}" /></a>{/if}
                                            {if $tsUser->is_admod || $tsUser->permisos.moedpo}<a href="{$tsConfig.url}/posts/editar/{$tsDenuncia.data.post_id}" target="_blank"><img src="{$tsConfig.images}/icons/edit.png" title="Editar Post" /></a>{/if}
                                            {if $tsUser->is_admod || $tsUser->permisos.moep}<a href="#" onclick="mod.posts.borrar({$tsDenuncia.data.post_id}, 'posts', true); return false"><img src="{$tsConfig.images}/icons/close.png" title="Borrar Post" /></a>{/if}
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