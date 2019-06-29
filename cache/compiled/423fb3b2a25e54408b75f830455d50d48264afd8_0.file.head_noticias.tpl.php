<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\sections\head_noticias.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc2c50b51_93749352',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '423fb3b2a25e54408b75f830455d50d48264afd8' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\head_noticias.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc2c50b51_93749352 (Smarty_Internal_Template $_smarty_tpl) {
?>            <?php if (($_smarty_tpl->tpl_vars['tsPage']->value == 'home' || $_smarty_tpl->tpl_vars['tsPage']->value == 'portal') && $_smarty_tpl->tpl_vars['tsConfig']->value['news']) {?>
            <div id="mensaje-top">
                <ul id="top_news" class="msgtxt">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsConfig']->value['news'], 'n', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['n']->value) {
?>
                    <li id="new_<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
"><?php echo $_smarty_tpl->tpl_vars['n']->value['not_body'];?>
</li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
            <?php }
}
}
