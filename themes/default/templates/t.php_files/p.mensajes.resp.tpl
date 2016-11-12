1:
    <li>
        <div class="main clearBoth">
            <a href="{$tsConfig.url}/perfil/{$tsUser->nick}" class="autor-image"><img src="{$tsConfig.url}/files/avatar/{$tsUser->uid}_50.jpg" /></a>
            <div class="mensaje">
                <div class="rbody">
				<div><a href="{$tsConfig.url}/perfil/{$tsUser->nick}" class="autor-name">{$tsUser->nick}</a> {if $tsUser->is_admod}<a href="{$tsConfig.url}/moderacion/buscador/1/1/{$mp.mp_ip}"><span class="mp-date">{$mp.mp_ip}</span></a> <br />{/if} <span class="mp-date">{$mp.mp_date|hace:true}</span></div>
                <div>{$mp.mp_body|nl2br}</div>
				</div>
            </div>
        </div>
    </li>