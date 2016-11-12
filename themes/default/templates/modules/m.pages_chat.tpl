<div style="width:630px" class="floatL">
	<div class="box_title">
		<div class="box_txt chat">Chat {$tsConfig.titulo}</div>
		<div class="box_rrs">
			<div class="box_rss"></div> 
		</div>
	</div>
	<div class="box_cuerpo">	
        {if $tsConfig.chat_id}<embed src="http://{$tsConfig.chat_id}.chatango.com/group" width="615" height="472" wmode="transparent" allowScriptAccess="always" allowNetworking="all" type="application/x-shockwave-flash" allowFullScreen="true" flashvars="cid={$tsConfig.chat_id}&v=0&w=0"></embed>
        {elseif $tsConfig.xat_id}
		<embed src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="615" height="472" name="chat" FlashVars="id={$tsConfig.xat_id}" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.shtml" /><br><small><a target="_BLANK" href="http://xat.com/web_gear/chat/go_large.php?id={$tsConfig.xat_id}">Chat m&aacute;s amplio.</a></small><br>
		{else}
        <div class="emptyData">Estamos por agregar el chat para que todos ustedes se puedan divertir y hacer nuevos amigos.</div>
        {/if}		
	</div>
	
	<br />
	
	<div class="box_title" onclick="$('#protocolo').slideToggle();">
		<div class="box_txt chat">Protocolo</div>
		<div class="box_rrs">
			<div class="box_rss"></div> 
		</div>
	</div>
	<div class="box_cuerpo" style="display:none;" id="protocolo" >	
	<font class="size12"><b>1.</b> No se permite el uso de nicks que contengan t&eacute;rminos insultantes, sexuales, spam, apolog&iacute;as a la violencia o alg&uacute;n pedido de car&aacute;cter sexual, compa&ntilde;&iacute;a, parejas y/o a fines.
	<br /><br />
	<b>2.</b> Est&aacute; prohibido faltar el respeto, insultar, provocar, difamar, acosar, amenazar o hacer cualquier otra cosa no deseada, tanto directa como indirecta a otro usuario.
	<br /><br />
	<b>3.</b> No est&aacute; permitido el SPAM, publicidad o propaganda de p&aacute;ginas personales, chats, foros, mensajes comerciales destinados a vender productos o servicios, etc.
    <br><br>
    <b>4.</b> No repetir o enviar varias l&iacute;neas de texto en un cierto tiempo, NO FLOOD.
    <br /><br />
    <b>5.</b> Recomendamos no abusar de las MAY&Uacute;SCULAS, solo utilizarlas por reglas ortograficas (comienzos de oraci&oacute;n, nombres propios o siglas), ya que el uso de &eacute;sta significa GRITAR.</font>
	<br /><br /><p style="padding: 0px; margin: 0px;" align="right">
	<i>Este protocolo es solo para el chat, para la web en general existe otro <a href="{$tsConfig.url}/pages/protocolo/">protocolo</a>.</i></p>
		
	</div>
	
</div>
<div style="width:300px" class="floatR">
    {include file='modules/m.global_ads_300.tpl'}
    {if $tsConfig.chat_id}<br />
    {include file='modules/m.global_ads_300.tpl'}
    {/if}
</div>