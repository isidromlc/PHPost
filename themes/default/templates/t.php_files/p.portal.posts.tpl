                    <div class="body">
                    	<ul>
                            {if $tsPosts}
                            {foreach from=$tsPosts item=p}
                            <li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})">
                                <a class="title {if $p.post_private}categoria privado{/if}" title="{$p.post_title}" target="_self" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:55}</a>
                                <span>{$p.post_date|hace} &raquo; <a href="{$tsConfig.url}/perfil/{$p.user_name}"><strong>{$p.user_name}</strong></a> &middot; Puntos <strong>{$p.post_puntos}</strong> &middot; Comentarios <strong>{$p.post_comments}</strong></span>
                                <span class="floatR"><a href="{$tsConfig.url}/posts/{$p.c_seo}/">{$p.c_nombre}</a></span>
                            </li>
                            {/foreach}
                            {else}
                            <li class="emptyData">
                                No hay posts aqu&iacute;,
                                {if $tsType == 'posts'} <a onclick="$('#config_posts').slideDown();">configura</a> tus categor&iacute;as preferidas.
                                {elseif $tsType == 'favs'} puedes agregar un post a tus favoritos para visitarlo m&aacute;s tarde.
                                {elseif $tsType == 'shared'} los usuarios que sigues podr&aacute;n recomentarte posts.
                                {/if}
                            </li>
                            {/if}
                        </ul>
                        <br clear="left"/>
                    </div>
                    <div class="footer size13">
                		{if $tsPages.prev != 0}<div style="text-align:left" class="floatL"><a onclick="portal.posts_page('{$tsType}', {$tsPages.prev}, true); return false">&laquo; Anterior</a></div>{/if}
                		{if $tsPages.next != 0}<div style="text-align:right" class="floatR"><a onclick="portal.posts_page('{$tsType}', {$tsPages.next}, true); return false">Siguiente &raquo;</a></div>{/if}
                    </div>
                    <div class="clearBoth"></div>