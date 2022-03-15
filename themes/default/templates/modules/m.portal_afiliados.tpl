					<div class="module">
                        <div class="box_title">
                            <div class="box_txt afs">Afiliados</div>
                            <div class="box_rss"><a onclick="afiliado.nuevo(); return false" title="Afiliate a {$tsConfig.titulo}" class="qtip"><img src="{$tsConfig.images}/icons/plus.png" /></a></div>
                        </div>
                        <div class="box_cuerpo">
                            <ul class="afiliados">
                            {foreach from=$tsAfiliados item=af}
                            <li><a href="#" onclick="afiliado.detalles({$af.aid}); return false;" title="{$af.a_titulo}">
                                <img src="{$af.a_banner}" width="190" height="40"/>
                            </a></li>
                            {/foreach}
                            </ul>
                         </div>
                    </div>