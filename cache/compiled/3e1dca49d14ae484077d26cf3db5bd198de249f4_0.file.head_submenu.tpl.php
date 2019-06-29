<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\sections\head_submenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc2ab88c3_94565749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e1dca49d14ae484077d26cf3db5bd198de249f4' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\head_submenu.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/head_categorias.tpl' => 1,
  ),
),false)) {
function content_5d169dc2ab88c3_94565749 (Smarty_Internal_Template $_smarty_tpl) {
?>		<div class="subMenuContent">
        	<div id="subMenuPosts" class="subMenu <?php if ($_smarty_tpl->tpl_vars['tsPage']->value != 'tops') {?>here<?php }?>">
                <ul class="floatL tabsMenu">
                    <li<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'home' || $_smarty_tpl->tpl_vars['tsPage']->value == 'portal') {?> class="here"<?php }?>><a class=vctip  title="Inicio" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'home' || $_smarty_tpl->tpl_vars['tsPage']->value == 'posts') {?>posts/<?php }?>">Inicio</a></li>
                    <li<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'buscador') {?> class="here"<?php }?>><a class=vctip title="Buscador" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/buscador/">Buscador</a></li>
                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['gopp']) {?><li<?php if ($_smarty_tpl->tpl_vars['tsSubmenu']->value == 'agregar') {?> class="here"<?php }?>><a class=vctip title="Agregar Post" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/agregar/">Agregar Post</a></li><?php }?>
                    <li class="<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'mod-history') {?>here<?php }?>"><a class=vctip title="Historial de Moderaci&oacute;n" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mod-history/">Historial</a></li>
        	            <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moacp']) {?>
                    <li class="<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'moderacion') {?>here<?php }?>"><a class=vctip title="Panel de Moderador" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/">Moderaci&oacute;n <?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_see_mod'] && $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total']) {?><span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total'] < 10) {?>green<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total'] < 30) {?>purple<?php } else { ?>red<?php }?>" style="position:relative;"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['total'];?>
</span><?php }?></a></li>
                    	<?php }?>
                    <?php }?>
                    <div class="clearBoth"></div>
                </ul>
                <?php $_smarty_tpl->_subTemplateRender('file:sections/head_categorias.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <div class="clearBoth"></div>
            </div>
            <div id="subMenuFotos" class="subMenu <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'fotos') {?>here<?php }?>">
                <ul class="floatL tabsMenu">
                    <li<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == '' && $_smarty_tpl->tpl_vars['tsAction']->value != 'agregar' && $_smarty_tpl->tpl_vars['tsAction']->value != 'album' && $_smarty_tpl->tpl_vars['tsAction']->value != 'favoritas' || $_smarty_tpl->tpl_vars['tsAction']->value == 'ver') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/">Inicio</a></li>
                    <?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'album' && $_smarty_tpl->tpl_vars['tsFUser']->value[0] != $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?><li class="here"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['tsFUser']->value[1];?>
">&Aacute;lbum de <?php echo $_smarty_tpl->tpl_vars['tsFUser']->value[1];?>
</a></li><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['gopf']) {?><li<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'agregar') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/agregar.php">Agregar Foto</a></li><?php }?>
                    <li<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'album' && $_smarty_tpl->tpl_vars['tsFUser']->value[0] == $_smarty_tpl->tpl_vars['tsUser']->value->uid) {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['tsUser']->value->nick;?>
">Mis Fotos</a></li>
                </ul>
                <div class="clearBoth"></div>
            </div>
            <div id="subMenuTops" class="subMenu <?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'tops') {?>here<?php }?>">
                <ul class="floatL tabsMenu">
                    <li<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'posts') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/top/posts/">Posts</a></li>
                    <li<?php if ($_smarty_tpl->tpl_vars['tsAction']->value == 'usuarios') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/top/usuarios/">Usuarios</a></li>
                </ul>
                <div class="clearBoth"></div>
            </div>
        </div><?php }
}
