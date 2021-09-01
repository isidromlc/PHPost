<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$tsTitle}</title>
<link href="{$tsConfig.tema.t_url}/estilo.css?{$smarty.now}" rel="stylesheet" type="text/css" />
<link href="{$tsConfig.tema.t_url}/phpost.css?{$smarty.now}" rel="stylesheet" type="text/css" />
<link href="{$tsConfig.tema.t_url}/extras.css?{$smarty.now}" rel="stylesheet" type="text/css" />
<link href="{$tsConfig.css}/wysibb.css" rel="stylesheet" type="text/css" />

{if $tsUser->is_admod && $tsConfig.c_see_mod && $tsConfig.novemods.total}
<!-- AGREGAMOS ESTILO DE MODERACIÓN SI HAY CONTENIDO PARA REVISAR -->
<div id="stickymsg" onmouseover="$('#brandday').css('opacity',0.5);" onmouseout="$('#brandday').css('opacity',1);" onclick="location.href = '{$tsConfig.url}/moderacion/'" style="cursor:default;">Hay {$tsConfig.novemods.total} contenido{if $tsConfig.novemods.total != 1}s{/if} esperando revisi&oacute;n</div>
{/if}
<link rel="stylesheet" href="{$tsConfig.css}/{$tsPage}.css">
<link rel="shortcut icon" href="{$tsConfig.images}/favicon.ico" type="image/x-icon" />
<script src="{$tsConfig.js}/jquery.min.js?{$smarty.now}"></script>
<script src="{$tsConfig.js}/jquery.plugins.js?{$smarty.now}"></script>
<script src="{$tsConfig.js}/acciones.js?{$smarty.now}"></script>
<script src="{$tsConfig.js}/wysibb.js"></script>

{if $tsConfig.c_allow_live}
<link href="{$tsConfig.css}/live.css" rel="stylesheet" type="text/css" />
<script src="{$tsConfig.js}/live.js"></script>
{/if}
<script>
// {literal}
var global_data={
// {/literal}
	user_key:'{$tsUser->uid}',
	postid:'{$tsPost.post_id}',
	fotoid:'{$tsFoto.foto_id}',
	img:'{$tsConfig.tema.t_url}/',
	url:'{$tsConfig.url}',
	domain:'{$tsConfig.domain}',
    s_title: '{$tsConfig.titulo}',
    s_slogan: '{$tsConfig.slogan}'
// {literal}
};
// {/literal} {literal}
$(document).ready(function(){
// {/literal}
    {if $tsNots > 0} 
	notifica.popup({$tsNots});
    {/if}
    {if $tsMPs > 0 &&  $tsAction != 'leer'}
    mensaje.popup({$tsMPs});
    {/if}
// {literal}
});
//	{/literal}
</script>

</head>

<body>
{if $tsUser->is_admod == 1}{$tsConfig.install}{/if}
<!--JAVASCRIPT-->

<div id="loading" style="display:none"><img src="{$tsConfig.tema.t_url}/images/ajax-loader.gif" alt="Cargando"> Procesando...</div>
<div id="swf"></div>
<div id="js" style="display:none"></div>
<div id="mask"></div>
<div id="mydialog"></div>
<div class="UIBeeper" id="BeeperBox"></div>
<div id="brandday">
    <div class="rtop"></div>
    <div id="maincontainer">
    	<!--MAIN CONTAINER-->
        <div id="head">
        	<div id="logo">
            	<a id="logoi" title="{$tsConfig.titulo}" href="{$tsConfig.url}">
                	<img border="0" align="top" title="{$tsConfig.titulo}" alt="{$tsConfig.titulo}" src="{$tsConfig.images}/space.gif">
                </a>
            </div>
            <div id="banner">
                {if $tsPage == 'posts' && $tsPost.post_id}
                    {include file='modules/m.global_search.tpl'}
                {else}
                    {include file='modules/m.global_ads_468.tpl'}
                {/if}
            </div>
        </div>
        <div id="contenido_principal">
        {include file='sections/head_menu.tpl'}
        {include file='sections/head_submenu.tpl'}
        {include file='sections/head_noticias.tpl'}
        <div id="cuerpocontainer">
        <!--Cuperpo-->