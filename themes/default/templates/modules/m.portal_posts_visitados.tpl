                <div class="module">
                	<div class="box_title">
                    	<div class="box_txt visited">&Uacute;ltimos posts visitados</div>
                    </div>
                    <div class="box_cuerpo">
                    	<ul>
                            {if $tsLastPostsVisited}
                            {foreach from=$tsLastPostsVisited item=p}
                            {if $p.post_title}<li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})">
                                <a class="title {if $p.post_private}categoria privado{/if}" alt="{$p.post_title}" title="{$p.post_title}" target="_self" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:40}</a>
                            </li>{/if}
                            {/foreach}
                            {else}
                            <li class="emptyData">No has visitado posts recientemente.</li>
                            {/if}
                        </ul>
                    </div>
                 </div>