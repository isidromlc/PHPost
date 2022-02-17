                <div style="width: 160px; float: left;">
                    <div class="categoriaList">
                        <h6 style="text-align:center;">Seguidores</h6>
                        <ul id="v_album">
                            {if $tsFFotos}
                            {foreach from=$tsFFotos item=f}
                            <li><a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title|seo}.html"><img src="{$f.f_url}" title="{$f.f_title}" width="120" height="90" /></a><br /><a href="{$tsConfig.url}/perfil/{$f.user_name}" style="text-decoration:underline;"><strong>{$f.user_name}</strong></a></li>
                            {/foreach}
                            {else}
                            <li class="emptyData"><u>{$tsFoto.user_name}</u> no sigue usuarios o no han subido fotos.</li>
                            {/if}
                        </ul>
                        {if $tsFFotos}<a href="{$tsConfig.url}/fotos/{$tsFoto.user_name}" class="fb_foot">Ver todas</a>{/if}
                    </div>
                    <div class="categoriaList estadisticasList">
                        <h6>Estad&iacute;sticas</h6>
                        <ul>
                            <li class="clearfix"><a href="{$tsConfig.url}/fotos/{$tsFoto.user_name}"><span class="floatL">Fotos subidas</span><span class="floatR number">{$tsFoto.user_fotos}</span></a></li>
                            <li class="clearfix"><a href="#"><span class="floatL">Comentarios</span><span class="floatR number">{$tsFoto.user_foto_comments}</span></a></li>
                        </ul>
                    </div>
					{if $tsFVisitas}
					<div class="categoriaList">
                        <h6 style="text-align:center;">Visitas recientes</h6>
                        <ul id="v_album" style="margin-left:11px;">
                            {foreach from=$tsFVisitas item=v}
        			          <a href="{$tsConfig.url}/perfil/{$v.user_name}" class="hovercard" uid="{$v.user_id}" style="display:inline-block;"><img src="{$tsConfig.url}/files/avatar/{$v.user_id}_50.jpg" class="vctip" title="{$v.date|hace:true}" width="32" height="32"/></a>
                            {/foreach}
                        </ul>
                    </div>
					{/if}
					<div class="categoriaList">
                        <h6 style="text-align:center;">Medallas</h6>
                        <ul id="v_album" style="margin-left:11px;"> 
                            {if $tsFMedallas}
                            {foreach from=$tsFMedallas item=m}
                            <img src="{$tsConfig.images}/icons/med/{$m.m_image}_16.png"  style="margin-left:1px;margin-bottom:2px;" class="qtip" title="{$m.m_title} - {$m.m_description}"/>
                            {/foreach}
                            {else}
                            <li class="emptyData">Esta foto no tiene medallas</li>
                            {/if}
                        </ul>
                    </div>
					
                </div>