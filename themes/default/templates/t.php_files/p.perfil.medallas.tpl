1:
<div id="perfil_medallas" class="widget" status="activo">
	<div class="title-w clearfix">
        <h2>Medallas de {$tsUsername} ({$tsMedallas.total})</h2>
    </div>
    {if $tsMedallas.medallas}
        <ul class="listado">
        {foreach from=$tsMedallas.medallas item=m}
        <li class="clearfix">
        	<div class="listado-content clearfix">
        		<div class="listado-avatar">
        			<img src="{$tsConfig.images}/icons/med/{$m.m_image}_32.png" class="qtip" title="{$m.medal_date|hace:true}" width="32" height="32"/>

        		</div>
        		<div class="txt">
        			<strong>{$m.m_title}</strong><br />
					{$m.m_description}
        		</div>
        	</div>
        </li>
        {/foreach}
    </ul>
        {else}
        <div class="emptyData">No tiene medallas</div>
        {/if}
</div>