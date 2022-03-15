                	<div class="post-autor vcard">
                    	<div class="box_title">
                        	<div class="box_txt post_autor">Posteado por:</div>
                            <div class="box_rss">
                            	<a href="{$tsConfig.url}/rss/posts-usuario/{$tsAutor.user_name}">
                                	<span style="position:relative;">
                                    <img border="0" title="RSS con posts de {$tsAutor.user_name}" alt="RSS con posts de Usuario" style="position:absolute; top:-354px; clip:rect(352px 16px 368px 0px);" src="{$tsConfig.images}/big1v12.png"/>
                                    <img border="0" style="width:14px;height:12px" src="{$tsConfig.images}/space.gif"/>
                                    </span>
                                 </a>
                            </div>
                        </div>
                        <div class="box_cuerpo">
                        	<div class="avatarBox">
                                <a href="{$tsConfig.url}/perfil/{$tsAutor.user_name}">
                                    <img title="Ver perfil de {$tsAutor.user_name}" alt="Ver perfil de {$tsAutor.user_name}" class="avatar" src="{$tsConfig.url}/files/avatar/{$tsAutor.user_id}_120.jpg"/>
                                </a>
							</div>
                            <a href="{$tsConfig.url}/perfil/{$tsAutor.user_name}" style="text-decoration:none">
								<span class="given-name" style="color:#{$tsAutor.rango.r_color}">{$tsAutor.user_name}</span>
							</a>
                            <br />
                            <span class="title">{$tsAutor.rango.r_name}</span>
                            <br />
                            <img src="{$tsConfig.images}/space.gif" class="status {$tsAutor.status.css}" title="{$tsAutor.status.t}"/>
                            <img src="{$tsConfig.images}/icons/ran/{$tsAutor.rango.r_image}" title="{$tsAutor.rango.r_name}" />
                            <img src="{$tsConfig.images}/icons/{if $tsAutor.user_sexo == 0}female{else}male{/if}.png" title="{if $tsAutor.user_sexo == 0}Mujer{else}Hombre{/if}" />
                            <img src="{$tsConfig.images}/flags/{$tsAutor.pais.icon}.png" style="padding:2px" title="{$tsAutor.pais.name}" />
                            {if $tsAutor.user_id != $tsUser->uid}<a href="{if !$tsUser->is_member}{$tsConfig.url}/registro/{else}javascript:mensaje.nuevo('{$tsAutor.user_name}','','','');{/if}"><img title="Enviar mensaje privado" src="{$tsConfig.images}/icon-mensajes-recibidos.gif"/></a>{/if}
                            {if !$tsUser->is_member}
                            <hr class="divider"/>
                            <a class="btn_g follow_user_post" href="{$tsConfig.url}/registro/"><span class="icons follow">Seguir Usuario</span></a>
                            {elseif $tsAutor.user_id != $tsUser->uid}
                            <hr class="divider"/>
                            <a class="btn_g unfollow_user_post" onclick="notifica.unfollow('user', {$tsAutor.user_id}, notifica.userInPostHandle, $(this).children('span'))" {if !$tsAutor.follow}style="display: none;"{/if}><span class="icons unfollow">Dejar de seguir</span></a>
                            <a class="btn_g follow_user_post" onclick="notifica.follow('user', {$tsAutor.user_id}, notifica.userInPostHandle, $(this).children('span'))" {if $tsAutor.follow > 0}style="display: none;"{/if}><span class="icons follow">Seguir Usuario</span></a>
                            {/if}
                            <hr class="divider"/>
                            <div class="metadata-usuario">
                            	<span class="nData user_follow_count">{$tsAutor.user_seguidores}</span>
                                <span class="txtData">Seguidores</span>
                                <span class="nData" style="color: #0196ff">{$tsAutor.user_puntos}</span>
                                <span class="txtData">Puntos</span>
                                <span class="nData">{$tsAutor.user_posts}</span>
                                <span class="txtData">Posts</span>
                                <span style="color: #456c00" class="nData">{$tsAutor.user_comentarios}</span>
                                <span class="txtData">Comentarios</span>
                            </div>
                            {if $tsUser->is_admod || $tsUser->permisos.modu || $tsUser->permisos.mosu}
                            <hr class="divider"/>
                            <div class="mod-actions">
                                <b>Herramientas</b>
                                <a href="{$tsConfig.url}/moderacion/buscador/1/1/{$tsPost.post_ip}" class="geoip" target="_blank">{$tsPost.post_ip}</a>
                                {if $tsUser->is_admod == 1}<a href="{$tsConfig.url}/admin/users?act=show&amp;uid={$tsAutor.user_id}" class="edituser">Editar Usuario</a>{/if}
                                {if $tsAutor.user_id != $tsUser->uid} <a href="#" onclick="mod.users.action({$tsAutor.user_id}, 'aviso', false); return false;" class="alert">Enviar Aviso</a>{/if}
                                {if $tsAutor.user_id != $tsUser->uid && $tsUser->is_admod || $tsUser->permisos.modu || $tsUser->permisos.mosu}
								{if $tsAutor.user_baneado}
                                {if $tsUser->is_admod || $tsUser->permisos.modu}<a href="#" onclick="mod.reboot({$tsAutor.user_id}, 'users', 'unban', false); $(this).remove(); return false;" class="unban">Desuspender Usuario</a>{/if}
                                {else}
                                {if $tsUser->is_admod || $tsUser->permisos.mosu}<a href="#" onclick="mod.users.action({$tsAutor.user_id}, 'ban', false); $(this).remove(); return false;" class="ban">Suspender Usuario</a>{/if}
                                {/if}
								{/if}
                            </div>
                            {/if}
                        </div>
						
						<br />
						<div class="categoriaList estadisticasList" {if $tsPost.m_total == 0} style="display:none;"{/if}>
                        <h6>Medallas</h6>
                         {if $tsPost.medallas}
						<ul style="margin-left:11px;">
							{foreach from=$tsPost.medallas item=m}
        			<img src="{$tsConfig.images}/icons/med/{$m.m_image}_16.png" style="margin-left:1px;margin-bottom:2px;" class="qtip" title="{$m.m_title} - {$m.m_description}"/>
                            {/foreach}
                        </ul>
						{else}
						 <div class="emptyData">No tiene medallas</div>
                          {/if}
                    </div>

						{if $tsPost.visitas}
						<br />
						<div class="categoriaList estadisticasList">
                        <h6>&Uacute;ltimos visitantes</h6> 
						<ul style="margin-left:11px;">
							{foreach from=$tsPost.visitas item=v}
        			         <a href="{$tsConfig.url}/perfil/{$v.user_name}" class="hovercard" uid="{$v.user_id}" style="display:inline-block;"><img src="{$tsConfig.url}/files/avatar/{$v.user_id}_50.jpg" class="vctip" title="{$v.date|hace:true}" width="32" height="32"/></a> 
                            {/foreach}
                        </ul>
						</div>
                          {/if}

                    </div>