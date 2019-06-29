<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_fotos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc3539af8_08107970',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd99d8adeb9b87b75fad1100ff2f781a3015493d2' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_fotos.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc3539af8_08107970 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),));
?>
                    <?php echo '<script'; ?>
 type="text/javascript">
                        imagenes.total = <?php echo $_smarty_tpl->tpl_vars['tsImTotal']->value-1;?>
;
                        imagenes.move = '-150px';
                    <?php echo '</script'; ?>
>
					<div id="lastFotos" class="wMod clearbeta">
                    	<div class="wMod-h">&Uacute;ltimas Fotos</div>
                        <div class="wMod-data" style="padding:0;text-align:center;position:relative;height:150px;overflow: hidden;">
                            <ul id="imContent" style="position:absolute;top:-150px;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsImages']->value['data'], 'im', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['im']->value) {
?>
                            <li id="img_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/fotos/<?php echo $_smarty_tpl->tpl_vars['im']->value['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['im']->value['foto_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['im']->value['f_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['im']->value['f_caption'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['im']->value['f_url'];?>
" style="min-height:150px; max-height:150px; max-width:200px" align="absmiddle"/>
                                </a>
                            </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        </div>
                    </div><?php }
}
