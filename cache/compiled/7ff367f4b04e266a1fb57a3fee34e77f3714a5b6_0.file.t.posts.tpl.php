<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\t.posts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492163de6_96831204',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ff367f4b04e266a1fb57a3fee34e77f3714a5b6' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.posts.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/main_header.tpl' => 1,
    'file:modules/m.posts_autor.tpl' => 1,
    'file:modules/m.posts_content.tpl' => 1,
    'file:modules/m.posts_related.tpl' => 1,
    'file:modules/m.posts_banner.tpl' => 1,
    'file:modules/m.posts_comments.tpl' => 1,
    'file:sections/main_footer.tpl' => 1,
  ),
),false)) {
function content_5d16b492163de6_96831204 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:sections/main_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				<a name="cielo"></a>
                <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_status'] > 0 || $_smarty_tpl->tpl_vars['tsAutor']->value['user_activo'] != 1) {?>
                    <div class="emptyData">Este post se encuentra <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_status'] == 2) {?>eliminado<?php } elseif ($_smarty_tpl->tpl_vars['tsPost']->value['post_status'] == 1) {?> inactivo por acomulaci&oacute;n de denuncias<?php } elseif ($_smarty_tpl->tpl_vars['tsPost']->value['post_status'] == 3) {?> en revisi&oacute;n<?php } elseif ($_smarty_tpl->tpl_vars['tsPost']->value['post_status'] == 3) {?> en revisi&oacute;n<?php } elseif ($_smarty_tpl->tpl_vars['tsAutor']->value['user_activo'] != 1) {?> oculto porque pertenece a una cuenta desactivada<?php }?>, t&uacute; puedes verlo porque <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 1) {?>eres Administrador<?php } elseif ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 2) {?>eres Moderador<?php } else { ?>tienes permiso<?php }?>.</div><br />
                <?php }?>
				<div class="post-wrapper">
                	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_autor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <div class="floatR" style="width: 766px;">
                    	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_related.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        <?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_banner.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        <div class="clearfix"></div>
                    </div>
                    <a name="comentarios"></a>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <a name="comentarios-abajo"></a>
                    <br />
                   	<?php if (!$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                    <div class="emptyData clearfix">
                    	Para poder comentar necesitas estar <a onclick="registro_load_form(); return false" href="">Registrado.</a> O.. ya tienes usuario? <a onclick="open_login_box('open')" href="#">Logueate!</a>
                    </div>
                    <?php } elseif ($_smarty_tpl->tpl_vars['tsPost']->value['block'] > 0) {?>
                    <div class="emptyData clearfix">
                    	&iquest;Te has portado mal? <?php echo $_smarty_tpl->tpl_vars['tsPost']->value['user_name'];?>
 te ha bloqueado y no podr&aacute;s comentar sus post.
                    </div>
                    <?php }?>
                    <div style="text-align:center"><a class="irCielo" href="#cielo"><strong>Ir al cielo</strong></a></div>
                </div>
                <div style="clear:both"></div>
                
<?php $_smarty_tpl->_subTemplateRender('file:sections/main_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
