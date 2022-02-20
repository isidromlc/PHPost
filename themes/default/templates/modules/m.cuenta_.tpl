<div class="content-tabs cuenta">
   <fieldset>
      <div class="field">
         <label for="email">E-Mail:</label>
         <div class="input-fake input-hide-email">
            {$tsUser->info.user_email} (<a onclick="input_fake('email')">Cambiar</a>)
         </div>
         <input type="text" style="display: none" value="{$tsUser->info.user_email}" maxlength="35" name="email" id="email" class="text cuenta-save-1 input-hidden-email">
      </div>
      <div class="field">
         <label for="pais">Pa&iacute;s:</label>
         <select onchange="cuenta.chgpais()" class="cuenta-save-1" name="pais" id="pais">
            <option value="">Pa&iacute;s</option>
            {foreach from=$tsPaises key=code item=pais}
               <option value="{$code}"{if $code == $tsPerfil.user_pais} selected{/if}>{$pais}</option>
            {/foreach}
         </select>
      </div>
      <div class="field">
         <label for="estado">Estado/Provincia:</label>
         <select name="estado" id="estado" class="cuenta-save-1">
            {foreach from=$tsEstados key=code item=estado}
               <option value="{$code+1}"{if $code+1 == $tsPerfil.user_estado} selected{/if}>{$estado}</option>
            {/foreach}
         </select>
      </div>
      <div class="field">
         <label>Sexo</label>
         <ul class="fields">
            <li>
               <label><input type="radio" value="m" name="sexo" class="radio cuenta-save-1"{if $tsPerfil.user_sexo == '1'} checked{/if}/>Masculino</label>
            </li>
            <li>
               <label><input type="radio" value="f" name="sexo" class="radio cuenta-save-1"{if $tsPerfil.user_sexo == '0'} checked{/if}/>Femenino</label>
            </li>
         </ul>
      </div>
   </fieldset>
   <div class="field">
		<label>Nacimiento:</label>
		<select class="cuenta-save-1" name="dia">
         {section name=dias start=1 loop=32}
            <option value="{$smarty.section.dias.index}"{if $tsPerfil.user_dia ==  $smarty.section.dias.index} selected{/if}>{$smarty.section.dias.index}</option>
         {/section}                            
		</select>
		<select class="cuenta-save-1" name="mes">
         {foreach from=$tsMeces key=mid item=mes}
            <option value="{$mid}"{if $tsPerfil.user_mes == $mid} selected{/if}>{$mes}</option>
         {/foreach}
		</select>
		<select class="cuenta-save-1" name="ano">
         {section name=year start=$tsEndY loop=$tsEndY step=-1 max=$tsMax}
            <option value="{$smarty.section.year.index}"{if $tsPerfil.user_ano ==  $smarty.section.year.index} selected{/if}>{$smarty.section.year.index}</option>
         {/section}
		</select>
	</div>
   {if $tsConfig.c_allow_firma}
      <div class="field">
         <label for="firma">Firma:<br /> <small style="font-weight:normal">(Acepta BBCode) Max. 300 car.</small></label>
         <textarea name="firma" id="firma" class="cuenta-save-1">{$tsPerfil.user_firma}</textarea>
      </div>
   {/if}
   <div class="buttons">
      <input type="button" value="Guardar" onclick="cuenta.guardar_datos()" class="mBtn btnOk">
   </div>
   <div class="clearfix"></div>
</div>