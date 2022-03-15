<div class="sidebar-tabs clearbeta">
   <h3>Mi Avatar</h3>
   <div class="avatar-big-cont">
      <div style="display: none" class="avatar-loading"></div>
      <img width="120" height="120" alt="" src="{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}_120{else}avatar{/if}.jpg?t={$smarty.now}" class="avatar-big" id="avatar-img"/>
   </div>
   <ul class="change-avatar" id="change">
      <li class="local-file" id="pc" style="width: 50%;text-align:center;"><span>Local</span></li>
      <li class="url-file" id="url" style="width: 50%;text-align:center;"><span>Url</span></li>
   </ul>
   <div class="clearfix"></div>
   <a href="javascript:avatar.subir()" class="avatar-next edit" >Editar</a>
</div>
<div class="clearfix"></div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/croppr@2.3.1/dist/croppr.min.css" integrity="sha256-Bbkel8+0sOmrvX75oDwNElgbmrAP+Pw+XXKKUwoKiVE=" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/croppr@2.3.1/dist/croppr.min.js" integrity="sha256-VPADQYvd0gjLaeduvmP9/UZAdNW3D2sJieeJ3a3PX64=" crossorigin="anonymous"></script>

<script src="{$tsConfig.js}/subir-avatar.js?{$smarty.now}"></script>