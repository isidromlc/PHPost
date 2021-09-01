{include file='sections/main_header.tpl'}
                <div id="resultados" class="resultadosFull"> 
                    <div class="filterBy filterFull" style="width:925px">
                        <div class="block floatL" style="line-height:25px">
                            <form action="" method="get" class="clear">
                            <span class="xResults">Filtrar:</span>
                            <ul> 
                                <li{if $tsFiltro.online == 'true'} class="here"{/if}><label><input type="checkbox" name="online" value="true" {if $tsFiltro.online == 'true'}checked="true"{/if}/>En linea</label></li> 
                                <li{if $tsFiltro.avatar == 'true'} class="here"{/if}><label><input type="checkbox" value="true" name="avatar" {if $tsFiltro.avatar == 'true'}checked="true"{/if}/>Con foto</label></li> 
                                <li{if $tsFiltro.sex == 'm'} class="here"{/if}><label><input type="radio" name="sexo" value="m" {if $tsFiltro.sex == 'm'}checked="true"{/if}/>Hombre</label></li> 
                                <li{if $tsFiltro.sex == 'f'} class="here"{/if}><label><input type="radio" name="sexo" value="f" {if $tsFiltro.sex == 'f'}checked="true"{/if}/> Mujer</label></li> 
                                <li{if $tsFiltro.sex == ''} class="here"{/if}><label><input type="radio" name="sexo" value="" {if $tsFiltro.sex == ''}checked="true"{/if}/>Ambos</label></li>
                                <li{if $tsFiltro.pais} class="here"{/if}><label class="select"><select name="pais" id="pais"><option value="">Todos los Pa&iacute;ses...</option>{foreach from=$tsPaises key=code item=pais}<option value="{$code}" {if $tsFiltro.pais == $code}selected="true"{/if}>{$pais}</option>{/foreach}</select></label></li>
                                <li{if $tsFiltro.rango} class="here"{/if}><label class="select"><select name="rango" id="rango"><option value="">Todos los Rangos...</option>{foreach from=$tsRangos item=r}<option value="{$r.rango_id}" {if $tsFiltro.rango == $r.rango_id}selected="true"{/if}>{$r.r_name}</option>{/foreach}</select></label></li>
                                <li><input type="submit" style="float:right;padding:3px 10px" class="mBtn btnOk" value="Filtrar" /></li>
                            </ul>
                            </form>
                        </div>
                    	<div class="floatL xResults">
                    		Mostrando <strong>{$tsTotal}</strong> resultados de <strong>{$tsPages.total}</strong>
                    	</div>
                        <div class="clearBoth"></div>
                    </div>
                    <div id="showResult" class="resultFull" style="float:left; width:755px">
                            <ul class="clearfix">
                            {if $tsUsers}
                                {foreach from=$tsUsers item=u}
                                <li class="resultBox clearfix">
                        			<h4 style="padding:0"><span class="rango qtip" style="background-image:url({$tsConfig.default}/images/icons/ran/{$u.rango.image});" title="{$u.rango.title}">&nbsp;</span> <a href="{$tsConfig.url}/perfil/{$u.user_name}" style="color:#{$u.rango.color}" >{$u.user_name}</a></h4>
                        			<div class="floatL avatarBox" style="padding:0">
                        				<a href="{$tsConfig.url}/perfil/{$u.user_name}"><img width="75" height="75" src="{$tsConfig.url}/files/avatar/{$u.user_id}_120.jpg" class="av"/></a>
                        			</div>
                        			<div class="floatL infoBox">
                        				<ul>
                                            {if $u.p_mensaje}<li>{$u.p_mensaje}</li>{/if}
                                            <li>Sexo: <strong>{if $u.user_sexo == 0}Mujer{else}Hombre{/if}</strong> - Pa&iacute;s: <strong>{$tsPaises[$u.user_pais]}</strong></li>
                        					<li>Posts: <strong>{$u.user_posts}</strong> - Puntos: <strong>{$u.user_puntos}</strong> - Comentarios: <strong>{$u.user_comentarios}</strong></li>
                                            {if $u.user_id != $tsUser->uid}<li><a href="#" onclick="{if !$tsUser->is_member}registro_load_form();{else}mensaje.nuevo('{$u.user_name}','','','');{/if}return false">Enviar Mensaje</a></li>{/if}
                                            <li>Estado: {$u.status.t} <strong class="status {$u.status.css}" style="display:inline-block">&nbsp;</strong></li>                                            
                        				</ul>
                        			</div>
                        		</li>
                                {/foreach}
                            {else}
                                <div class="emptyData" style="margin:0 10px">No se encontraro usuarios con los filtros seleccionados.</div>
                            {/if}
                            </ul>
                            <div class="paginador">
                        		{if $tsPages.prev != 0}<div style="text-align:left" class="floatL"><a href="{$tsConfig.url}/usuarios/?page={$tsPages.prev}{if $tsFiltro.online == 'true'}&online=true{/if}{if $tsFiltro.avatar == 'true'}&avatar=true{/if}{if $tsFiltro.sex}&sex={$tsFiltro.sex }{/if}{if $tsFiltro.pais}&pais={$tsFiltro.pais}{/if}{if $tsFiltro.rango}&rango={$tsFiltro.rango}{/if}">&laquo; Anterior</a></div>{/if}
                        		{if $tsPages.next != 0}<div style="text-align:right" class="floatR"><a href="{$tsConfig.url}/usuarios/?page={$tsPages.next}{if $tsFiltro.online == 'true'}&online=true{/if}{if $tsFiltro.avatar == 'true'}&avatar=true{/if}{if $tsFiltro.sex}&sex={$tsFiltro.sex }{/if}{if $tsFiltro.pais}&pais={$tsFiltro.pais}{/if}{if $tsFiltro.rango}&rango={$tsFiltro.rango}{/if}">Siguiente &raquo;</a></div>{/if}
                                <div style="clear:both"></div>
                            </div>
                    </div>
                    <div class="floatL" style="margin-left: 5px; width: 180px; margin-top: 25px;">
                        <center>{$tsConfig.ads_160}</center>
                    </div>
                </div>
                <div style="clear:both"></div>
{include file='sections/main_footer.tpl'}