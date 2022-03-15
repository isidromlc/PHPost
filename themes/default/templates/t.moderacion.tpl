{include file='sections/main_header.tpl'}
<div id="borradores">
	<div class="clearfix">

      <div class="left" style="float:left;width:210px">
         <div class="boxy">
            <div class="boxy-title">
               <h3>Opciones</h3>
               <span></span>
            </div><!-- boxy-title -->
            <div class="boxy-content" id="admin_menu">
					{include file='m.mod_sidemenu.tpl'}
            </div><!-- boxy-content -->
         </div>
         {if $tsAction == 'buscador' && $tsAct == 'search'}
             {include file='m.mod_buscador_stats.tpl'}
         {/if}
      </div>

      <div class="right" style="float:left;margin-left:10px;width:720px">
         <div class="boxy" id="admin_panel">
            {include file="m.$plantilla.tpl"}
         </div>
      </div>
   </div>
</div>
<div style="clear:both"></div>            
{include file='sections/main_footer.tpl'}