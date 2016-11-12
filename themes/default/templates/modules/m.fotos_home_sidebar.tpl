                <div style="width: 300px; float: right;" id="post-izquierda">
                    <div class="categoriaList">
                        <h6>&Uacute;ltimos comentarios</h6>
                        <ul>
                            {foreach from=$tsLastComments item=c}
                            <li><strong>{if $tsUser->is_admod && $tsConfig.c_see_mod == 1 && $tsFoto.f_status != 0 || $tsFoto.user_activo == 0}<span style="color: {if $c.user_activo == 0} brown {elseif $c.f_status == 1} purple {elseif $c.f_status == 2} red{/if};" class="qtip" title="{if $c.user_activo == 0}El autor del comentario tiene la cuenta desactivada {elseif $c.f_status == 1} La foto se encuentra oculta {elseif $c.f_status == 2} La foto se encuentra eliminada{/if}">{/if}{$tsUser->getUsername($c.c_user)}{if $c.user_activo == 0 || $c.f_status != 0 && $tsUser->is_admod}</span>{/if}</strong> &raquo; <a href="{$tsConfig.url}/fotos/{$c.user_name}/{$c.foto_id}/{$c.f_title|seo}.html#div_cmnt_{$c.cid}">{$c.f_title}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                    <center>{$tsConfig.ads_300}</center>
                    <br />
                    <div class="categoriaList estadisticasList">
                        <h6>Estad&iacute;sticas</h6>
                        <ul>
                            <li class="clearfix"><a href="#"><span class="floatL">Miembros</span><span class="floatR number">{$tsStats.stats_miembros}</span></a></li>
                            <li class="clearfix"><a href="#"><span class="floatL">Fotos</span><span class="floatR number">{$tsStats.stats_fotos}</span></a></li>
                            <li class="clearfix"><a href="#"><span class="floatL">Comentarios</span><span class="floatR number">{$tsStats.stats_foto_comments}</span></a></li>
                        </ul>
                    </div>
                </div>