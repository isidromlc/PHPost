{if $tsInfo.p_socials != '' || $tsInfo.p_sitio != ''}
   <div class="perfil-redes" style="display: flex;justify-content: space-around;align-items: center;margin-bottom: 10px;">
      {if $tsInfo.p_sitio}
        <a class="sitio" target="_blank" href="{$tsInfo.p_sitio}" title="Mi sitio"><img height="30" width="30" alt="{$name}" src="{$tsConfig.images}/redes/sitio.png"/></a>
      {/if}
      {foreach $tsRedes key=name item=red}
         {if $tsInfo.p_socials.$name !== ''}
            <a class="sitio {$name}" target="_blank" href="https://{$name}.{if $name == 'twitch'}tv{else}com{/if}/{$tsInfo.p_socials.$name}" title="{$red}"><img height="30" width="30" alt="{$name}" src="{$tsConfig.images}/redes/{$name}.png"/></a>
         {/if}
      {/foreach}
   </div>
{/if}
{include "modules/m.global_ads_300.tpl"}
         
<div class="widget w-medallas clearfix">
   <div class="title-w clearfix">
      <h3>Medallas</h3>
      <span>{$tsGeneral.m_total}</span>
   </div>
   {if $tsGeneral.m_total}
      <ul class="clearfix">
         {foreach from=$tsGeneral.medallas item=m}
            <img src="{$tsConfig.images}/icons/med/{$m.m_image}_16.png" class="qtip" title="{$m.m_title} - {$m.m_description}"/>
         {/foreach}
      </ul>
      {if $tsGeneral.m_total >= 21}
         <a href="#medallas" onclick="perfil.load_tab('medallas', $('#medallas'));" class="see-more">Ver m&aacute;s &raquo;</a>
      {/if}
   {else}
      <div class="emptyData">No tiene medallas</div>
   {/if}
</div>
<div class="widget w-seguidores clearfix">
   <div class="title-w clearfix">
      <h3>Seguidores</h3>
      <span>{$tsInfo.stats.user_seguidores}</span>
   </div>
   {if $tsGeneral.segs.data}
      <ul class="clearfix">
         {foreach from=$tsGeneral.segs.data item=s}
            <li>
               <a href="{$tsConfig.url}/perfil/{$s.user_name}" class="hovercard" uid="{$s.user_id}" style="display:inline-block;">
                  <img src="{$tsConfig.url}/files/avatar/{$s.user_id}_50.jpg" width="32" height="32"/>
               </a>
            </li>
         {/foreach}
      </ul>
      {if $tsGeneral.segs.total >= 21}
         <a href="#seguidores" onclick="perfil.load_tab('seguidores', $('#seguidores'));" class="see-more">Ver m&aacute;s &raquo;</a>
      {/if}
   {else}
      <div class="emptyData">No tiene seguidores</div>
   {/if}
</div>
<div class="widget w-siguiendo clearfix">
   <div class="title-w clearfix">
      <h3>Siguiendo</h3>
      <span>{$tsGeneral.sigd.total}</span>
   </div>
   {if $tsGeneral.sigd.data}
      <ul class="clearfix">
         {foreach from=$tsGeneral.sigd.data item=s}
            <li>
               <a href="{$tsConfig.url}/perfil/{$s.user_name}" class="hovercard" uid="{$s.user_id}" style="display:inline-block;">
                  <img src="{$tsConfig.url}/files/avatar/{$s.user_id}_50.jpg" width="32" height="32"/>
               </a>
            </li>
         {/foreach}
      </ul>
      {if $tsGeneral.sigd.total >= 21}
         <a href="#siguiendo" onclick="perfil.load_tab('siguiendo', $('#siguiendo'));" class="see-more">Ver m&aacute;s &raquo;</a>
      {/if}
   {else}
      <div class="emptyData">No sigue usuarios</div>
   {/if}
</div>
{if $tsInfo.can_hits}
   <div class="widget w-visitas clearfix">
      <div class="title-w clearfix">
         <h3>&Uacute;ltimas visitas</h3>
         <span>{$tsInfo.visitas_total}</span>
      </div>
      {if $tsInfo.visitas}
   		<ul class="clearfix">
            {foreach from=$tsInfo.visitas item=v}
   			   <li>
                  <a href="{$tsConfig.url}/perfil/{$v.user_name}" class="hovercard" uid="{$v.user_id}" style="display:inline-block;">
                     <img src="{$tsConfig.url}/files/avatar/{$v.user_id}_50.jpg" class="vctip" title="{$v.date|hace:true}" width="32" height="32"/>
                  </a>
               </li>
            {/foreach}
   		</ul>
      {else}
         <div class="emptyData">No tiene visitas</div>
      {/if}
	</div>
{/if}