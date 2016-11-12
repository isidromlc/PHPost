1:
<div id="perfil_info" status="activo">
    <div class="widget big-info clearfix">
        <div class="title-w clearfix">
            <h3>Informaci&oacute;n de {$tsUsername}</h3>
        </div>
        <ul>
            <li><label>Pa&iacute;s</label><strong>{$tsPais}</strong></li>
			{if $tsPerfil.p_sitio}<li><label>Sitio Web</label><strong><a rel="nofollow" href="{$tsPerfil.p_sitio}">{$tsPerfil.p_sitio}</a></strong></li>{/if}			
            <li><label>Es usuario desde</label><strong>{$tsPerfil.user_registro|fecha:"d_Ms_a"}</strong></li>
            <li><label>&Uacute;ltima vez activo</label><strong>{$tsPerfil.user_lastactive|fecha}</strong></li>
			{if $tsPerfil.p_estudios}<li><label>Estudios</label><strong>{$tsPData.estudios[$tsPerfil.p_estudios]}</strong></li>{/if}
			<li class="sep"><h4>Idiomas</h4></li>
        	{foreach from=$tsPData.idiomas key=iid item=idioma}
            {if $tsPerfil.p_idiomas.$iid != 0}<li><label>{$idioma}</label>{foreach from=$tsPData.inivel key=val item=text}{if $tsPerfil.p_idiomas.$iid == $val}<strong>{$text}</strong>{/if}{/foreach}</li>{/if}
            {/foreach}															
			<li class="sep"><h4>Datos profesionales</h4></li>
			{if $tsPerfil.p_profesion}<li><label>Profesi&oacute;n</label><strong>{$tsPerfil.p_profesion}</strong></li>{/if}			
            {if $tsPerfil.p_empresa}<li><label>Empresa</label><strong>{$tsPerfil.p_empresa}</strong></li>{/if}			
            {if $tsPerfil.p_sector}<li><label>Sector</label><strong>{$tsPData.sector[$tsPerfil.p_sector]}</strong></li>{/if}			
            {if $tsPerfil.p_ingresos}<li><label>Ingresos</label><strong>{$tsPData.ingresos[$tsPerfil.p_ingresos]}</strong></li>{/if}			
            {if $tsPerfil.p_int_prof}<li><label>Intereses profesionales</label><strong>{$tsPerfil.p_int_prof}</strong></li>{/if}			
            {if $tsPerfil.p_hab_prof}<li><label>Habilidades profesionales</label><strong>{$tsPerfil.p_hab_prof}</strong></li>{/if}
			<li class="sep"><h4>Vida personal</h4></li>
			{if $tsGustos == 'show'}<li><label>Le gustar&iacute;a</label><strong>{foreach from=$tsPData.gustos key=val item=text}{if $tsPerfil.p_gustos.$val == 1}{$text}, {/if}{/foreach}</strong></li>{/if}			
            {if $tsPerfil.p_estado}<li><label>Estado civil</label><strong>{$tsPData.estado[$tsPerfil.p_estado]}</strong></li>{/if}			
            {if $tsPerfil.p_hijos}<li><label>Hijos</label><strong>{$tsPData.hijos[$tsPerfil.p_hijos]}</strong></li>{/if}			
            {if $tsPerfil.p_vivo}<li><label>Vive con</label><strong>{$tsPData.vivo[$tsPerfil.p_vivo]}</strong></li>{/if}
			<li class="sep"><h4>&iquest;C&oacute;mo es?</h4></li>
			{if $tsPerfil.p_altura}<li><label>Mide</label><strong>{$tsPerfil.p_altura} centimetros</strong></li>{/if}			
            {if $tsPerfil.p_peso}<li><label>Pesa</label><strong>{$tsPerfil.p_peso} kilos</strong></li>{/if}			
            {if $tsPerfil.p_pelo}<li><label>Su pelo es</label><strong>{$tsPData.pelo[$tsPerfil.p_pelo]}</strong></li>{/if}			
            {if $tsPerfil.p_ojos}<li><label>Sus ojos son</label><strong>{$tsPData.ojos[$tsPerfil.p_ojos]}</strong></li>{/if}
            {if $tsPerfil.p_fisico}<li><label>Su f&iacute;sico es</label><strong>{$tsPData.fisico[$tsPerfil.p_fisico]}</strong></li>{/if}
            {if $tsPerfil.p_tengo.0 != 0 || $tsPerfil.p_tengo.1 != 0}
            {foreach from=$tsPData.tengo key=val item=text}
            <li><label></label><strong>{if $tsPerfil.p_tengo.$val == 1}Tiene{else}No tiene{/if} {$text}</strong></li>
            {/foreach}
            {/if}				
			<li class="sep"><h4>Habitos personales</h4></li>
			{if $tsPerfil.p_dieta}<li><label>Mantiene una dieta</label><strong>{$tsPData.dieta[$tsPerfil.p_dieta]}</strong></li>{/if}			
            {if $tsPerfil.p_fumo}<li><label>Fuma</label><strong>{$tsPData.fumo_tomo[$tsPerfil.p_fumo]}</strong></li>{/if}			
            {if $tsPerfil.p_tomo}<li><label>Toma alcohol</label><strong>{$tsPData.fumo_tomo[$tsPerfil.p_tomo]}</strong></li>{/if}
			<li class="sep"><h4>Sus propias palabras</h4></li>
			{if $tsPerfil.p_intereses}<li><label>Intereses</label><strong>{$tsPerfil.p_intereses}</strong></li>{/if}
            {if $tsPerfil.p_hobbies}<li><label>Hobbies</label><strong>{$tsPerfil.p_hobbies}</strong></li>{/if}
            {if $tsPerfil.p_tv}<li><label>Series de TV favoritas</label><strong>{$tsPerfil.p_tv}</strong></li>{/if}			
            {if $tsPerfil.p_musica}<li><label>M&uacute;sica favorita</label><strong>{$tsPerfil.p_musica}</strong></li>{/if}
            {if $tsPerfil.p_deportes}<li><label>Deportes y Equipos</label><strong>{$tsPerfil.p_deportes}</strong></li>{/if}	
            {if $tsPerfil.p_libros}<li><label>Libros favoritos</label><strong>{$tsPerfil.p_libros}</strong></li>{/if}
            {if $tsPerfil.p_peliculas}<li><label>Pel&iacute;culas favoritas</label><strong>{$tsPerfil.p_peliculas}</strong></li>{/if}			
            {if $tsPerfil.p_comida}<li><label>Comida favor&iacute;ta</label><strong>{$tsPerfil.p_comida}</strong></li>{/if}
            {if $tsPerfil.p_heroes}<li><label>Sus heroes son</label><strong>{$tsPerfil.p_heroes}</strong></li>{/if}
        </ul>
    </div>
</div>