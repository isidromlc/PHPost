    {if $tsMensajes.data}
    {foreach from=$tsMensajes.data item=mp}
	<li{if $mp.mp_read_to == 0 || $mp.mp_read_mon_to == 0} class="unread"{/if}>
        <a href="{$tsConfig.url}/mensajes/leer/{$mp.mp_id}" title="{$mp.mp_subject}">
            <img src="{$tsConfig.url}/files/avatar/{$mp.mp_from}_50.jpg" alt="{$mp.user_name}"/>
            <div class="content clearfix">
                <div class="subject">{$mp.mp_subject}</div>
                <div class="preview">
                    {$mp.mp_preview}
                </div>
                <div class="time"><span class="autor">{$mp.user_name}</span> | {$mp.mp_date|fecha}</div>
            </div>
        </a>
    </li>
    {/foreach}
    {else}
    <div class="emptyData">No tienes mensajes</div>
    {/if}