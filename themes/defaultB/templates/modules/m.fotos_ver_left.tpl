                <div style="width: 160px; float: left;">
                    <div class="categoriaList">
                        <h6>Fotos de {$tsFoto.user_name}</h6>
                        <ul id="v_album">
                            {foreach from=$tsUFotos item=f}
                            <li><a href="{$tsConfig.url}/fotos/{$f.user_name}/{$f.foto_id}/{$f.f_title|seo}.html"><img src="{$f.f_url}" title="{$f.f_title}" width="120" height="90" /><span class="time">{$f.f_date|date_format:"%d/%m/%Y"}</span></a></li>
                            {/foreach}
                        </ul>
                        <a href="{$tsConfig.url}/fotos/{$tsFoto.user_name}" class="fb_foot">Ver todas</a>
                    </div>
                    <center>{$tsConfig.ads_160}</center>
                </div>