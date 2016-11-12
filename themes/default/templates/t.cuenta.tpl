{include file='sections/main_header.tpl'}
				
				<script type="text/javascript" src="{$tsConfig.js}/cuenta.js"></script>
                {literal}
				<script type="text/javascript">
                $(document).ready(function(){
                    //document.domain = global_data.domain;
                	// {/literal}
                    avatar.uid = '{$tsUser->uid}';
                    avatar.current = '{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}{else}avatar{/if}.jpg';
                	// {literal}                
                    if (typeof location.href.split('#')[1] != 'undefined') {
                        $('ul.menu-tab > li > a:contains('+location.href.split('#')[1]+')').click();
                    }
                
                });
                </script>
                {/literal}
                <div class="tabbed-d">
                	<div class="floatL">
                        <ul class="menu-tab">
                            <li class="active"><a onclick="cuenta.chgtab(this)">Cuenta</a></li>
                            <li><a onclick="cuenta.chgtab(this)">Perfil</a></li>    
                            <li><a onclick="cuenta.chgtab(this)">Bloqueados</a></li>
                            <li><a onclick="cuenta.chgtab(this)">Cambiar Clave</a></li>
							<li><a onclick="cuenta.chgtab(this)">Cambiar Nick</a></li>
                            <li class="privacy"><a onclick="cuenta.chgtab(this)">Privacidad</a></li>
                        </ul>
                        <a name="alert-cuenta"></a>
                        <form class="horizontal" method="post" action="" name="editarcuenta">
                        	{include file='modules/m.cuenta_cuenta.tpl'}
                            {include file='modules/m.cuenta_perfil.tpl'}
                            {include file='modules/m.cuenta_block.tpl'}
                            {include file='modules/m.cuenta_clave.tpl'}
							{include file='modules/m.cuenta_nick.tpl'}
                            {include file='modules/m.cuenta_config.tpl'}
                        </form>
                    </div>
                    <div class="floatR">
	                    {include file='modules/m.cuenta_sidebar.tpl'}
                    </div>
                </div>
                <div style="clear:both"></div>
                
{include file='sections/main_footer.tpl'}