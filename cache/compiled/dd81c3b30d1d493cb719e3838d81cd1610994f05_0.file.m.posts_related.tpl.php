<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_related.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492975492_56136377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd81c3b30d1d493cb719e3838d81cd1610994f05' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_related.tpl',
      1 => 1561688459,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b492975492_56136377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),));
?>
                		<div class="post-relacionados">
    	                	<h4>Otros posts que te van a interesar:</h4>
                            <ul>
                            	<?php if ($_smarty_tpl->tpl_vars['tsRelated']->value) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsRelated']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                            	<li class="categoriaPost" style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['tema'];?>
/images/icons/cat/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
)">
									<a class="<?php if ($_smarty_tpl->tpl_vars['p']->value['post_private']) {?>categoria privado<?php }?>"title="<?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html" rel="dc:relation"><?php echo $_smarty_tpl->tpl_vars['p']->value['post_title'];?>
</a>
								</li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php } else { ?>
                                <li>No se encontraron posts relacionados.</li>
                                <?php }?>
                            </ul>
	                    </div><?php }
}
