<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_last_posts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc2ce9617_71726545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d04a98598f521dfd72a91c0d7f3c388539ca06c' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_last_posts.tpl',
      1 => 1561688472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc2ce9617_71726545 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),2=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                <div class="clearbeta lastPosts">
                    <?php if ($_smarty_tpl->tpl_vars['tsPostsStickys']->value) {?>
                	<div class="header">
                    	<div class="box_txt ultimos_posts">Posts importantes en <?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
</div>
                        <div class="box_rss">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/note.png" />
                        </div>
                        <div class="clearBoth"></div>
                    </div>
                    <div class="body">
                        <ul>
                        	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPostsStickys']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                            <li <?php if ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 3) {?>style="background-color:#f1f1f1;"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 1) {?>style="background-color:coral;"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 2) {?>style="background-color:rosyBrown;"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_activo'] == 0) {?>style="background-color:burlyWood;"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_baneado'] == 1) {?>style="background-color:orange;"<?php }?> class="categoriaPost sticky<?php if ($_smarty_tpl->tpl_vars['p']->value['post_sponsored'] == 1) {?> patrocinado<?php }?>">
                            <a <?php if ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 3) {?>class="qtip" title="El post est&aacute; en revisi&oacute;n"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 1) {?>class="qtip" title="El post se encuentra en revisi&oacute;n por acumulaci&oacute;n de denuncias"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 2) {?>class="qtip" title="El post est&aacute; eliminado"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_activo'] == 0) {?>class="qtip" title="La cuenta del usuario est&aacute; desactivada"<?php }?>  href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html" style="background:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/icons/cat/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat 5px center" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
" target="_self" class="title"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],55);?>
</a>
                            </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                    <?php }?>
                	<div class="header">
                    	<div class="box_txt ultimos_posts">&Uacute;ltimos posts en <?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
</div>
                        <div class="box_rss">
                            <a href="/rss/ultimos-post">
                                <span class="systemicons sRss" style="position:relative;z-index:87"></span>
                            </a>
                        </div>
                        <div class="clearBoth"></div>
                    </div>
                    <div class="body">
                    	<ul>
                            <?php if ($_smarty_tpl->tpl_vars['tsPosts']->value) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsPosts']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                            <li class="categoriaPost" style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/icons/cat/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
); <?php if ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 3) {?> background-color:#f1f1f1; <?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 1) {?>background-color:coral;<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 2) {?> background-color:rosyBrown;<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_activo'] == 0) {?> background-color:burlyWood;<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_baneado'] == 1) {?> background-color:orange;<?php }?>" >
                                <a <?php if ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 3) {?>class="qtip" title="El post est&aacute; en revisi&oacute;n"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 1) {?>class="qtip" title="El post se encuentra en revisi&oacute;n por acumulaci&oacute;n de denuncias"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['post_status'] == 2) {?>class="qtip" title="El post est&aacute; eliminado"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_activo'] == 0) {?>class="qtip" title="La cuenta del usuario est&aacute; desactivada"<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['user_baneado'] == 1) {?>class="qtip" title="La cuenta del usuario est&aacute; suspendida"<?php }?> class="title <?php if ($_smarty_tpl->tpl_vars['p']->value['post_private']) {?>categoria privado<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
" target="_self" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],50);?>
</a>
                                <span><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['p']->value['post_date']);?>
 &raquo; <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_user'];?>
"><strong>@<?php echo $_smarty_tpl->tpl_vars['p']->value['user_name'];?>
</strong></a> &middot; Puntos <strong><?php echo $_smarty_tpl->tpl_vars['p']->value['post_puntos'];?>
</strong> &middot; Comentarios <strong><?php echo $_smarty_tpl->tpl_vars['p']->value['post_comments'];?>
</strong></span>
                                <span class="floatR"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/"><?php echo $_smarty_tpl->tpl_vars['p']->value['c_nombre'];?>
</a></span>
                            </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php } else { ?>
                            <li class="emptyData">No hay posts aqu&iacute;</li>
                            <?php }?>
                        </ul>
                        <br clear="left"/>
                    </div>
                    <div class="footer size13">
                        <?php if ($_smarty_tpl->tpl_vars['tsPages']->value['prev'] > 0 && $_smarty_tpl->tpl_vars['tsPages']->value['max'] == false) {?><a href="pagina<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['prev'];?>
" class="floatL">&laquo; Anterior</a><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['tsPages']->value['next'] <= $_smarty_tpl->tpl_vars['tsPages']->value['pages']) {?><a href="pagina<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['next'];?>
" class="floatR">Siguiente &raquo;</a>
                        <?php } elseif ($_smarty_tpl->tpl_vars['tsPages']->value['max'] == true) {?><a href="pagina2">Siguiente &raquo;</a><?php }?>
                    </div>
                 </div><?php }
}
