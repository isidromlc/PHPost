								<script type="text/javascript">
								// {literal}
									$(function(){
										$('#cat_img').change(function(){
											var cssi = $("#cat_img option:selected").css('background');
											$('#c_icon').css({"background" : cssi});
										});
									});
								// {/literal}
								</script>
                                <div class="boxy-title">
                                    <h3>Administrar Rangos de Usuarios</h3>
                                </div>
                                <div id="res" class="boxy-content" style="position:relative">
                                {if $tsSave}<div class="mensajes ok">Tus cambios han sido guardados.</div>{/if}
								{if $tsError}<div class="mensajes error">{$tsError}</div>{/if}
                                {if $tsAct == ''}
                                <div style="width:350px; margin:0 auto 1em">
                                <h3 style="margin:0">Rangos Especiales</h3><hr style="margin:4px 0" />
                                <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="400" align="center">
                                	<thead>
                                    	<th>Rango</th>
                                        <th>Usuarios</th>
                                        <th>Puntos para dar</th>
										<th>Puntos por post</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                    {foreach from=$tsRangos.regular item=r}
                                    	<tr>
                                        	<td><a href="?act=list&rid={$r.id}&t=r" style="color:#{$r.color}">{$r.name}</a></td>
                                            <td>{$r.num_members}</td>
                                            <td>{$r.user_puntos}</td>
											<td>{$r.max_points}</td>
                                            <td><img src="{$tsConfig.url}/themes/default/images/icons/ran/{$r.imagen}" /></td>
                                            <td class="admin_actions">
                                            <a href="?act=editar&rid={$r.id}&t=s"><img src="{$tsConfig.url}/themes/default/images/icons/editar.png"  title="Editar Rango"/></a>
                                            {if $r.id > 3}<a href="?act=borrar&rid={$r.id}" ><img src="{$tsConfig.url}/themes/default/images/icons/close.png" title="Borrar Rango"/></a>{/if}{if $tsConfig.c_reg_rango == $r.id}<img src="{$tsConfig.url}/themes/default/images/icons/yes.png" title="Rango Predeterminado al registro"/>{else}<img id="f_2" onclick="location.href = '{$tsConfig.url}/admin/rangos/?act=setdefault&rid={$r.id}'; $('#f_2').style.cursor=wait"  style="cursor:pointer;" src="{$tsConfig.url}/themes/default/images/icons/reboot.png" title="Establecer Predeterminado" />{/if}
                                            </td>
                                        </tr>
                                    {/foreach}
                                    </tbody>
                                    <tfoot>
                                    	<td colspan="5" style="text-align:right"><a href="?act=nuevo&t=s">Agregar nuevo rango &raquo;</a></td>
                                    </tfoot>
                                </table>
                                </div>
                                <div style="width:550px; margin:0 auto">
                                <h3 style="margin:0">Rangos basados en el conteo de puntos y posts</h3><hr style="margin:4px 0" />
                                <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="550" align="center">
                                	<thead>
                                    	<th width="150">Rango</th>
                                        <th>Usuarios</th>
                                        <th>Tipo</th>
                                        <th>Cantidad requerida</th>
                                        <th>Puntos para dar</th>
										<th>Puntos por post</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                    {foreach from=$tsRangos.post item=r}
                                    	<tr>
                                        	<td><a href="?act=list&rid={$r.id}&t=p" style="color:#{$r.color}">{$r.name}</a></td>
                                            <td>{$r.num_members}</td>
                                            <td>{if $r.type == 1}Puntos{elseif $r.type == 2}Posts{elseif $r.type == 3}Fotos{elseif $r.type == 4}Comentarios{/if}</td>
                                            <td>{$r.cant}</td>
                                            <td>{$r.user_puntos}</td>
											<td>{$r.max_points}</td>
                                            <td><img src="{$tsConfig.url}/themes/default/images/icons/ran/{$r.imagen}" /></td>
                                            <td class="admin_actions">
                                            <a href="?act=editar&rid={$r.id}&t=p"><img src="{$tsConfig.url}/themes/default/images/icons/editar.png" title="Editar Rango"/></a>
                                            {if $r.id > 3}<a href="?act=borrar&rid={$r.id}"><img src="{$tsConfig.url}/themes/default/images/icons/close.png" title="Borrar Rango" /></a>{/if}
                                            
                                            </td>
                                        </tr>
                                    {/foreach}
                                    </tbody>
                                    <tfoot>
                                    	<td colspan="7" style="text-align:right"><a href="?act=nuevo">Agregar nuevo rango &raquo;</a></td>
                                    </tfoot>
                                </table>
                                </div>
                                {elseif $tsAct == 'list'}
                                {if !$tsMembers.data}
                                <div class="mensajes error">Aun no hay usuarios en este rango.</div>
                                {else}
                                <table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="550" align="center">
                                	<thead>
                                    	<th>Usuario</th>
                                        <th>Email</th>
                                        <th>&Uacute;ltima vez activo</th>
                                        <th>Fecha de registro</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                    	{foreach from=$tsMembers.data item=m}
                                        <tr>
                                        	<td align="left"><a href="{$tsConfig.url}/perfil/{$m.user_name}" class="hovercard" uid="{$m.user_id}" style="color:#{$m.r_color};">{$m.user_name}</a></td>
                                            <td>{$m.user_email}</td>
                                            <td>{$m.user_lastlogin|hace:true}</td>
                                            <td>{$m.user_registro|date_format:"%d/%m/%Y"}</td>
                                            <td class="admin_actions"><a href="{$tsConfig.url}/admin/users?act=show&uid={$m.user_id}&t=7"><img src="{$tsConfig.url}/themes/default/images/icons/editar.png" title="Editar rango" /></a></td>
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                    <tfoot>
                                    	<td colspan="6">P&aacute;ginas: {$tsMembers.pages}</td>
                                    </tfoot>
                                </table>
                                {/if}
                                {elseif $tsAct == 'nuevo' || $tsAct == 'editar'}
                                <script type="text/javascript" src="{$tsConfig.js}/jquery.color.js"></script>
                                {literal}
                                <style>
								#colores {width:200px; position:absolute; right:50px; padding:15px 8px 10px 10px; border:1px solid #ccc; background-color:#fafafa;}
								#cerrar {position:absolute; right:5px; top:3px; z-index:2}
								#colores .title {position:absolute; left:10px; top:0px; z-index:2; font-weight:bold}
								#colores span {display:block; float:left; cursor:pointer; border:1px solid #FFF; border-width:1px 1px 0 0}
                                /* ADMIN NEW LABEL */
                                fieldset tr.newLabel td{text-align:left;}
                                fieldset tr.newLabel label{
                                    float:none;
                                    width:80px;
                                    padding:0;
                                    text-align:center;
                                    cursor:pointer;
                                }
                                tr.newLabel label.yes:hover {
                                    background-color:#86F786;
                                }
                                tr.newLabel label.no:hover {
                                    background-color:#EFB0B2;
                                }
								</style>
                                {/literal}
                                <form action="" method="post">
                                <fieldset>
                                    <div id="colores"><span class="title">Colores</span><a href="#" id="cerrar"><img src="{$tsConfig.images}/borrar.png" /></a></div>
                                    <legend>Nuevo Rango</legend>
				
				<input type="button" id="b1" onclick="$('#tab1').fadeIn('slow'); $('#tab2').hide('slow'); $(this).css('border','1px solid #4D90FE'); $('#b2').css('border','0px');" value="B&aacute;sico" style="width:100px;cursor:default;border: 1px solid #4D90FE;" class="mBtn btnYellow"/> 
				
				<input type="button" id="b2" onclick="$('#tab2').show('slow'); $('#tab1').hide('slow'); $(this).css('border','1px solid #4D90FE'); $('#b1').css('border','0px');" value="Permisos" style="width:100px;cursor:default;" class="mBtn btnYellow"/> 
									
									<div id="tab1">
									
                                    <dl>
                                        <dt><label for="rName">T&iacute;tulo:</label></dt>
                                        <dd><input type="text" id="rName" name="rName" value="{$tsRango.r_name}" style="width:30%"/></dd>
                                    </dl>
                                	<dl>
                                        <dt><label for="rColor">Color:</label><br /><span>Color (<a href="http://es.wikipedia.org/wiki/Colores_HTML" target="_blank">hexadecimal</a>) del rango.</span></dt>
                                        <dd><input type="text" id="rColor" name="rColor" value="{$tsRango.r_color}" style="color:#{$tsRango.r_color}; font-weight:bold;width:30%"/></dd>
                                    </dl>
									<dl>
                                        <dt><label for="gopfd">Puntos por d&iacute;a:</label><br /><span>Puntos que puede otorgar este rango a otros usuarios al d&iacute;.</span></dt>
                                        <dd><input type="text" id="gopfd" name="global-pointsforday" value="{$tsRango.permisos.gopfd}" style="width:30%"/></dd>
                                    </dl>
									<dl>
                                        <dt><label for="gopfp">Puntos por post</label><br /><span>Puntos que puede dar en cada post.</span></dt>
                                        <dd><input type="text" id="gopfp" name="global-pointsforposts" value="{$tsRango.permisos.gopfp}" style="width:30%"/></dd>
                                    </dl>
									<dl>
                                        <dt><label for="goaf">Anti-flood</label><br /><span>Tiempo que deben esperar entre acci&oacute;n.</span></dt>
                                        <dd><input type="text" id="goaf" name="global-antiflood" value="{$tsRango.permisos.goaf}" style="width:30%"/></dd>
                                    </dl>
									<dl>
                                        
										<dt>
										
											<label for="gocpr">Condici&oacute;n especial:</label><br /><span>Cantidad requerida para obtener el rango. Elija especial si s&oacute;lo es asignado por un administrador. </span>
										   										
										</dt>
										
										<dd>
										
											<input type="text" id="gocpr" name="global-cantidadrequerida" style="width:12%{if $tsRango.r_type == 0};display:none;{/if}" maxlength="5" value="{$tsRango.r_cant}" />
										
											<label onclick="$('#gocpr').slideDown();"><input name="global-type" type="radio" id="ai_type" value="1" {if $tsRango.r_type == 1}checked{/if} class="radio"/><span class="qtip" title="Del usuario">Puntos</<span></label>
                                           
											<label onclick="$('#gocpr').slideDown();"><input name="global-type" type="radio" id="ay_type" value="2" {if $tsRango.r_type == 2}checked{/if} class="radio"/>Posts</label>
                                            
											<label onclick="$('#gocpr').slideDown();"><input name="global-type" type="radio" id="ay_type" value="3" {if $tsRango.r_type == 3}checked{/if} class="radio"/>Fotos</label>
										
											<label onclick="$('#gocpr').slideDown();"><input name="global-type" type="radio" id="ay_type" value="4" {if $tsRango.r_type == 4}checked{/if} class="radio"/><span class="qtip" title="De posts y fotos">Comentarios</<span></label>
											
											<label onclick="$('#gocpr').slideUp();"><input name="global-type" type="radio" id="ay_type" value="0" {if $tsRango.r_type == 0}checked{/if} class="radio"/>Especial</label>
										
										</dd>
                                        
									</dl>
                                    <dl>
                                        <dt><label for="cat_img">Icono del rango:</label></dt>
                                        <dd>
                                            <img src="{$tsConfig.images}/space.gif" style="background:url({$tsConfig.url}/themes/default/images/icons/ran/{if $tsRango.r_image}{$tsRango.r_image}{else}{$tsIcons.0}{/if}) no-repeat left center;" width="16" height="16" id="c_icon"/>
                                            <select name="r_img" id="cat_img" style="width:164px">
                                            {foreach from=$tsIcons key=i item=img}
                                                <option value="{$img}" style="padding:2px 20px 0; background:#FFF url({$tsConfig.url}/themes/default/images/icons/ran/{$img}) no-repeat left center;" {if $tsRango.r_image == $img}selected="selected"{/if}>{$img}</option>
                                            {/foreach}
                                            </select>   
                                        </dd>
                                    </dl>
                                    <hr />
									<input type="button" onclick="$('#tab2').show('slow'); $('#tab1').hide('slow'); $('#b2').css('border','1px solid #4D90FE'); $('#b1').css('border','0px');" value="Continuar" style="width:100px;cursor:default;" class="btn_g"/> 
									</div>									
									<div id="tab2" style="display:none;">
										
										<fieldset>
										<legend>Super Moderaci&oacute;n</legend>
                                        <input type="checkbox" id="suad" name="superadmin" {if $tsRango.permisos.suad}checked{/if} /><label style="font-weight:bold;" for="suad">Super Admin. </label><label for="suad"> &nbsp; Si marca esto, los permisos p&uacute;blicos, de administraci&oacute;n y de moderaci&oacute;n estar&aacute;n inclu&iacute;dos.</label>
										<br /><hr>
                                        <input type="checkbox" id="sumo" name="supermod" {if $tsRango.permisos.sumo}checked{/if} /><label style="font-weight:bold;" for="sumo">Super Moderador</label><label for="sumo"> &nbsp; Si marca esto, todos los permisos p&uacute;blicos y de moderaci&oacute;n estar&aacute;n inclu&iacute;dos.</label>
										</fieldset>
										<fieldset>
										<legend>Global</legend>
										<input type="checkbox" id="godp" name="global-darpuntos" {if $tsRango.permisos.godp}checked{/if} /><label style="font-weight:bold;" for="godp">Puntuar Posts</label><label for="godp"> &nbsp; Podr&aacute;n puntuar posts.</label>
										<br /><hr>
										<input type="checkbox" id="gopp" name="global-publicarposts" {if $tsRango.permisos.gopp}checked{/if} /><label style="font-weight:bold;" for="gopp">Publicar Posts</label><label for="gopp"> &nbsp; Podr&aacute;n publicar posts.</label>
										<br /><hr>
										<input type="checkbox" id="gopcp" name="global-publicarcomposts" {if $tsRango.permisos.gopcp}checked{/if} /><label style="font-weight:bold;" for="gopcp">Publicar Comentarios en Posts</label><label for="gopcp"> &nbsp; Podr&aacute;n publicar comentarios posts.</label>
										<br /><hr>
                                        <input type="checkbox" id="govpp" name="global-votarposipost" {if $tsRango.permisos.govpp}checked{/if} /><label style="font-weight:bold;" for="govpp">Votar postivo</label><label for="govpp"> &nbsp; Podr&aacute;n votar positivamente comentarios de posts.</label>
										<br /><hr>
                                        <input type="checkbox" id="govpn" name="global-votarnegapost" {if $tsRango.permisos.govpn}checked{/if} /><label style="font-weight:bold;" for="govpn">Votar negativo</label><label for="govpn"> &nbsp; Podr&aacute;n votar negativamente comentarios de posts.</label>
										<br /><hr>
										<input type="checkbox" id="goepc" name="global-editarpropioscomentarios" {if $tsRango.permisos.goepc}checked{/if} /><label style="font-weight:bold;" for="goepc">Editar comentarios propios</label><label for="goepc"> &nbsp; Podr&aacute;n editar los comentarios que ellos hacen.</label>
										<br /><hr>
										<input type="checkbox" id="godpc" name="global-eliminarpropioscomentarios" {if $tsRango.permisos.godpc}checked{/if} /><label style="font-weight:bold;" for="godpc">Eliminar comentarios propios</label><label for="godpc"> &nbsp; Podr&aacute;n eliminar los comentarios que ellos hacen.</label>
										<br /><hr>
										<input type="checkbox" id="gopf" name="global-publicarfotos" {if $tsRango.permisos.gopf}checked{/if} /><label style="font-weight:bold;" for="gopf">Publicar Fotos</label><label for="gopf"> &nbsp; Podr&aacute;n publicar fotos.</label>
										<br /><hr>
										<input type="checkbox" id="gopcf" name="global-publicarcomfotos" {if $tsRango.permisos.gopcf}checked{/if} /><label style="font-weight:bold;" for="gopcf">Publicar Comentarios en Fotos</label><label for="gopf"> &nbsp; Podr&aacute;n publicar comentarios en fotos.</label>
										<br /><hr>
										<input type="checkbox" id="gorpap" name="global-revisarposts" {if $tsRango.permisos.gorpap}checked{/if} /><label style="font-weight:bold;" for="gorpap">Revisar Posts</label><label for="gorpap"> &nbsp; Si marca esto, cuando publiquen un post, antes de ser p&uacute;blico ser&aacute;n revisados.</label>
										<br /><hr>
                                        <input type="checkbox" id="govwm" name="global-vermantenimiento" {if $tsRango.permisos.govwm}checked{/if} /><label style="font-weight:bold;" for="govwm">Acceso en mantenimiento </label><label for="govwm"> &nbsp; Podr&aacute;n navegar normalmente mientras la web est&aacute; en mantenimiento.</label>
                                        </fieldset>
										<fieldset>
										<legend>Panel de Moderaci&oacute;n</legend>
										<input type="checkbox" id="moacp" name="mod-accesopanel" {if $tsRango.permisos.moacp}checked{/if} /><label style="font-weight:bold;" for="moacp">Acceso al Panel de Moderaci&oacute;n. </label><label for="moacp"> &nbsp; Podr&aacute;n entrar al panel de moderaci&oacute;n y ver posts y fotos denunciadas.</label>
										<br /><br />
										<fieldset>
										<legend>Denuncias</legend>
										<input type="checkbox" id="mocdu" name="mod-cancelardenunciasusuarios" {if $tsRango.permisos.mocdu}checked{/if} /><label style="font-weight:bold;" for="mocdu">Cancelar denuncias de usuarios. </label><label for="modcu"> &nbsp; Podr&aacute;n ver y cancelar reportes de usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="mocdf" name="mod-cancelardenunciasfotos" {if $tsRango.permisos.mocdf}checked{/if} /><label style="font-weight:bold;" for="mocdf">Cancelar denuncias de fotos. </label><label for="mocdf"> &nbsp; Podr&aacute;n rechazar reportes de fotos.</label>
										<br /><hr>
										<input type="checkbox" id="mocdp" name="mod-cancelardenunciasposts" {if $tsRango.permisos.mocdp}checked{/if} /><label style="font-weight:bold;" for="mocdp">Cancelar denuncias de posts. </label><label for="moadp"> &nbsp; Podr&aacute;n rechazar reportes de posts.</label>
										<br /><hr>
										<input type="checkbox" id="moadm" name="mod-aceptardenunciasmensajes" {if $tsRango.permisos.moadm}checked{/if} /><label style="font-weight:bold;" for="moadm">Aceptar denuncias de mensajes. </label><label for="moadm"> &nbsp; Podr&aacute;n aceptar reportes de mensajes.</label>
										<br /><hr>
										<input type="checkbox" id="mocdm" name="mod-cancelardenunciasmensajes" {if $tsRango.permisos.mocdm}checked{/if} /><label style="font-weight:bold;" for="mocdm">Cancelar denuncias de mensajes. </label><label for="mocdm"> &nbsp; Podr&aacute;n rechazar reportes de mensajes.</label>
										</fieldset>
										<br /> <br />
										<input type="checkbox" id="movub" name="mod-verusuariosbaneados" {if $tsRango.permisos.movub}checked{/if} /><label style="font-weight:bold;" for="movub">Usuarios baneados. </label><label for="movub"> &nbsp; Podr&aacute;n ver usuarios baneados.</label>
										<br /><hr>
										<input type="checkbox" id="moub" name="mod-usarbuscador" {if $tsRango.permisos.moub}checked{/if} /><label style="font-weight:bold;" for="moub">Usar el buscador. </label><label for="moub"> &nbsp; Podr&aacute;n usar el buscador de contenidos.</label>
										<br /><hr>
										<input type="checkbox" id="morp" name="mod-reciclajeposts" {if $tsRango.permisos.morp}checked{/if} /><label style="font-weight:bold;" for="morp">Papelera de posts. </label><label for="morp"> &nbsp; Podr&aacute;n ver la papelera de reciclaje de posts y los posts eliminados.</label>
										<br /><hr>
										<input type="checkbox" id="morf" name="mod-reficlajefotos" {if $tsRango.permisos.morf}checked{/if} /><label style="font-weight:bold;" for="morf">Papelera de fotos. </label><label for="morf"> &nbsp; Podr&aacute;n ver la papelera de reciclaje de fotos y las fotos eliminadas.</label>
										<br /><hr>
										<input type="checkbox" id="mocp" name="mod-contenidoposts" {if $tsRango.permisos.mocp}checked{/if} /><label style="font-weight:bold;" for="mocp">Posts desaprobados. </label><label for="mocp"> &nbsp; Podr&aacute;n ver la secci&oacute;n y los posts ocultos.</label>
										<br /><hr>
										<input type="checkbox" id="mocc" name="mod-contenidocomentarios" {if $tsRango.permisos.mocc}checked{/if} /><label style="font-weight:bold;" for="mocc">Comentarios desaprobados. </label><label for="mocc"> &nbsp; Podr&aacute;n ver los comentarios ocultos.</label>
										</fieldset>
										<fieldset>
										<legend>Moderaci&oacute;n Parcial</legend>
										<input type="checkbox" id="most" name="mod-sticky" {if $tsRango.permisos.most}checked{/if} /><label style="font-weight:bold;" for="most">Fijar Posts</label><label for="most"> &nbsp; Podr&aacute;n poner/quitar posts en sticky desde el formulario y el mismo post.</label>
										<br /><hr>
										<input type="checkbox" id="moayca" name="mod-abrirycerrarajax" {if $tsRango.permisos.moayca}checked{/if} /><label style="font-weight:bold;" for="moayca">Abrir/Cerrar Posts Ajax</label><label for="moayaca"> &nbsp; Podr&aacute;n abrir/cerrar posts r&aacute;pidamente desde el post.</label>
										<br /><hr>
										<input type="checkbox" id="movcud" name="mod-vercuentasdesactivadas" {if $tsRango.permisos.movcud}checked{/if} /><label style="font-weight:bold;" for="movcud">Ver cuentas desactivadas</label><label for="movcud"> &nbsp; Podr&aacute;n ver cuentas de usuarios desactivadas.</label>
										<br /><hr>
										<input type="checkbox" id="movcus" name="mod-vercuentassuspendidas" {if $tsRango.permisos.movcus}checked{/if} /><label style="font-weight:bold;" for="movcus">Ver cuentas baneadas</label><label for="movcus"> &nbsp; Podr&aacute;n ver cuentas de usuarios baneados.</label>
										<br /><hr>
										<input type="checkbox" id="mosu" name="mod-suspenderusuarios" {if $tsRango.permisos.mosu}checked{/if} /><label style="font-weight:bold;" for="mosu">Suspender Usuarios</label><label for="mosu"> &nbsp; Podr&aacute;n suspender usuarios desde formulario modal.</label>
										<br /><hr>
										<input type="checkbox" id="modu" name="mod-desbanearusuarios" {if $tsRango.permisos.modu}checked{/if} /><label style="font-weight:bold;" for="modu">Desbanear Usuarios</label><label for="modu"> &nbsp; Podr&aacute;n desbanear usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moep" name="mod-eliminarposts" {if $tsRango.permisos.moep}checked{/if} /><label style="font-weight:bold;" for="moep">Eliminar Posts</label><label for="moep"> &nbsp; Podr&aacute;n eliminar posts de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moedpo" name="mod-editarposts" {if $tsRango.permisos.moedpo}checked{/if} /><label style="font-weight:bold;" for="moedpo">Editar Posts</label><label for="moedpo"> &nbsp; Podr&aacute;n editar posts de otros usuarios (requiere permiso publicar post).</label>
										<br /><hr>
										<input type="checkbox" id="moop" name="mod-ocultarposts" {if $tsRango.permisos.moop}checked{/if} /><label style="font-weight:bold;" for="moop">Ocultar Posts</label><label for="moop"> &nbsp; Podr&aacute;n ocultar posts de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="mocepc" name="mod-comentarpostcerrado" {if $tsRango.permisos.mocepc}checked{/if} /><label style="font-weight:bold;" for="mocepc">Comentarios en Post Cerrado</label><label for="mocepc"> &nbsp; Podr&aacute;n comentar en posts cerrados.</label>
										<br /><hr>
										<input type="checkbox" id="moedcopo" name="mod-editarcomposts" {if $tsRango.permisos.moedcopo}checked{/if} /><label style="font-weight:bold;" for="moedcopo">Editar Comentarios de Posts</label><label for="moedcopo"> &nbsp; Podr&aacute;n editar comentarios de posts de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moaydcp" name="mod-desyaprobarcomposts" {if $tsRango.permisos.moaydcp}checked{/if} /><label style="font-weight:bold;" for="moaydcp">Acciones de revisi&oacute;n</label><label for="moaydcp"> &nbsp; Aprobar/desaprobar comentarios en los posts y en la revisi&oacute;n de comentarios.</label>
										<br /><hr>
										<input type="checkbox" id="moecp" name="mod-eliminarcomposts" {if $tsRango.permisos.moecp}checked{/if} /><label style="font-weight:bold;" for="moecp">Eliminar Comentarios de Posts</label><label for="moecp"> &nbsp; Podr&aacute;n eliminar comentarios en posts de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moef" name="mod-eliminarfotos" {if $tsRango.permisos.moef}checked{/if} /><label style="font-weight:bold;" for="moef">Eliminar Fotos</label><label for="moef"> &nbsp; Podr&aacute;n eliminar fotos de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moedfo" name="mod-editarfotos" {if $tsRango.permisos.moedfo}checked{/if} /><label style="font-weight:bold;" for="moedfo">Editar Fotos</label><label for="moedfo"> &nbsp; Podr&aacute;n editar fotos de otros usuarios (requiere publicar foto).</label>
										<br /><hr>
										<input type="checkbox" id="moecf" name="mod-eliminarcomfotos" {if $tsRango.permisos.moecf}checked{/if} /><label style="font-weight:bold;" for="moecf">Eliminar Comentarios de Fotos</label><label for="moecf"> &nbsp; Podr&aacute;n eliminar comentarios en fotos de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moepm" name="mod-eliminarpubmuro" {if $tsRango.permisos.moepm}checked{/if} /><label style="font-weight:bold;" for="moepm">Eliminar Publicaciones de Muros</label><label for="moepm"> &nbsp; Podr&aacute;n eliminar publicaciones en muros de otros usuarios.</label>
										<br /><hr>
										<input type="checkbox" id="moecm" name="mod-eliminarcommuro" {if $tsRango.permisos.moecm}checked{/if} /><label style="font-weight:bold;" for="moecm">Eliminar Comentarios de Muros</label><label for="moecm"> &nbsp; Podr&aacute;n eliminar comentarios en muros de otros usuarios.</label>
										</fieldset>
										
                                    <input type="hidden" name="sp" value="{if $tsType == 's'}1{else}0{/if}" />
                                    <p><input type="submit" name="save" value="Guardar Cambios" class="btn_g"/></p>
									</div>
                                </fieldset>
                                </form>
                                {elseif $tsAct == 'borrar'}
                                <form action="" method="post" id="admin_form">
                                	<div class="mensajes error">Si borras este rango todos los usuarios que est&eacute;n en &eacute;l, ser&aacute;n asignados al rango 
									
									<select name="new_rango">{foreach from=$tsRangos item=r}<option value="{$r.rango_id}" style="color:#{$r.r_color}; padding:2px 20px 0;" {if $r.rango_id == 3}selected{/if}>{$r.r_name}</option>{/foreach}</select> <br /> &iquest;Realmente deseas borrar este rango?</div>
                                    
									<label>&nbsp;</label> <input type="submit" name="save" value="S&iacute;, Continuar &raquo;" class="mBtn btnCancel">
                                </form>
                                {/if}
                                </div>