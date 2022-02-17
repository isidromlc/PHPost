				<div style="float: left; margin-left: 10px; width: 775px;" class="right">
                	<!--PUNTOS-->
                	<div class="boxy xtralarge">
                    	<div class="boxy-title">
                            <h3>Top post con m&aacute;s puntos</h3>
                            <span class="icon-noti puntos-n"></span>
                        </div>
                        <div class="boxy-content">
                        	{if !$tsTops.puntos}<div class="emptyData">Nada por aqui</div>
                            {else}
                        	<ol>
                            	{foreach from=$tsTops.puntos item=p}
                            	<li class="categoriaPost clearfix" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})"><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a> <span>{$p.post_puntos}</span></li>
                                {/foreach}
                            </ol>
                            {/if}
                        </div>
                    </div>
                    <!--SEGUIDORES-->
                	<div class="boxy xtralarge">
                    	<div class="boxy-title">
                            <h3>Top post m&aacute;s favoritos</h3>
                            <span class="icon-noti favoritos-n"></span>
                        </div>
                        <div class="boxy-content">
                        	{if !$tsTops.favoritos}<div class="emptyData">Nada por aqui</div>
                            {else}
                        	<ol>
                            	{foreach from=$tsTops.favoritos item=p}
                            	<li class="categoriaPost clearfix" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})"><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a> <span>{$p.post_favoritos}</span></li>
                                {/foreach}
                            </ol>
                            {/if}
                        </div>
                    </div>
                    <!--COMENTARIOS-->
                	<div class="boxy xtralarge">
                    	<div class="boxy-title">
                            <h3>Top post m&aacute;s comentado</h3>
                            <span class="icon-noti comentarios-n"></span>
                        </div>
                        <div class="boxy-content">
                        	{if !$tsTops.comments}<div class="emptyData">Nada por aqui</div>
                            {else}
                        	<ol>
                            	{foreach from=$tsTops.comments item=p}
                            	<li class="categoriaPost clearfix" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})"><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a> <span>{$p.post_comments}</span></li>
                                {/foreach}
                            </ol>
                            {/if}
                        </div>
                    </div>
                    
                    <!--SEGUIDORES-->
                	<div class="boxy xtralarge">
                    	<div class="boxy-title">
                            <h3>Top post con m&aacute;s seguidores</h3>
                            <span class="icon-noti follow-n"></span>
                        </div>
                        <div class="boxy-content">
                        	{if !$tsTops.seguidores}<div class="emptyData">Nada por aqui</div>
                            {else}
                        	<ol>
                            	{foreach from=$tsTops.seguidores item=p}
                            	<li class="categoriaPost clearfix" style="background-image:url({$tsConfig.images}/icons/cat/{$p.c_img})"><a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a> <span>{$p.post_seguidores}</span></li>
                                {/foreach}
                            </ol>
                            {/if}
                        </div>
                    </div>
                </div>