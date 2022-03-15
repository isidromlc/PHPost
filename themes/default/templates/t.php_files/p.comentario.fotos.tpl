1: 
<div class="item" id="div_cmnt_{$tsComment.0}">
    <a href="{$tsConfig.url}/perfil/{$tsUser->nick}">
        <img src="{$tsConfig.url}/files/avatar/{$tsUser->info.user_id}_50.jpg" width="50" height="50" class="floatL" />
    </a>
    <div class="firma">
        <div class="options">
            {if $tsComment.3 == $tsUser->uid}
            <a href="#" onclick="fotos.borrar({$tsComment.0}, 'com'); return false" class="floatR" style="margin: 8px 5px">
			  <img title="Borrar Comentario" alt="borrar" src="{$tsConfig.images}/borrar.png"/>
            </a>
            {/if}
        </div>
        <div class="info"><a href="{$tsConfig.url}/fotos/{$tsUser->nick}/">{$tsUser->nick}</a> @ {$tsComment.2|date_format:"%d/%m/%Y"} dijo:</div>
        <div class="clearfix">{$tsComment.1|nl2br}</div>
    </div>
    <div class="clearBoth"></div>
</div>