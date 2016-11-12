{include file='sections/main_header.tpl'}
                <script type="text/javascript" src="{$tsConfig.js}/fotos.js"></script>
				<style>
                
				</style>
                {if $tsAction == ''}
                {include file='modules/m.fotos_home_content.tpl'}
                {include file='modules/m.fotos_home_sidebar.tpl'}
                {elseif $tsAction == 'agregar' || $tsAction == 'editar'}
                {include file='modules/m.fotos_add_form.tpl'}
                {include file='modules/m.fotos_add_sidebar.tpl'}
                {elseif $tsAction == 'ver'}
                {include file='modules/m.fotos_ver_left.tpl'}
                {include file='modules/m.fotos_ver_content.tpl'}
                {include file='modules/m.fotos_ver_right.tpl'}
                {elseif $tsAction == 'album'}
                {include file='modules/m.fotos_album.tpl'}
                {elseif $tsAction == 'favoritas'}
                <div class="emptyData">En construcci&oacute;n</div>
                {/if}
                <div class="clearBoth"></div>
{include file='sections/main_footer.tpl'}