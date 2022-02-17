{include file='sections/main_header.tpl'}

				<script type="text/javascript" src="{$tsConfig.js}/borradores.js"></script>
                <div id="borradores">
                	<script type="text/javascript">
					var borradores_data = [{$tsDrafts}];
					</script>
					<div class="clearfix">
                    	<div class="left" style="float:left;width:200px">
                   			<div class="boxy">
                                <div class="boxy-title">
                                    <h3>Filtrar</h3>
                                    <span></span>
                                </div><!-- boxy-title -->
                                <div class="boxy-content">
                                    <h4>Mostrar</h4>
                    
                                    <ul class="cat-list" id="borradores-filtros">
                                        <li id="todos" class="active"><span class="cat-title"><a href="" onclick="borradores.active(this); borradores.filtro = 'todos'; borradores.query(); return false;">Todos</a></span> <span class="count"></span></li>
                                        <li id="borradores"><span class="cat-title"><a href="" onclick="borradores.active(this); borradores.filtro = 'borradores'; borradores.query(); return false;">Borradores</a></span> <span class="count"></span></li>
                                        <li id="eliminados"><span class="cat-title"><a href="" onclick="borradores.active(this); borradores.filtro = 'eliminados'; borradores.query(); return false;">Eliminados</a></span> <span class="count"></span></li>
                                    </ul>
                                    <h4>Ordenar por</h4>
                    
                                    <ul id="borradores-orden" class="cat-list">
                                        <li class="active"><span><a href="" onclick="borradores.active(this); borradores.orden = 'fecha_guardado'; borradores.query(); return false;">Fecha guardado</a></span></li>
                                        <li><span><a href="" onclick="borradores.active(this); borradores.orden = 'titulo'; borradores.query(); return false;">T&iacute;tulo</a></span></li>
                                        <li><span><a href="" onclick="borradores.active(this); borradores.orden = 'categoria'; borradores.query(); return false;">Categor&iacute;a</a></span></li>
                                    </ul>
                                    <h4>Categorias</h4>
                    
                                    <ul class="cat-list" id="borradores-categorias">
                                        <li id="todas" class="active"><span class="cat-title active"><a href="" onclick="borradores.active(this); borradores.categoria = 'todas'; borradores.query(); return false;">Ver todas</a></span> <span class="count"></span></li>
                                    </ul>
                                </div><!-- boxy-content -->
                            </div>
                        </div>
                        <div class="right" style="float:left;margin-left:10px;width:730px">
                            <div class="boxy">
                                <div class="boxy-title">
                                    <h3>Posts</h3>
                                    <label for="borradores-search" style="color:#999999;float:right;position:absolute;right:135px;top:11px;z-index:5;">Buscar</label><input type="text" id="borradores-search" value="" onKeyUp="borradores.search(this.value, event)" onFocus="borradores.search_focus()" onBlur="borradores.search_blur()" autocomplete="off" />
                                </div>
                                <div id="res" class="boxy-content">
                                 	{if $tsDrafts}<ul id="resultados-borradores"></ul>{else}
                                    <div class="emptyData">No tienes ning&uacute;n borrador ni post eliminado.</div>{/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="template-result-borrador" style="display:none">
                        <li id="borrador_id___id__">
                            <a title="__categoria_name__" class="categoriaPost __categoria__ __tipo__" href="__url__" onclick="__onclick__" style="background-image:url({$tsConfig.images}/icons/cat/__imagen__)">__titulo__</a>
                            <span class="causa">Causa: __causa__</span>
                            <span class="gray">&Uacute;ltima vez guardado el __fecha_guardado__</span> <a style="float:right" href="" onclick="borradores.eliminar(__borrador_id__, true); return false;"><img src="http://o2.t26.net/images/borrar.png" alt="eliminar" title="Eliminar Borrador" /></a>
                    
                        </li>
                    </div>
                </div>
                <div style="clear:both"></div>
            
{include file='sections/main_footer.tpl'}