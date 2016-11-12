					<div id="topsPostBox">
                        <div class="box_title">
                            <div class="box_txt estadisticas">TOPs posts <a class="size9" href="{$tsConfig.url}/top/">(Ver m&aacute;s)</a></div>
                            <div class="box_rss">
                            	<a href="/rss/top-post-semana"><span class="systemicons sRss"></span></a>
                            </div>
                        </div>
                        <div class="box_cuerpo" style="padding: 0pt; height: 330px;">
                        	<div class="filterBy">
                            	<a href="javascript:TopsTabs('topsPostBox','Ayer')" id="Ayer">Ayer</a> -
                            	<a href="javascript:TopsTabs('topsPostBox','Semana')" id="Semana"{if $tsTopPosts.semana} class="here"{/if}>Semana</a> -
                                <a href="javascript:TopsTabs('topsPostBox','Mes')" id="Mes">Mes</a> -
                                <a href="javascript:TopsTabs('topsPostBox','Historico')" id="Historico"{if !$tsTopPosts.semana} class="here"{/if}>Hist&oacute;rico</a>
                            </div>
                            <ol id="filterByAyer" class="filterBy cleanlist" style="display:none;">
                            {foreach from=$tsTopPosts.ayer key=i item=p}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterBySemana" class="filterBy cleanlist" style="display:{if $tsTopPosts.semana}block{else}none{/if};">
                            {foreach from=$tsTopPosts.semana key=i item=p}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterByMes" class="filterBy cleanlist" style="display:none;">
                            {foreach from=$tsTopPosts.mes key=i item=p}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterByHistorico" class="filterBy cleanlist" style="display:{if !$tsTopPosts.semana}block{else}none{/if};">
                            {foreach from=$tsTopPosts.historico key=i item=p}
								<li>
	                                {if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">{$p.post_title|truncate:45}</a>
                                    <span>{$p.post_puntos}</span>
                                </li>
                            {/foreach}
                            </ol>
                        </div>
                        <br class="space"/>
                    </div>