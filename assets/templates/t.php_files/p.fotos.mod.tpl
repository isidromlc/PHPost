Raz&oacute;n para borrar esta foto:<br /><br />
<select id="razon" onchange="if($(this).val() == 8) $('input[name=razon_desc]').slideDown();">
{foreach from=$tsDenuncias item=d key=i}
    {if $d}<option value="{$i}">{$d}</option>{/if}
{/foreach}
</select><br /><br />
<input type="text" name="razon_desc" maxlength="150" size="35" style="display:none" />