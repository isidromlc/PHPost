                <div class="clearbeta" id="lastPosts">
                	<div class="header">
                    	<div class="box_txt ultimos_posts">Tus &uacute;ltimos posts creados</div>
                        <div class="clearBoth"></div>
                    </div>
                    <div class="body">
                    	<ul>
                            {if $tsLastPostsVisited}
                            {foreach from=$tsLastPostsVisited item=p}
                            <li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})">
                                <a class="title {if $p.post_private}categoria privado{/if}" alt="{$p.post_title}" title="{$p.post_title}" target="_self" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:55}</a>
                                <span>Hace {$p.post_date|hace} &raquo; <a href="{$tsConfig.url}/perfil/{$p.user_name}"><strong>{$p.user_name}</strong></a> &middot; Puntos <strong>{$p.post_puntos}</strong> &middot; Comentarios <strong>{$p.post_comments}</strong></span>
                                <span class="floatR"><a href="{$tsConfig.url}/posts/{$p.c_seo}/">{$p.c_nombre}</a></span>
                            </li>
                            {/foreach}
                            {else}
                            <li class="emptyData">No has visitado posts recientemente.</li>
                            {/if}
                        </ul>
                        <br clear="left"/>
                    </div>
                 </div>