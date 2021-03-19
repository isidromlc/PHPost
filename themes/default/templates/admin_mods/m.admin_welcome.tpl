<div class="boxy-title">
   <h3>Centro de Administraci&oacute;n</h3>
</div>
<div id="res" class="boxy-content">
   <b>Bienvenido(a), {$tsUser->nick}!</b><br />Este es tu &quot;Centro de Administraci&oacute;n de PHPost&quot;. Aqu&iacute; puedes modificar la configuraci&oacute;n de tu web, modificar usuarios, modificar posts, y muchas otras cosas.<br />Si tienes algun problema, por favor revisa la p&aacute;gina de &quot;Soporte y Cr&eacute;ditos&quot;.  Si esa informaci&oacute;n no te sirve, puedes <a href="http://www.phpost.net/" target="_blank">visitarnos para solicitar ayuda</a> acerca de tu problema.
   <hr class="separator" />
   <div class="phpost">
       <h1>PHPost en directo</h1>
       <ul id="news_pp" class="pp_list">
           <div class="phpostAlfa">Cargando...</div>
       </ul>
   </div>
   <div class="phpost version">
       <h1>PHPost Risus</h1>
       <ul id="version_pp" class="pp_list">
           <li>
               <div class="title">Versi&oacute;n instalada</div>
               <div class="body"><b>{$tsConfig.version}</b></div>
           </li>
       </ul>
       <h1>Administradores</h1>
       <ul class="pp_list">                                    
           {foreach from=$tsAdmins item=admin}
           <li><div class="title"><a href="{$tsConfig.url}/perfil/{$admin.user_name}" class="hovercard" uid="{$admin.user_id}">{$admin.user_name}</a></div></li>                                    
           {/foreach}
       </ul>
           <div class="categoriaList estadisticasList">
	    <h6>Instalaciones</h6>
                   <ul>
	          <li class="clearfix"><span class="floatL">&nbsp; Fundaci&oacute;n</span><span class="floatR number" title="{$tsInst.0|fecha}">{$tsInst.0|hace:true} &nbsp;</span></li>
	          <li class="clearfix"><span class="floatL">&nbsp; Actualizado</span><span class="floatR number" title="{$tsInst.1|fecha}">{$tsInst.1|hace:true} &nbsp;</span></li>
	      </ul>
           </div>                                    
   </div>
   <div class="clearBoth"></div>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
   $.get({
      url: global_data.url + "/feed-support.php",
      dataType: "json",
      success: function(r) {
         $('#news_pp').html('');
         for(var i = 0; i < r.length; i++) {
            status = (r[i].status != '') ? '<i class="d-block" style="font-size:10px">Status: ' + r[i].status + '</i>' : '';
            link = (r[i].link != '#') ? '<a href="'+r[i].link+'" target="_blank" style="float:right">Saber más..</a>' : '';
            $('#news_pp').append(`<li class="mb-2"><div class="fw-bold d-flex justify-content-between"><span>${r[i].title}</span>${link}</div>${status}<small style="display:block;">${r[i].body}</small></li>`);
         }
      }
   });
});
</script>
{/literal}