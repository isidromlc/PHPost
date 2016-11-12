								<script type="text/javascript" src="{$tsConfig.js}/jquery.tablednd.js"></script>
                                <script type="text/javascript">
									// {literal}
									$(function(){
										// {/literal} {if $tsAct == ''} {literal}
										$('#cats_orden').tableDnD({
											onDrop: function(table, row) {
												$.ajax({
													   type: 'post', 
													   url: global_data.url + '/admin/cats?ajax=true&ordenar=true', 
													   cache: false, 
													   data: $.tableDnD.serialize()
												});
											}
										});
										// {/literal} {/if} {literal}
										$('#cats_orden').tableDnD({
											onDrop: function(table, row) {
												$.ajax({
													   type: 'post', 
													   url: global_data.url + '/admin/cats?ajax=true&ordenar=true&t=cat', 
													   cache: false, 
													   data: $.tableDnD.serialize()
												});
											}
										});
										//
										$('#cat_img').change(function(){
											var cssi = $("#cat_img option:selected").css('background');
											$('#c_icon').css({"background" : cssi});
										});
										//
									});
									//{/literal}
                                </script>
                                <div class="boxy-title">
                                    <h3>Administrar Categor&iacute;as</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                {if $tsSave}<div class="mensajes ok">Tus cambios han sido guardados.</div>{/if}
                                {if $tsAct == ''}
                                {if !$tsSave}<div class="mensajes error">Puedes cambiar el orden de las categor&iacute;as tan s&oacute;lo con arrastrarlas con el puntero.</div>{/if}
                                	<table cellpadding="0" cellspacing="0" border="0" width="500" align="center" class="admin_table" id="cats_orden">
                                    	<thead>
                                        	<th colspan="3" style="text-align:left; padding-left:7px;">Categor&iacute;as</th>
                                        </thead>
                                        <tbody>{foreach from=$tsConfig.categorias item=c}
                                        	<tr id="{$c.cid}">
                                            	<td width="30">{$c.c_orden}</td>
                                                <td style="text-align:left; padding-left:20px; background:url({$tsConfig.url}/themes/default/images/icons/cat/{$c.c_img}) no-repeat 2px center;"><b><u>{$c.c_nombre}</u></b></td>
                                                <td class="admin_actions" width="100">
                                                	<a href="?act=editar&cid={$c.cid}&t=cat"><img src="{$tsConfig.url}/themes/default/images/icons/editar.png" title="Editar Categor&iacute;a"/></a>
                                                    <a href="?act=borrar&cid={$c.cid}&t=cat"><img src="{$tsConfig.url}/themes/default/images/icons/close.png" title="Borrar Categor&iacute;a"/></a>
                                                </td>
                                            </tr>{/foreach}
                                        </tbody>
                                        <tfoot>	
                                        	<td colspan="3">&nbsp;</td>
                                        </tfoot>
                                    </table><hr />
                                    <input type="button"  onclick="location.href = '{$tsConfig.url}/admin/cats?act=nueva&t=cat'" value="Agregar Nueva Categor&iacute;a" class="mBtn btnOk" style="margin-left:280px;"/>
                                    <input type="button" style="cursor:pointer;" onclick="location.href = '/admin/cats?act=change'" value="Mover Posts" class="btn_g">									
									{elseif $tsAct == 'editar'}
                                        <form action="" method="post" autocomplete="off">
                                        <fieldset>
                                            <legend>Editar</legend>
                                            <dl>
                                                <dt><label for="cat_name">Nombre de la categor&iacute;a:</label></dt>
                                                <dd><input type="text" id="cat_name"name="c_nombre" value="{$tsCat.c_nombre}" /></dd>
                                            </dl>
                                            <dl>
                                                <dt><label for="cat_img">Icono de la categor&iacute;a:</label></dt>
                                                <dd>
                                                    <img src="{$tsConfig.images}/space.gif" style="background:url({$tsConfig.url}/themes/default/images/icons/cat/{$tsCat.c_img}) no-repeat left center;" width="16" height="16" id="c_icon"/>
                                                    <select name="c_img" id="cat_img" style="width:164px">
                                                    {foreach from=$tsIcons key=i item=img}
                                                    	<option value="{$img}" style="padding:2px 20px 0; background:#FFF url({$tsConfig.url}/themes/default/images/icons/cat/{$img}) no-repeat left center;" {if $tsCat.c_img == $img}selected="selected"{/if}>{$img}</option>
                                                    {/foreach}
                                                    </select>
                                                </dd>
                                            </dl>
                                            <p><input type="submit" name="save" value="Guardar cambios" class="btn_g"/  ></p>
                                        </fieldset>
                                        </form>
                                    {elseif $tsAct == 'nueva'}
                                        <div class="mensajes error">Si deseas m&aacute;s iconos para las categor&iacute;as debes subirlos al directorio: /themes/default/images/icons/cat/</div>
                                        <form action="" method="post" autocomplete="off">
                                        <fieldset>
                                            <legend>Nueva</legend>
                                            <dl>
                                                <dt><label for="cat_name">Nombre de la categor&iacute;a:</label></dt>
                                                <dd><input type="text" id="cat_name"name="c_nombre" value="" /></dd>
                                            </dl>
                                            <dl>
                                                <dt><label for="cat_img">Icono de la categor&iacute;a:</label></dt>
                                                <dd>
                                                    <img src="{$tsConfig.images}/space.gif" width="16" height="16" id="c_icon"/>
                                                    <select name="c_img" id="cat_img" style="width:164px">
                                                    {foreach from=$tsIcons key=i item=img}
                                                    	<option value="{$img}" style="padding:2px 20px 0; background:#FFF url({$tsConfig.url}/themes/default/images/icons/cat/{$img}) no-repeat left center;">{$img}</option>
                                                    {/foreach}
                                                    </select>
                                                </dd>
                                            </dl>
                                            <p><input type="submit" name="save" value="Crear Categor&iacute;a" class="btn_g"/></p>
                                        </fieldset> 
                                        </form>
                                    {elseif $tsAct == 'borrar'}
                                    	{if $tsError}<div class="mensajes error">{$tsError}</div>{/if}
                                    	{if $tsType == 'cat'}
                                        <form action="" method="post" id="admin_form">
                                            <label for="h_mov" style="width:500px;">Borrar categor&iacute;a y mover las subcategor&iacute;as y demas datos a otra categor&iacute;a diferente. Mover datos a:</label>
                                            <select name="ncid">
                                            	<option value="-1">Categor&iacute;as</option>
                                            	{foreach from=$tsConfig.categorias item=c}
                                                	{if $c.cid != $tsCID}
                                                	<option value="{$c.cid}">{$c.c_nombre}</option>
                                                    {/if}
                                                {/foreach}
                                            </select>
                                         <hr />
                                         <label>&nbsp;</label> <input type="submit" name="save" value="Guardar cambios" class="mBtn btnOk">
                                        </form>	                                        
                                        {/if}
									{elseif $tsAct == 'change'}
                                    	{if $tsError}<div class="mensajes error">{$tsError}</div>{/if}
                                        <form action="" method="post" id="admin_form">
                                            <label style="width:500px;">Mover todos los posts de la categor&iacute;a </label>
                                            <select name="oldcid">
                                            	<option value="-1">Categor&iacute;as</option>
                                            	{foreach from=$tsConfig.categorias item=c}
                                                	{if $c.cid != $tsCID}
                                                	<option value="{$c.cid}">{$c.c_nombre}</option>
                                                    {/if}
                                                {/foreach}
                                            </select>
											<label style="width:500px;"> a </label>
											<select name="newcid">
                                            	<option value="-1">Categor&iacute;as</option>
                                            	{foreach from=$tsConfig.categorias item=c}
                                                	{if $c.cid != $tsCID}
                                                	<option value="{$c.cid}">{$c.c_nombre}</option>
                                                    {/if}
                                                {/foreach}
                                            </select>
                                         <hr />
                                         <label>&nbsp;</label> <input type="submit" name="save" value="Guardar cambios" class="mBtn btnOk">
                                        </form>	                                        
                                    {/if}
                                </div>