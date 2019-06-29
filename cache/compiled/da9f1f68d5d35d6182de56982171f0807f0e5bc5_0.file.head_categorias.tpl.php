<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\sections\head_categorias.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc2bf2603_24026858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da9f1f68d5d35d6182de56982171f0807f0e5bc5' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\head_categorias.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc2bf2603_24026858 (Smarty_Internal_Template $_smarty_tpl) {
?>			<div class="floatR filterCat">
                <span>Filtrar por Categorías:</span>
                <select onchange="ir_a_categoria(this.value)" style="margin:-2px 0 0;">
                    <option selected="selected" value="root">Seleccionar categoría</option>
                    <option value="<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_allow_portal'] == 0) {?>-1<?php } else { ?>-2<?php }?>">Ver Todas</option>
                    <option value="linea">-----</option>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsConfig']->value['categorias'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
	                    <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_seo'];?>
" <?php if ($_smarty_tpl->tpl_vars['tsCategoria']->value == '$c.c_seo') {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_nombre'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
              </div><?php }
}
