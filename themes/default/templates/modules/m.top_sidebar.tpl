				<div style="float: left; width: 150px;" class="left">
                	<div class="boxy">
                    	<div class="boxy-title">
                        	<h3>Filtrar</h3>
                            <span class="icon-noti"></span>
                        </div>
                        <div class="boxy-content">
                        	<h4>Categor&iacute;a</h4>
                            <select onchange="location.href='{$tsConfig.url}/top/{$tsAction}/?fecha={$tsFecha}&cat='+$(this).val()">
                            <option value="0">Todas</option>
                            {foreach from=$tsConfig.categorias item=c}
                                <option value="&cat={$c.cid}" {if $tsCat == $c.cid}selected="selected"{/if}>{$c.c_nombre}</option>
                            {/foreach}
                            </select>
                            <hr/>
                            <h4>Per&iacute;odo</h4>
                            <ul>
                                <li><a href="{$tsConfig.url}/top/{$tsAction}/?fecha=2&cat={$tsCat}&sub={$tsSub}" {if $tsFecha == 2}class="selected"{/if}>Ayer</a></li>
                                <li><a href="{$tsConfig.url}/top/{$tsAction}/?fecha=1&cat={$tsCat}&sub={$tsSub}" {if $tsFecha == 1}class="selected"{/if}>Hoy</a></li>
                                <li><a href="{$tsConfig.url}/top/{$tsAction}/?fecha=3&cat={$tsCat}&sub={$tsSub}" {if $tsFecha == 3}class="selected"{/if}>&Uacute;ltimos 7 d&iacute;as</a></li>
                                <li><a href="{$tsConfig.url}/top/{$tsAction}/?fecha=4&cat={$tsCat}&sub={$tsSub}" {if $tsFecha == 4}class="selected"{/if}>Del mes</a></li>
                                <li><a href="{$tsConfig.url}/top/{$tsAction}/?fecha=5&cat={$tsCat}&sub={$tsSub}" {if $tsFecha == 5}class="selected"{/if}>Todos los tiempos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>