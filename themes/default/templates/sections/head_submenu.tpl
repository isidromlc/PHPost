		<div class="subMenuContent">
        	<div id="subMenuPosts" class="subMenu {if $tsPage != 'tops'}here{/if}">
                <ul class="floatL tabsMenu">
                    <li{if $tsPage == 'home' || $tsPage == 'portal'} class="here"{/if}><a class=vctip  title="Inicio" href="{$tsConfig.url}/{if $tsPage == 'home' || $tsPage == 'posts'}posts/{/if}">Inicio</a></li>
                    <li{if $tsPage == 'buscador'} class="here"{/if}><a class=vctip title="Buscador" href="{$tsConfig.url}/buscador/">Buscador</a></li>
                    {if $tsUser->is_member}
                    {if $tsUser->is_admod || $tsUser->permisos.gopp}<li{if $tsSubmenu == 'agregar'} class="here"{/if}><a class=vctip title="Agregar Post" href="{$tsConfig.url}/agregar/">Agregar Post</a></li>{/if}
                    <li class="{if $tsPage == 'mod-history'}here{/if}"><a class=vctip title="Historial de Moderaci&oacute;n" href="{$tsConfig.url}/mod-history/">Historial</a></li>
        	            {if $tsUser->is_admod || $tsUser->permisos.moacp}
                    <li class="{if $tsPage == 'moderacion'}here{/if}"><a class=vctip title="Panel de Moderador" href="{$tsConfig.url}/moderacion/">Moderaci&oacute;n {if $tsConfig.c_see_mod && $tsConfig.novemods.total}<span class="cadGe cadGe_{if $tsConfig.novemods.total < 10}green{elseif $tsConfig.novemods.total < 30}purple{else}red{/if}" style="position:relative;">{$tsConfig.novemods.total}</span>{/if}</a></li>
                    	{/if}
                    {/if}
                    <div class="clearBoth"></div>
                </ul>
                {include file='sections/head_categorias.tpl'}
                <div class="clearBoth"></div>
            </div>
            <div id="subMenuFotos" class="subMenu {if $tsPage == 'fotos'}here{/if}">
                <ul class="floatL tabsMenu">
                    <li{if $tsAction == '' && $tsAction != 'agregar' && $tsAction != 'album' && $tsAction != 'favoritas' || $tsAction == 'ver'} class="here"{/if}><a href="{$tsConfig.url}/fotos/">Inicio</a></li>
                    {if $tsAction == 'album' && $tsFUser.0 != $tsUser->uid}<li class="here"><a href="{$tsConfig.url}/fotos/{$tsFUser.1}">&Aacute;lbum de {$tsFUser.1}</a></li>{/if}
                    {if $tsUser->is_admod || $tsUser->permisos.gopf}<li{if $tsAction == 'agregar'} class="here"{/if}><a href="{$tsConfig.url}/fotos/agregar.php">Agregar Foto</a></li>{/if}
                    <li{if $tsAction == 'album' && $tsFUser.0 == $tsUser->uid} class="here"{/if}><a href="{$tsConfig.url}/fotos/{$tsUser->nick}">Mis Fotos</a></li>
                </ul>
                <div class="clearBoth"></div>
            </div>
            <div id="subMenuTops" class="subMenu {if $tsPage == 'tops'}here{/if}">
                <ul class="floatL tabsMenu">
                    <li{if $tsAction == 'posts'} class="here"{/if}><a href="{$tsConfig.url}/top/posts/">Posts</a></li>
                    <li{if $tsAction == 'usuarios'} class="here"{/if}><a href="{$tsConfig.url}/top/usuarios/">Usuarios</a></li>
                </ul>
                <div class="clearBoth"></div>
            </div>
        </div>