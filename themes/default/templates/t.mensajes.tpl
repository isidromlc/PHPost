{include file='sections/main_header.tpl'}
                {include file='modules/m.mensajes_menu.tpl'}
                <div style="float:right;width:730px">
                	<div style="display: none;" id="m-mensaje"></div>
                    <div class="boxy">
                        <div class="boxy-title">
                            <h3>Mensajes</h3>
                            <form method="get" action="{$tsConfig.url}/mensajes/search/">
                                <input type="text" name="qm" placeholder="Buscar en Mensajes" title="Buscar en Mensajes" value="{$tsMensajes.texto}" class="search_mp onblur_effect"/>
                            </form>
                        </div>
                        <div class="boxy-content" style="padding:0" id="mensajes">
                            {if $tsAction == '' || $tsAction == 'enviados' || $tsAction == 'respondidos' || $tsAction == 'search'}
                            {include file='modules/m.mensajes_list.tpl'}
                            {elseif $tsAction == 'leer'}
                            {include file='modules/m.mensajes_leer.tpl'}
                            {elseif $tsAction == 'avisos'}
                            {include file='modules/m.mensajes_avisos.tpl'}
                            
                            {/if}
						</div>
                    </div>
                </div>
                <div style="clear: both;"></div>
                
{include file='sections/main_footer.tpl'}