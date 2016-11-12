Raz&oacute;n para borrar este post:<br /><br />
<select id="razon" onchange="if($(this).val() == 13) $('input[name=razon_desc]').slideDown();">
{foreach from=$tsDenuncias item=d key=i}
    {if $d}<option value="{$i}">{$d}</option>{/if}
{/foreach}
</select><br /><br />
<input type="text" name="razon_desc" maxlength="150" size="35" style="display:none" />
<br />
<label for="send_b"><input type="checkbox" id="send_b" name="send_b" value="1"/>  Enviar al borrador del usuario.</label>