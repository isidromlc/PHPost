					<div id="topsUserBox">
                        <div class="box_title">
                            <div class="box_txt ultimos_comentarios">TOPs usuarios  <a class="size9" href="{$tsConfig.url}/top/usuarios/">(Ver m&aacute;s)</a></div>
                            <div class="box_rss">
                            	<a href="/rss/usuarios-top-mes"><span class="systemicons sRss"></span></a>
                            </div>
                        </div>
                        <div class="box_cuerpo" style="padding: 0pt; height: 330px;">
                        	<div class="filterBy">
                            	<a href="javascript:TopsTabs('topsUserBox','AyerUser')" id="AyerUser">Ayer</a> -
                                <a href="javascript:TopsTabs('topsUserBox','SemanaUser')" id="SemanaUser">Semana</a> -
                                <a href="javascript:TopsTabs('topsUserBox','MesUser')" id="MesUser"{if $tsTopUsers.mes} class="here"{/if}>Mes</a> -
                                <a href="javascript:TopsTabs('topsUserBox','HistoricoUser')" id="HistoricoUser" {if !$tsTopUsers.mes}class="here"{/if}>Hist&oacute;rico</a>
                            </div>
                            <ol id="filterByAyerUser" class="filterBy cleanlist" style="display:none;">
                            {foreach from=$tsTopUsers.ayer key=i item=u}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/perfil/{$u.user_name}" class="hovercard" uid="{$u.user_id}">{$u.user_name}</a>
                                    <span>{$u.total}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterBySemanaUser" class="filterBy cleanlist" style="display:none;">
                            {foreach from=$tsTopUsers.semana key=i item=u}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/perfil/{$u.user_name}" class="hovercard" uid="{$u.user_id}">{$u.user_name}</a>
                                    <span>{$u.total}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterByMesUser" class="filterBy cleanlist" style="display:{if $tsTopUsers.mes}block{else}none{/if};">
                            {foreach from=$tsTopUsers.mes key=i item=u}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/perfil/{$u.user_name}" class="hovercard" uid="{$u.user_id}">{$u.user_name}</a>
                                    <span>{$u.total}</span>
                                </li>
                            {/foreach}
                            </ol>
                            <ol id="filterByHistoricoUser" class="filterBy cleanlist" style="display:{if !$tsTopUsers.mes}block{else}none{/if};">
                            {foreach from=$tsTopUsers.historico key=i item=u}
								<li>
                                	{if $i+1 < 10}0{/if}{$i+1}.
                                	<a href="{$tsConfig.url}/perfil/{$u.user_name}" class="hovercard" uid="{$u.user_id}">{$u.user_name}</a>
                                    <span>{$u.total}</span>
                                </li>
                            {/foreach}
                            </ol>
                        </div>
                        <br class="space"/>
                    </div>