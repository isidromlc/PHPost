<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:08
  from 'D:\xampp\htdocs\assets\templates\t.php_files\p.comentario.pages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b4949d5269_78406013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c67a5080fd267c14cd816dd26e71ce6112d2cd4' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.php_files\\p.comentario.pages.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b4949d5269_78406013 (Smarty_Internal_Template $_smarty_tpl) {
?>                                <div class="before floatL">
                                    <a href="#ver-comentarios" <?php if ($_smarty_tpl->tpl_vars['tsPages']->value['prev'] > 0) {?>onclick="comentario.cargar(<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['post_id'];?>
, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['prev'];?>
, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['autor'];?>
);"<?php } else { ?>class="desactivado"<?php }?>><b>&laquo; Anterior</b></a>
                                </div>
                                <div style="float:left;width: 530px">
                                    <ul>
						                <?php
$__section_page_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['tsPages']->value['section']) ? count($_loop) : max(0, (int) $_loop));
$__section_page_0_start = min(1, $__section_page_0_loop);
$__section_page_0_total = min(($__section_page_0_loop - $__section_page_0_start), $__section_page_0_loop);
$_smarty_tpl->tpl_vars['__smarty_section_page'] = new Smarty_Variable(array());
if ($__section_page_0_total !== 0) {
for ($__section_page_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] = $__section_page_0_start; $__section_page_0_iteration <= $__section_page_0_total; $__section_page_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']++){
?>
                                        <li class="numbers"><a href="#ver-comentarios" <?php if ($_smarty_tpl->tpl_vars['tsPages']->value['current'] == (isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null)) {?>class="here"<?php } else { ?>onclick="comentario.cargar(<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['post_id'];?>
, <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null);?>
, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['autor'];?>
);"<?php }?>><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null);?>
</a></li>
                                        <?php
}
}
?>
                                    </ul>
                                  </div>
                                <div class="floatR next">
                                    <a href="#ver-comentarios" <?php if ($_smarty_tpl->tpl_vars['tsPages']->value['next'] <= $_smarty_tpl->tpl_vars['tsPages']->value['pages']) {?>onclick="comentario.cargar(<?php echo $_smarty_tpl->tpl_vars['tsPages']->value['post_id'];?>
, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['next'];?>
, <?php echo $_smarty_tpl->tpl_vars['tsPages']->value['autor'];?>
);"<?php } else { ?>class="desactivado"<?php }?>><b>Siguiente &raquo;</b></a>
                                </div>
                                <div class="clearBoth"></div>
<?php }
}
