<div class="content-tabs perfil">
   <fieldset>
      <div class="field">
         <label for="nombrez">Nombre completo</label>
         <input type="text" value="{$tsPerfil.p_nombre}" maxlength="60" name="nombrez" id="nombrez" class="text cuenta-save-2" style="width:230px">
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
         <label for="red">Redes sociales</label>
         <div style="display:grid;grid-template-columns: repeat(2, 1fr);gap: 10px;">
            {foreach $tsPerfil.redes key=name item=red}
               <div style="display:flex;justify-content: flex-start;align-items: center;">
                  <div class="icon">
                  	<img src="{$tsConfig.images}/redes/{$name}.png" width="24" height="24" />
                  </div>
                  <input type="text" class="text cuenta-save-2" value="{$tsPerfil.p_socials.$name}" placeholder="{$red}" name="red[{$name}]">
               </div>
            {/foreach}
         </div>
      </div>
      <div class="field">
      	<label>Me gustar&iacute;a</label>
      	<div class="input-fake">
      		<ul>
               {foreach from=$tsPData.gustos key=val item=text}
                  <li><input type="checkbox" name="g_{$val}" class="cuenta-save-2" value="1"{if $tsPerfil.p_gustos.$val == 1} checked{/if}>{$text}</li>
               {/foreach}
            </ul>
         </div>
      </div>
      <div class="field">
         <label for="estado">Estado Civil</label>
         <div class="input-fake">
            <select class="cuenta-save-2" name="estado" id="estado">
              	{foreach from=$tsPData.estado key=val item=text}
                  <option value="{$val}"{if $tsPerfil.p_estado == $val} selected{/if}>{$text}</option>
               {/foreach}
            </select>
         </div>
      </div>
		<div class="buttons">
		   <input type="button" value="Guardar" onclick="cuenta.guardar_datos()" class="mBtn btnOk">
		</div>
   </fieldset>
   <div class="clearfix"></div>
</div>