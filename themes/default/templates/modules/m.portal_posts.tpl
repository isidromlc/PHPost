                <div id="portal_posts" class="showHide lastPosts" status="" style="display:none">
                	<div class="header">
                    	<div class="box_txt ultimos_posts">&Uacute;ltimos posts de tu inter&eacute;s</div>
                        <div class="box_rss">
                            <a onclick="$('#config_posts').slideDown();" title="Configurar" class="qtip"><img src="{$tsConfig.images}/icons/gear.png" /></a>
                        </div>
                        <div class="clearBoth"></div>
                    </div>
                    <div id="config_posts" style="display:none">
                        <div class="emptyData">Elige las categor&iacute;as que quieras filtrar en los &uacute;ltimos posts.</div>
                        <ul class="clearbeta" id="config_inputs">
                        {foreach from=$tsCategories item=c}
                            <li><label><input type="checkbox" value="{$c.cid}" {if $c.check == 1}checked="true"{/if} /><span style="background-image:url({$tsConfig.images}/icons/cat/{$c.c_img})">{$c.c_nombre}</span></label></li>
                        {/foreach}
                        </ul>
                        <a onclick="portal.save_configs();" class="next">Guardar cambios &raquo;</a>
                        <div class="clearBoth"></div>
                    </div>
                    <div id="portal_posts_content"></div>
                </div>