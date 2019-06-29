{include file='sections/main_header.tpl'}
				<div class="user-suspendido">
                    <h3>Usuario suspendido</h3>
                    <p>Hola, <b>{$tsUser->nick}</b> lamentamos informarte que has sido suspendido de <b>{$tsConfig.titulo}</b></p>
                    <h4>Raz&oacute;n:</h4>
                    <div style="width:500px">{$tsBanned.susp_causa}</div>
                    <h4>Fin de suspensi&oacute;n:</h4>
                    <b>{if $tsBanned.susp_termina == 0}Indefinidamente{elseif $tsBanned.susp_termina == 1}Permanentemente{else}{$tsBanned.susp_termina|date_format:"%d/%m/%Y a las %H:%M:%S"}hs{/if}</b>
                    <h4>Fecha actual:</h4>
                    {$smarty.now|date_format:"%d/%m/%Y %H:%M:%S"}hs.
                </div>
{include file='sections/main_footer.tpl'}
                                    