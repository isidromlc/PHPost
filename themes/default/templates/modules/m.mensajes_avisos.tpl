                            {if $tsMensajes}
                            <ul id="mpList">
                                {foreach from=$tsMensajes item=av}
                                <li id="av_{$av.av_id}" {if $av.av_read == 0} class="unread"{/if}>
                                    <table class="uiGrid" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="main_col">
                                                <a href="{$tsConfig.url}/mensajes/avisos/?aid={$av.av_id}">
                                                    <div class="mpContent clearBoth">
                                                        <img src="{$tsConfig.images}/icons/avtype_{$av.av_type}.png" style="width:48px;height:48px;margin-top:2px;" />
                                                        <div class="mp_time">{$av.av_date|fecha}</div>
                                                        <div class="mp_desc">
                                                            <div class="autor"><strong>{$tsConfig.titulo}</strong></div>
                                                            <div class="subject">{$av.av_subject}</div>
                                                            <div class="preview">{$av.av_body|truncate:70}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="plm">&nbsp;</td>
                                            <td class="pls">
                                                <a href="{$tsConfig.url}/mensajes/avisos/?did={$av.av_id}" class="qtip" title="Eliminar"><i class="delete"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                {/foreach}
                            </ul>
                            {elseif $tsMensaje.av_id > 0}
                            <div class="mpRContent">
                                <div class="mpHeader">
                                    <h2>{$tsMensaje.av_subject}</h2>
                                </div>
                                <div class="mpUser">
                                    <span class="info"><a href="{$tsConfig.url}">{$tsConfig.titulo}</a> <span class="floatR">{$tsMensaje.av_date|fecha}</span></span>
                                </div>
                                <ul class="mpHistory" id="historial">
                                    <li>
                                        <div class="main clearBoth">
                                            <div class="autor-image"><img src="{$tsConfig.images}/icons/avtype_{$tsMensaje.av_type}.png" /></div>
                                            <div class="mensaje">
                                                <div><a href="{$tsConfig.url}/perfil/{$mp.user_name}" class="autor-name">{$mp.user_name}</a> </div>
                                                <div>{$tsMensaje.av_body|nl2br}</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mpForm">
                                    <div class="form">
                                        <span>&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mpOptions">
                                <div class="info"><h2>Acciones</h2></div>
                                <ul class="actions-list">
                                    <li><a href="{$tsConfig.url}/mensajes/avisos/?did={$tsMensaje.av_id}">Eliminar</a></li>
                                    <li class="div"></li>
                                    <li><a href="{$tsConfig.url}/mensajes/avisos/">&laquo; Volver a avisos</a></li>
                                </ul>
                            </div>
                            <div class="clearBoth"></div>
                            {else}
                            <div class="emptyMensajes">{if $tsMensaje}{$tsMensaje}{else}No hay avisos o alertas{/if}</div>
                            {/if}