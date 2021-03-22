<div class="content-tabs perfil" style="display:none">
	<fieldset>
		<div class="alert-cuenta cuenta-2"></div>
      <div class="field">
         <label for="nombre">Nombre completo</label>
         <input type="text" value="{$tsPerfil.p_nombre}" maxlength="60" name="nombre" id="nombre" class="text cuenta-save-2" style="width:230px">
      </div>
      <div class="field">
         <label for="sitio">Mensaje Personal</label>
         <textarea value="" maxlength="60" name="mensaje" id="mensaje" class="cuenta-save-2">{$tsPerfil.p_mensaje}</textarea>
      </div>
      
      <div class="field">
         <label for="sitio">Sitio Web</label>
         <input type="text" value="{$tsPerfil.p_sitio}" maxlength="60" name="sitio" id="sitio" class="text cuenta-save-2" style="width:230px">
      </div>
      <div class="field">
         <label for="ft">Redes sociales</label>
         <div class="div" style="float:left; ">
         	{foreach $tsPerfil.p_socials item=r key=i}
         	<div style="margin-bottom: 5px">
		         <strong>{$tsPerfil.redes.$i|ucfirst}.{if $tsPerfil.redes.$i == 'twitch'}tv{else}com{/if}/</strong><input type="text" class="text cuenta-save-2" style="width: 206px;" value="{$tsPerfil.p_socials.$i}" maxlength="64" placeholder="{$tsPerfil.redes.$i|capitalize}" name="{$tsPerfil.redes.$i}" id="ft{$tsPerfil.redes.$i}" class="form-control">
         	</div>
		      {/foreach}
		   </div>
      </div>
      <div class="field">
         <label for="estado_civil">Estado Civil</label>
         <div class="input-fake">
            <select class="cuenta-save-2" name="estado" id="estado_civil">
            	{foreach from=$tsPData.estado key=val item=text}
               	<option value="{$val}" {if $tsPerfil.p_estado == $val}selected="selected"{/if}>{$text}</option>
               {/foreach}
            </select>
         </div>
      </div>
      <div class="field">
      	<label for="estudios">Estudios</label>
      	<select class="cuenta-save-2" name="estudios" id="estudios">
	         {foreach from=$tsPData.estudios key=val item=text}
	            <option value="{$val}" {if $tsPerfil.p_estudios == $val}selected="selected"{/if}>{$text}</option>
	         {/foreach}
	      </select>
	   </div>
      <div class="field">
         <label for="profesion">Profesi&oacute;n</label>
         <input class="text cuenta-save-2" maxlength="32" name="profesion" id="profesion" value="{$tsPerfil.p_profesion}"/>
      </div>
      <div class="buttons">
         <input type="button" value="Guardar y seguir" onclick="cuenta.save(2, true)" class="mBtn btnOk">
      </div>
	</fieldset>
</div>