                        <div class="mpRContent">
                            <div class="mpHeader">
                                <h2>{$tsMensajes.msg.mp_subject}</h2>
                            </div>
                            <div class="mpUser">
                                <span class="info">Entre <a href="{$tsConfig.url}/perfil/{$tsUser->nick}">T&uacute;</a> y <a href="{$tsConfig.url}/perfil/{$tsMensajes.ext.user}">{$tsMensajes.ext.user}</a></span>
                            </div>
                            <ul class="mpHistory" id="historial">
                                {if $tsMensajes.res}{foreach from=$tsMensajes.res item=mp}
                                <li>
                                    <div class="main clearBoth">
                                        <a href="{$tsConfig.url}/perfil/{$mp.user_name}" class="autor-image"><img src="{$tsConfig.url}/files/avatar/{$mp.mr_from}_50.jpg" /></a>
                                        <div class="mensaje">
                                            <div class="rbody">
											<div><a href="{$tsConfig.url}/perfil/{$mp.user_name}" class="autor-name">{$mp.user_name}</a> {if $tsUser->is_admod}<a href="{$tsConfig.url}/moderacion/buscador/1/1/{$mp.mr_ip}"><span class="mp-date">{$mp.mr_ip}</span></a> <br />{/if} <span class="mp-date">{$mp.mr_date|fecha}</span></div>
                                            <div>{$mp.mr_body|nl2br}</div>
											</div>
                                        </div>
                                    </div>
                                </li>
                                {/foreach}{else}
                                <li class="emptyData">No se pudieron cargar los mensajes.</li>
                                {/if}
                            </ul>
                            {if $tsUser->is_admod || ($tsMensajes.msg.mp_del_to == 0 && $tsMensajes.msg.mp_del_from == 0 && $tsMensajes.ext.can_read == 1)}
                                <div class="mpForm">
                                    <div class="form">
                                        <textarea id="respuesta" onfocus="onfocus_input(this)" onblur="onblur_input(this)" title="Escribe una respuesta..." class="autogrow onblur_effect">Escribe una respuesta...</textarea>
                                        <input type="hidden" id="mp_id" value="{$tsMensajes.msg.mp_id}" />
                                        <a class="btn_g resp" onclick="mensaje.responder(); return false;">Responder</a>
                                    </div>
                                </div>
                            {else}
                                <li class="emptyData">Un participante abandon&oacute; la conversaci&oacute;n o no tienes permiso para responder</li>
                            {/if}
                        </div>
                        <div class="mpOptions">
                            <div class="info"><h2>Acciones</h2></div>
                            <ul class="actions-list">
                                <li><a href="#" onclick="mensaje.marcar('{$tsMensajes.msg.mp_id}:{$tsMensajes.msg.mp_type}', 1, 2, this); return false;">Marcar como no le&iacute;do</a></li>
                                <li class="div"></li>
                                <li><a href="#" onclick="mensaje.eliminar('{$tsMensajes.msg.mp_id}:{$tsMensajes.msg.mp_type}',2); return false;">Eliminar</a></li>
                                <li><a href="#" onclick="denuncia.nueva('mensaje',{$tsMensajes.msg.mp_id}, '', ''); return false;">Marcar como correo no deseado...</a></li>
                                <li class="div"></li>
                                <li><a href="#" onclick="denuncia.nueva('usuario',{if $tsMensajes.msg.mp_from != $tsUser->uid}{$tsMensajes.msg.mp_from}{else}{$tsMensajes.msg.mp_to}{/if}, '', '{if $tsMensajes.msg.mp_from != $tsUser->uid}{$tsMensajes.msg.user_name}{else}{$tsUser->getUsername($tsMensajes.msg.mp_to)}{/if}'); return false">Denunciar a este usuario...</a></li>
                                <li><a href="javascript:bloquear({$tsMensajes.ext.uid}, {if $tsMensajes.ext.block}false{else}true{/if}, 'mensajes')" id="bloquear_cambiar">{if $tsMensajes.ext.block}Desbloquear{else}Bloquear{/if} a <u>{$tsMensajes.ext.user}</u>...</a></li>
                                <li class="div"></li>
                                <li><a href="{$tsConfig.url}/mensajes/">&laquo; Volver a mensajes</a></li>
                            </ul>
                        </div>
                        <div class="clearBoth"></div>
