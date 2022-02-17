						<div class="widget w-stats clearfix">
                        	<div class="title-w clearfix">
                              <h3>Estad&iacute;sticas del usuario</h3>
                              <span>
                              {if $tsInfo.user_online}
                              <span title="Online" style="float: left; width: 16px; height: 16px; background: url({$tsConfig.images}/big2v1.png); background-position: 0 -792px" class="dot-online-offline"></span>
                              {else}
                              <span title="Offline" style="float: left; width: 16px; height: 16px; background: url({$tsConfig.images}/big2v1.png); background-position: 0 -814px" class="dot-online-offline"></span>
                              </span>
                              {/if}
                            </div>
                            <ul style="color:#{$tsGeneral.stats.rango.0.rColor}">
                            	<li style="width:150px;padding-left: 5px">{$tsGeneral.stats.rango.0.rName}<span>Rango</span></li>
                                <li>{$tsGeneral.stats.user_puntos}<span>Puntos</span></li>
                                <li>{$tsGeneral.stats.user_posts}<span>Posts</span></li>
                                <li>{$tsGeneral.stats.user_comentarios}<span>Comentarios</span></li>
                                <li>{$tsGeneral.stats.user_seguidores}<span>Seguidores</span></li>
                            </ul>
    		            </div>
                        <div class="widget w-posts clearfix">
                        	<div class="title-w clearfix">
                                <h3>&Uacute;ltimos Posts creados</h3>
                                <span><a title="Últimos Posts de LaCamiiViiera => wft! JNeutron... Isidro vio esto (? okno" href="/rss/posts-usuario/{$tsIUser.id}" class="systemicons sRss"></a></span>
	                        </div>
                            {if $tsGeneral.posts}
                            <ul class="ultimos">
                                {foreach from=$tsGeneral.posts item=p}
                            	<li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})">
                                    <a title="{$p.post_title}" target="_self" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos} Puntos</span>
                                </li>
                                {/foreach}
                            </ul>
                            {else}
                            <div class="emptyData">No hay posts</div>
                            {/if}
                        </div>
                        <div class="widget w-temas clearfix">
                        	<div class="title-w clearfix">
                                <h3>&Uacute;ltimos Temas creados</h3>
                                <span><a title="Últimos Posts de LaCamiiViiera" href="/rss/posts-usuario/{$tsIUser.id}" class="systemicons sRss"></a></span>
	                        </div>
                            {if $tsGeneral.temas}
                            <ul class="ultimos">
                                {foreach from=$tsGeneral.posts item=p}
                            	<li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.s_img})">
                                    <a title="{$p.post_title}" target="_self" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.s_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos} Puntos</span>
                                </li>
                                {/foreach}
                            </ul>
                            {else}
                            <div class="emptyData">No hay temas</div>
                            {/if}
                        </div>