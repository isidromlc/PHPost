<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_comments.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492a17830_69059929',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd64de3ac3984d2aef9fdf7b05ffc0ea1404f9aed' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_comments.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/m.posts_comments_form.tpl' => 1,
  ),
),false)) {
function content_5d16b492a17830_69059929 (Smarty_Internal_Template $_smarty_tpl) {
?>					<div id="post-comentarios">
                    	<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->info['user_id'] == $_smarty_tpl->tpl_vars['tsPost']->value['post_user']) {?>
						<div style="float:right; text-align: left; border: 1px solid rgb(211, 98, 98); background: none repeat scroll 0% 0% rgb(255, 255, 204); font-size: 13px; margin-top: 10px; margin-bottom: 10px; padding: 15px; width: 730px; margin-right: 5px;">
        					<span style="float: left; width: 550px; margin-top: 11px;">Si hay usuarios que insultan o generan disturbios en tu post puedes bloquearlos haciendo click sobre la opci&oacute;n desplegable de su avatar.</span>
                            <img alt="Bloquear Usuario" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/bloquear_usuario.png" style="float: right">
                            <div style="clear: both;"></div>
                        </div>
                        <?php }?>
                        <div class="comentarios-title">
                            <h4 class="titulorespuestas floatL"><span id="ncomments"><?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_comments'];?>
</span> Comentarios</h4>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/tload.gif" style="border:0; margin-right:1em; display:none" class="floatR" id="com_gif"/>
                            <div class="clearfix"></div>
                            <hr />
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_comments'] > $_smarty_tpl->tpl_vars['tsConfig']->value['c_max_com']) {?>
                        <div class="comentarios-title">
	                        <div class="paginadorCom"><!--HTML de las páginas--></div>
                        </div><?php }?>
                        <div id="comentarios">
                            <?php echo '<script'; ?>
 type="text/javascript">
                            // 
                            $(document).ready(function(){
                                /*
                                top_cmt = $("#offset_cmts").offset().top;
                                //
                                function check_load(){
                                    if (!comentario.cargado && $(window).scrollTop() + $(window).height() > top_cmt ) {
                                        //  
                                        */
                                        comentario.cargar(<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['post_id'];?>
, 1, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['autor'];?>
);
                                        /*
                                        // 
                                        comentario.cargado = true;
                                    }
                                }
                                $(window).scroll(check_load);
                                check_load();*/
                            });
                            // 
                            <?php echo '</script'; ?>
>
                            <div id="no-comments">Cargando comentarios espera un momento...</div>
                        </div><?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_comments'] > $_smarty_tpl->tpl_vars['tsConfig']->value['c_max_com']) {?>
                        <div class="comentarios-title">
	                        <div class="paginadorCom"><!--HTML de las páginas--></div>
                        </div><?php }?>
      
                        <?php if ($_smarty_tpl->tpl_vars['tsPost']->value['post_block_comments'] == 1 && ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 0 && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocepc'] == false)) {?>
                            <div id="no-comments">El post se encuentra cerrado y no se permiten comentarios.</div>
						<?php } elseif ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod == 0 && $_smarty_tpl->tpl_vars['tsUser']->value->permisos['gopcp'] == false) {?>
                            <div id="no-comments">No tienes permisos para comentar.</div>
						<?php } elseif ($_smarty_tpl->tpl_vars['tsUser']->value->is_member && ($_smarty_tpl->tpl_vars['tsPost']->value['post_block_comments'] != 1 || $_smarty_tpl->tpl_vars['tsPost']->value['post_user'] == $_smarty_tpl->tpl_vars['tsUser']->value->uid || $_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['gopcp']) && $_smarty_tpl->tpl_vars['tsPost']->value['block'] == 0) {?>
                        <div class="miComentario">
		                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.posts_comments_form.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="clearfix"></div><?php }
}
