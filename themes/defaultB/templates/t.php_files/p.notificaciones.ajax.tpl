    {if $tsData}
	{foreach from=$tsData item=noti}
   	<li{if $noti.unread > 0}  class="unread"{/if}><span class="monac_icons ma_{$noti.style}"></span>{if $noti.total == 1}<a href="{$tsConfig.url}/perfil/{$noti.user}" title="{$noti.user}">{$noti.user}</a>{/if} {$noti.text} <a title="{$noti.ltit}" class="obj" href="{$noti.link}">{$noti.ltext}</a></li>
    {/foreach}
    {else}
    <li style="padding:10px;"><b>No hay notificaciones</b></li>
    {/if}