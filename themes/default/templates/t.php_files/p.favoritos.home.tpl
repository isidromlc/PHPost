{include file='sections/main_header.tpl'}
				<script type="text/javascript" src="{$tsConfig.js}/favoritos.js"></script>
				<script type="text/javascript">
                var favoritos_data = [{$tsFavoritos}];
                </script>
                <div class="comunidades">
                    {if !$tsFavoritos}<div class="emptyData">No agregaste ning&uacute;n post a favoritos todav&iacute;a</div>{else}
                    <div id="izquierda" style="width:width: 170px;">
                    	<label style="color:#999999; float: right; position: absolute; z-index: 5; margin: 12px; display: block;" for="favoritos-search">Buscar</label>
                        <input type="text" autocomplete="off" onblur="favoritos.search_blur()" onfocus="favoritos.search_focus()" onkeyup="favoritos.search(this.value, event)" value="" style="width: 164px; margin-bottom: 10px; margin-top: 7px;" id="favoritos-search">
                        <div class="categoriaList">
                        	<ul>
	                            <li id="cat_-1" style="margin-bottom: 5px;background:#555555; -moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px"><a href="" onclick="favoritos.active(this); favoritos.categoria = 'todas'; favoritos.query(); return false;" style="color:#FFF"><strong>Categor&iacute;as</strong></a></li>

                            </ul>
                        </div>
                    </div>
                    <div id="centroDerecha">
                        <div id="resultados">
                            <table class="linksList">
                    
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="text-align:left;width:350px;overflow:hidden;"><a href="" onclick="favoritos.active2(this); favoritos.orden = 'titulo'; favoritos.query(); return false;">T&iacute;tulo</a></th>
                                        <th><a href="" onclick="favoritos.active2(this); favoritos.orden = 'fecha_creado'; favoritos.query(); return false;">Creado</a></th>
                                        <th><a href="" onclick="favoritos.active2(this); favoritos.orden = 'fecha_guardado'; favoritos.query(); return false;" class="here">Guardado</a></th>
                                        <th><a href="" onclick="favoritos.active2(this); favoritos.orden = 'puntos'; favoritos.query(); return false;">Puntos</a></th>
                    
                                        <th><a href="" onclick="favoritos.active2(this); favoritos.orden = 'comentarios'; favoritos.query(); return false;">Comentarios</a></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    {/if}
                </div>
                <div style="clear: both;"></div>
                
{include file='sections/main_footer.tpl'}