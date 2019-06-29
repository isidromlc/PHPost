<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_afiliados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc35ab983_14410908',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8eb396ac9910de567d2595b83c7c07e7b6808e1' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_afiliados.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc35ab983_14410908 (Smarty_Internal_Template $_smarty_tpl) {
?>					<div id="webAffs">
                        <div class="wMod clearbeta">
                            <div class="wMod-h">Afiliados</div>
                            <div class="wMod-data">
                                <ul>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsAfiliados']->value, 'af');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['af']->value) {
?>
                                <li><a href="#" onclick="afiliado.detalles(<?php echo $_smarty_tpl->tpl_vars['af']->value['aid'];?>
); return false;" title="<?php echo $_smarty_tpl->tpl_vars['af']->value['a_titulo'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['af']->value['a_banner'];?>
" width="190" height="40"/>
                                </a></li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            </div>
                            <div class="floatR"><a onclick="afiliado.nuevo(); return false">Afiliate a <?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
</a></div>
                         </div>
                    </div><?php }
}
