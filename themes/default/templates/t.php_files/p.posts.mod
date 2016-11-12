{
*********************************************************************************
* p.registro.form.tpl                                                           *
*********************************************************************************
* TScript: Desarrollado por CubeBox ®											*
* ==============================================================================*
* Software Version:           TS 1.0 BETA          								*
* Software by:                JNeutron			     							*
* Copyright 2010:     		  CubeBox ®											*
*********************************************************************************
}
Raz&oacute;n para borrar este post:<br /><br />
<select onchange="$('input[name=razon]').val($(this).val());">
{foreach from=$tsDenuncias item=d}
    {if $d}<option value="{$d}">{$d}</option>{/if}
{/foreach}
</select>