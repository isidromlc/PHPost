<div class="modalForm" style="margin:-15px 0;">
{if $tsDo == 'aviso'}
    <div class="m-col1">Para:</div>
    <div class="m-col2"><strong>{$tsUsername}</strong></div>
    <br style="clear:both"/>
    <div class="m-col1">Tipo:</div>
    <div class="m-col2"><select name="mod_type" id="mod_type"><option value="0">Informaci&oacute;n</option><option value="1">Alerta</option><option value="2">Staff Message</option><option value="3">Prohibici&oacute;n</option><option value="4">Gif Message</option></select></div>
    <br style="clear:both"/>
    <div class="m-col1">Asunto:</div>
    <div class="m-col2"><input type="text" name="mod_subject" id="mod_subject" size="50" tabindex="0" maxlength="24" value=""/></div>
    <br /><br style="clear:both"/>
    <div class="m-col1">Mensaje:</div>
    <div class="m-col2"><textarea style="height:100px; width:350px" name="mod_body" id="mod_body" rows="10" tabindex="0"></textarea></div>
    <br style="clear:both"/>
{elseif $tsDo == 'ban'}
    <div class="m-col1">Suspender a:</div>
    <div class="m-col2"><strong>{$tsUsername}</strong></div>
    <br style="clear:both"/>
    <div class="m-col1">Tiempo:</div>
    <div class="m-col2"><select name="mod_time" id="mod_time" onchange="ban_time(this.value);"><option value="0">Indefinido</option><option value="1">Permanente</option><option value="2">Horas</option><option value="3">D&iacute;as</option></select></div>
    <br style="clear:both"/>
    <div id="ban_time" style="display:none">
    <div class="m-col1">Cuantos:</div>
    <div class="m-col2"><input type="text" name="mod_cant" id="mod_cant" size="10" tabindex="0" maxlength="3" class="mDate iTxt"/></div>
    <br style="clear:both"/>
    </div>
    <div class="m-col1">Causa:</div>
    <div class="m-col2"><textarea style="height:50px; width:200px" name="mod_causa" id="mod_causa" rows="10" tabindex="0"></textarea></div>
    <br style="clear:both"/>
<script type="text/javascript">
// {literal}
function ban_time(tid){
    if(tid == 2 || tid == 3){
        var txt = (tid == 2) ? 'Cuantas' : 'Cuantos';
        $('#ban_time > .m-col1').text(txt);
        $('#ban_time').show()
    } else $('#ban_time').hide();
}
// {/literal}
</script>
{/if}
</div>