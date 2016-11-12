                            {if $tsMensajes.data}
                            <ul id="mpList">
                                {foreach from=$tsMensajes.data item=mp}
                                <li id="mp_{$mp.mp_id}" {if $mp.mp_read_to == 0} class="unread"{/if}>
                                    <table class="uiGrid" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="main_col">
                                                <a href="{$tsConfig.url}/mensajes/leer/{$mp.mp_id}">
                                                    <div class="mpContent clearBoth">
                                                        <img src="{$tsConfig.url}/files/avatar/{$mp.mp_from}_50.jpg" />
                                                        <div class="mp_time">{$mp.mp_date|fecha:'d_Ms_a'}</div>
                                                        <div class="mp_desc">
                                                            <div class="autor"><strong>{$mp.user_name}</strong></div>
                                                            <div class="subject">{$mp.mp_subject}</div>
                                                            <div class="preview">{if $mp.mp_type == 1}<i class="return"></i>{/if}{$mp.mp_preview}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="plm">
                                              	<a href="#" class="qtip read" title="Marcar como le&iacute;do" onclick="mensaje.marcar('{$mp.mp_id}:{$mp.mp_type}', 0, 1, this); return false;" {if $mp.mp_read_to == 1}style="display:none"{/if}><i class="read"></i></a>
                                                <a href="#" class="qtip unread" title="Marcar como no le&iacute;do" onclick="mensaje.marcar('{$mp.mp_id}:{$mp.mp_type}', 1, 1, this); return false;" {if $mp.mp_read_to == 0}style="display:none"{/if}><i class="unread"></i></a>
                                            </td>
                                            <td class="pls">
                                                <a href="#" class="qtip" title="Eliminar" onclick="mensaje.eliminar('{$mp.mp_id}:{$mp.mp_type}',1); return false;"><i class="delete"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                {/foreach}
                            </ul>
                            {else}
                            <div class="emptyMensajes">No hay mensajes</div>
                            {/if}
                            <div class="mpFooter">
                                <div class="actions">{if $tsAction == ''}<strong>Ver: </strong> {if $tsQT == ''}<a href="{$tsConfig.url}/mensajes/?qt=unread">No le&iacute;dos</a>{else}<a href="{$tsConfig.url}/mensajes/">Todos los mensajes</a>{/if}{/if}</div>
                                <div class="paginador">
                                    {if $tsMensajes.pages.prev != 0}<div style="text-align:left" class="floatL"><a href="{$tsConfig.url}/mensajes/{if $tsAction}{$tsAction}/{/if}?page={$tsMensajes.pages.prev}{if $tsQT != ''}&qt=unread{/if}">&laquo; Anterior</a></div>{/if}
                                    {if $tsMensajes.pages.next != 0}<div style="text-align:right" class="floatR"><a href="{$tsConfig.url}/mensajes/{if $tsAction}{$tsAction}/{/if}?page={$tsMensajes.pages.next}{if $tsQT != ''}&qt=unread{/if}">Siguiente &raquo;</a></div>{/if}
                                </div>
                                <div class="clearBoth"></div>
                            </div>