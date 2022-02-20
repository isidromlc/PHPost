{include file='sections/main_header.tpl'}
<script src="{$tsConfig.js}/cuenta.js"></script>
<script>
   $(document).ready(() => {
      avatar.uid = '{$tsUser->uid}';
      avatar.current = '{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}{else}avatar{/if}.jpg';
   });
</script>
<div class="tabbed-d">
   <div class="floatL">
      <div id="alerta_guarda"></div>
      <ul class="menu-tab">
         <li{if $tsAccion == ''} class="active"{/if}><a href="{$tsConfig.url}/cuenta/">Cuenta</a></li>
         <li{if $tsAccion == 'perfil'} class="active"{/if}><a href="{$tsConfig.url}/cuenta/perfil">Perfil</a></li>    
         <li{if $tsAccion == 'block'} class="active"{/if}><a href="{$tsConfig.url}/cuenta/block">Bloqueados</a></li>
         <li{if $tsAccion == 'clave'} class="active"{/if}><a href="{$tsConfig.url}/cuenta/clave">Cambiar Clave</a></li>
         <li{if $tsAccion == 'nick'} class="active"{/if}><a href="{$tsConfig.url}/cuenta/nick">Cambiar Nick</a></li>
         <li{if $tsAccion == 'config'} class="active"{/if}><a href="{$tsConfig.url}/cuenta/config">Privacidad</a></li>
      </ul>
      <a name="alert-cuenta"></a>
      <form class="horizontal" method="post" name="editarcuenta">
         <input type="hidden" name="pagina" value="{$tsAccion}">
         {include file="modules/m.cuenta_$tsAccion.tpl"}
      </form>
   </div>
   <div class="floatR">
	   {include file='modules/m.cuenta_sidebar.tpl'}
   </div>
</div>
<div style="clear:both"></div>           
{include file='sections/main_footer.tpl'}