1:
{if $tsHide != 'true'}<div id="perfil_{$tsType}" class="widget" status="activo">{/if}
	<div class="title-w clearfix">
        <h2>{if $tsType == 'seguidores'}Usuarios que siguen a {$tsUsername}{else}Usuarios que {$tsUsername} sigue{/if}</h2>
    </div>
    {if $tsData.data}
    <ul class="listado">
        {foreach from=$tsData.data item=u}
        <li class="clearfix">
        	<div class="listado-content clearfix">
        		<div class="listado-avatar">
        			<a href="{$tsConfig.url}/perfil/{$u.user_name}"><img src="{$tsConfig.url}/files/avatar/{$u.user_id}_50.jpg" width="32" height="32"/></a>
        		</div>
        		<div class="txt">
        			<a href="{$tsConfig.url}/perfil/{$u.user_name}">{$u.user_name}</a><br>
        			<img src="{$tsConfig.images}/flags/{$u.user_pais|lower}.png"/> <span class="grey">{$u.p_mensaje}</span>
        		</div>
        	</div>
        </li>
        {/foreach}
        <li class="listado-paginador clearfix">
    		{if $tsData.pages.prev != 0}<a href="#" onclick="perfil.follows('{$tsType}', {$tsData.pages.prev}); return false;" class="anterior-listado floatL">Anterior</a>{/if}
    		{if $tsData.pages.next != 0}<a href="#" onclick="perfil.follows('{$tsType}', {$tsData.pages.next}); return false;" class="siguiente-listado floatR">Siguiente</a>{/if}
        </li>
    </ul>
    {else}
    <div class="emptyData">{if $tsType == 'seguidores'}No tiene seguidores{else}No sigue usuarios{/if}</div>
    {/if}    
{if $tsHide != 'true'}</div>{/if}