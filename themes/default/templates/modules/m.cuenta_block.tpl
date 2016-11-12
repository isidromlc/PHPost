							<div class="content-tabs bloqueados" style="display:none">
                            	<fieldset>
                                    <div class="field">
                                        {if $tsBlocks}
                                        <ul class="bloqueadosList">
                                            {foreach from=$tsBlocks item=b}
                                        	<li><a href="{$tsConfig.url}/perfil/{$b.user_name}">{$b.user_name}</a><span><a title="Desbloquear Usuario" href="javascript:bloquear('{$b.b_auser}', false, 'mis_bloqueados')" class="desbloqueadosU bloquear_usuario_{$b.b_auser}">Desbloquear</a></span></li>
                                            {/foreach}
                                         </ul>
                                        {else}
                                        <div class="emptyData">No hay usuarios bloqueados</div>
                                        {/if}
                                     </div>
                                </fieldset>
                                <div class="clearfix"></div>
                            </div>