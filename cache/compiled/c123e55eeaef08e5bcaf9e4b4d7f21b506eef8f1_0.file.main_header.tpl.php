<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\sections\main_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc27b9fb0_92178006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c123e55eeaef08e5bcaf9e4b4d7f21b506eef8f1' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\main_header.tpl',
      1 => 1561688300,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/m.global_search.tpl' => 1,
    'file:modules/m.global_ads_468.tpl' => 1,
    'file:sections/head_menu.tpl' => 1,
    'file:sections/head_submenu.tpl' => 1,
    'file:sections/head_noticias.tpl' => 1,
  ),
),false)) {
function content_5d169dc27b9fb0_92178006 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['tsTitle']->value;?>
</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/estilo.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/phpost.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/extras.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['css'];?>
/wysibb.css" rel="stylesheet" type="text/css" />

<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod && $_smarty_tpl->tpl_vars['tsConfig']->value['c_see_mod'] && $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total']) {?>
<!-- AGREGAMOS ESTILO DE MODERACIÓN SI HAY CONTENIDO PARA REVISAR -->
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/css/moderacion.css" rel="stylesheet" type="text/css" />
<div id="stickymsg" onmouseover="$('#brandday').css('opacity',0.5);" onmouseout="$('#brandday').css('opacity',1);" onclick="location.href = '<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/'" style="cursor:default;">Hay <?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total'];?>
 contenido<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total'] != 1) {?>s<?php }?> esperando revisi&oacute;n</div>
<?php }?>

<!-- AGREGAMOS UN ESTILO EXTRA SI EXISTE -->
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['css'];?>
/<?php echo $_smarty_tpl->tpl_vars['tsPage']->value;?>
.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/favicon.ico" type="image/x-icon" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<!-- Cargamos libreria jQuery desde Google <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
> -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/jquery.plugins.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/acciones.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/funciones.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/wysibb.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moacp'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['most'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moayca'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mosu'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['modu'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moep'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moop'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moedcopo'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moaydcp'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moecp']) {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/moderacion.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php }
if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_allow_live']) {?>
<link href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['css'];?>
/live.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['js'];?>
/live.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php }
echo '<script'; ?>
 type="text/javascript">
// 
var global_data={
// 
	user_key:'<?php echo $_smarty_tpl->tpl_vars['tsUser']->value->uid;?>
',
	postid:'<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_id'];?>
',
	fotoid:'<?php echo $_smarty_tpl->tpl_vars['tsFoto']->value['foto_id'];?>
',
	img:'<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/',
	url:'<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
',
	domain:'<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['domain'];?>
',
    s_title: '<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
',
    s_slogan: '<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['slogan'];?>
'
// 
};
//  
$(document).ready(function(){
// 
    <?php if ($_smarty_tpl->tpl_vars['tsNots']->value > 0) {?> 
	notifica.popup(<?php echo $_smarty_tpl->tpl_vars['tsNots']->value;?>
);
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['tsMPs']->value > 0 && $_smarty_tpl->tpl_vars['tsAction']->value != 'leer') {?>
    mensaje.popup(<?php echo $_smarty_tpl->tpl_vars['tsMPs']->value;?>
);
    <?php }?>
// 
});
//	
<?php echo '</script'; ?>
>

</head>

<body>
<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 1) {
echo $_smarty_tpl->tpl_vars['tsConfig']->value['install'];
}?>
<!--JAVASCRIPT-->

<div id="loading" style="display:none"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/ajax-loader.gif" alt="Cargando"> Procesando...</div>
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
            	<a id="logoi" title="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
">
                </a>
            </div>
            <div id="banner">
                <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'posts' && $_smarty_tpl->tpl_vars['tsPost']->value['post_id']) {?>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.global_search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.global_ads_468.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php }?>
            </div>
        </div>
        <div id="contenido_principal">
        <?php $_smarty_tpl->_subTemplateRender('file:sections/head_menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_subTemplateRender('file:sections/head_submenu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_subTemplateRender('file:sections/head_noticias.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="cuerpocontainer">
        <!--Cuperpo--><?php }
}
