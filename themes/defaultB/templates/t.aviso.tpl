{include file='sections/main_header.tpl'}
				
			<div style="margin: 10px auto 0 auto;" class="container400">
                <div class="box_title">
                    <div class="box_txt show_error">{$tsAviso.titulo}</div>
                    <div class="box_rrs"><div class="box_rss"></div></div>
                </div>
				<div align="center" class="box_cuerpo">
				<br />
				{$tsAviso.mensaje}
                <br />
                <br />
                {if $tsAviso.but}
                <input type="button" onclick="location.href='{if $tsAviso.link}{$tsAviso.link}{else}{$tsConfig.url}{/if}'" value="{$tsAviso.but}" style="font-size:13px" class="mBtn btnOk">
				{/if}
                {if $tsAviso.return}
                <input type="button" onclick="history.go(-{$tsAviso.return})" title="Volver" value="Volver" style="font-size:13px" class="mBtn btnOk">
                {/if}
                <br /><br />
				</div>	
			</div>
            <br /><br /><br /><br />
            <div style="clear:both"></div>
                
{include file='sections/main_footer.tpl'}