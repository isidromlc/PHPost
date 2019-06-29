<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_last_comments.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc30f8633_60371746',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c5649e745b4cc36cd7d2a71f256eec30178b377' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_last_comments.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc30f8633_60371746 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
					<div id="lastCommBox">
                        <div class="box_title">
                            <div class="box_txt estadisticas">&Uacute;ltimos comentarios</div>
                            <div class="box_rss">
                            	<a onclick="actualizar_comentarios('-1','0'); return false;" class="size9" href="#"><span class="systemicons actualizar"></span></a>
                            </div>
                        </div>
                        <div class="box_cuerpo" id="ult_comm" style="padding: 0pt; height: 330px;">
                            <ol id="filterByTodos" class="filterBy cleanlist" style="display:block;">
                            	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsComments']->value, 'c', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['c']->value) {
?>
								<li>
                                    <?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
									<?php if ($_smarty_tpl->tpl_vars['c']->value['post_status'] != 0 || $_smarty_tpl->tpl_vars['c']->value['user_activo'] == 0 || $_smarty_tpl->tpl_vars['c']->value['user_baneado'] || $_smarty_tpl->tpl_vars['c']->value['c_status'] != 0) {?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
/"><strong style="color: <?php if ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 3) {?> #BBB <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 1) {?> purple <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 2) {?> rosyBrown <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['c_status'] == 1) {?> coral<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['user_activo'] == 0) {?> brown <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['user_baneado'] == 1) {?> orange <?php }?>;" class="qtip" title="<?php if ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 3) {?> El post se encuentra en revisi&oacute;n<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 1) {?> El post se encuentra oculto por acumulaci&oacute;n de denuncias <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['post_status'] == 2) {?> El post se encuentra eliminado <?php } elseif ($_smarty_tpl->tpl_vars['c']->value['c_status'] == 1) {?> El comentario est&aacute; oculto<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['user_activo'] == 0) {?>El autor del comentario tiene la cuenta desactivada<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['user_baneado'] == 1) {?>El autor del comentario tiene la cuenta suspendida<?php }?>"><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</strong></a><?php } else { ?><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
/"><strong><?php echo $_smarty_tpl->tpl_vars['c']->value['user_name'];?>
</strong></a> <?php }?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['c']->value['post_title']);?>
.html#comentarios-abajo" class="size10">
                                    <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['c']->value['post_title'],45);?>
</a>
                                </li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                        </div>
                        <br class="space"/>
                    </div><?php }
}
