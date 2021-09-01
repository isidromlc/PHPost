                                <div class="before floatL">
                                    <a href="#ver-comentarios" {if $tsPages.prev > 0}onclick="comentario.cargar({$tsPages.post_id}, {$tsPages.prev}, {$tsPages.autor});"{else}class="desactivado"{/if}><b>&laquo; Anterior</b></a>
                                </div>
                                <div style="float:left;width: 530px">
                                    <ul>
						                {section name=page start=1 loop=$tsPages.section}
                                        <li class="numbers"><a href="#ver-comentarios" {if $tsPages.current == $smarty.section.page.index}class="here"{else}onclick="comentario.cargar({$tsPages.post_id}, {$smarty.section.page.index}, {$tsPages.autor});"{/if}>{$smarty.section.page.index}</a></li>
                                        {/section}
                                    </ul>
                                  </div>
                                <div class="floatR next">
                                    <a href="#ver-comentarios" {if $tsPages.next <= $tsPages.pages}onclick="comentario.cargar({$tsPages.post_id}, {$tsPages.next}, {$tsPages.autor});"{else}class="desactivado"{/if}><b>Siguiente &raquo;</b></a>
                                </div>
                                <div class="clearBoth"></div>
