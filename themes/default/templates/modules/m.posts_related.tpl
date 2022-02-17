                		<div class="post-relacionados">
    	                	<h4>Otros posts que te van a interesar:</h4>
                            <ul>
                            	{if $tsRelated}
                                {foreach from=$tsRelated item=p}
                            	<li class="categoriaPost" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})">
									<a class="{if $p.post_private}categoria privado{/if}"title="{$p.post_title}" href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html" rel="dc:relation">{$p.post_title}</a>
								</li>
                                {/foreach}
                                {else}
                                <li>No se encontraron posts relacionados.</li>
                                {/if}
                            </ul>
	                    </div>