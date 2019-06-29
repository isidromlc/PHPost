<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:09:10
  from 'D:\xampp\htdocs\assets\templates\t.php_files\p.live.vcard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169e16740879_47896304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7a38b1f340f144746081a0be39cc1e6332f6689' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.php_files\\p.live.vcard.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169e16740879_47896304 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="hovercard-inner">
    <div class="bd">
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_name'];?>
" class="profile-pic"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
_50.jpg" class="avatar" /></a>
        <div class="bio">
            <p class="fn-above" style="color:#<?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['r_color'];?>
"><?php if ($_smarty_tpl->tpl_vars['tsData']->value['p_nombre']) {
echo $_smarty_tpl->tpl_vars['tsData']->value['p_nombre'];
} else {
echo $_smarty_tpl->tpl_vars['tsData']->value['user_name'];
}?></p>
            <p class="sn"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_name'];?>
">@<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_name'];?>
</a></p>
            <p class="location">
                <img title="<?php echo $_smarty_tpl->tpl_vars['tsData']->value['status']['t'];?>
" class="status <?php echo $_smarty_tpl->tpl_vars['tsData']->value['status']['css'];?>
 vctip" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/space.gif"/>
                <img title="<?php if ($_smarty_tpl->tpl_vars['tsData']->value['user_sexo'] == 1) {?>Hombre<?php } else { ?>Mujer<?php }?>" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/<?php if ($_smarty_tpl->tpl_vars['tsData']->value['user_sexo'] == 0) {?>fe<?php }?>male.png" class="vctip"/>
                <img title="" style="padding:2px" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/flags/<?php echo mb_strtolower($_smarty_tpl->tpl_vars['tsData']->value['user_pais'], 'UTF-8');?>
.png" class="vctip"/>
                <img title="<?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['r_name'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/ran/<?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['r_image'];?>
" class="vctip"/>
                <?php if ($_smarty_tpl->tpl_vars['tsData']->value['p_sitio']) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsData']->value['p_sitio'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/www.png" title="Sitio web" class="vctip"/></a><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->uid != $_smarty_tpl->tpl_vars['tsData']->value['user_id'] && $_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?><a onclick="mensaje.nuevo('<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_name'];?>
','','','');return false" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icon-mensajes-recibidos.gif" title="Enviar mensaje privado" class="vctip"/></a><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 1) {?><img title="Administrar" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/editar.png" style="width:14px;height:14px;cursor:pointer;" class="vctip" onclick="location.href = '<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/admin/users?act=show&amp;uid=<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
'"/><?php }?>
			</p>
        </div>
        <div class="description">
            <div class="description-inner" style="border-top:1px dashed #DDD">
                <?php if ($_smarty_tpl->tpl_vars['tsData']->value['p_mensaje']) {?><p><strong>Mensaje:</strong> <?php echo $_smarty_tpl->tpl_vars['tsData']->value['p_mensaje'];?>
</p><div style="border-top:1px dashed #DDD;line-height:1px">&nbsp;</div><?php }?>
                <strong>Estad&iacute;sticas:</strong>
                <ul class="user_stats">
                    <li class="first">
                        <span class="stat"><?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['user_puntos'];?>
</span>
                        <span class="type">Puntos</span>
                    </li>
                    <li>
                        <span class="stat"><?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['user_posts'];?>
</span>
                        <span class="type">Posts</span>
                    </li>
                    <li>
                        <span class="stat"><?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['user_comentarios'];?>
</span>
                        <span class="type">Comentarios</span>
                    </li>
                    <li class="last">
                        <span class="stat mft_<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['tsData']->value['stats']['user_seguidores'];?>
</span>
                        <span class="type">Seguidores</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="follow-controls">
        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->uid != $_smarty_tpl->tpl_vars['tsData']->value['user_id'] && $_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
            <a class="btn_g mf_<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
" onclick="notifica.unfollow('user', <?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
, notifica.userInMencionHandle, $(this).children('span'))" <?php if ($_smarty_tpl->tpl_vars['tsData']->value['follow'] == 0) {?>style="display: none;"<?php }?>><span class="icons unfollow">Dejar de seguir</span></a>
            <a class="btn_g mf_<?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
" onclick="notifica.follow('user', <?php echo $_smarty_tpl->tpl_vars['tsData']->value['user_id'];?>
, notifica.userInMencionHandle, $(this).children('span'))" <?php if ($_smarty_tpl->tpl_vars['tsData']->value['follow'] == 1) {?>style="display: none;"<?php }?>><span class="icons follow">Seguir Usuario</span></a>
        <?php }?>
        </div>
    </div>
</div><?php }
}
