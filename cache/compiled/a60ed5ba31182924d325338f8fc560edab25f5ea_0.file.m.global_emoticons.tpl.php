<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.global_emoticons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492adca33_30403193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a60ed5ba31182924d325338f8fc560edab25f5ea' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.global_emoticons.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b492adca33_30403193 (Smarty_Internal_Template $_smarty_tpl) {
?>				               
                                <style>
                                    #emoticons span{
                                        float:left;
                                    }
                                </style>
                                
								<div style="float:<?php if ($_smarty_tpl->tpl_vars['tsPage']->value == 'posts') {?>right<?php } else { ?>left<?php }?>" id="emoticons">
									<a smile=":)" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/001.png"/></a>
                                    <a smile=":D" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/002.png"/></a>
									<a smile=";)" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/003.gif"/></a>
                                    <a smile=":O" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/004.png"/></a>
                                    <a smile="(H)" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/006.png"/></a>
                                    <a smile=":P" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/104.png"/></a>
                                    <a smile="8o|" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/049.png"/></a>
                                    <a smile=":S" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/009.png"/></a>
                                    <a smile=":$" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/008.png"/></a>
                                    <a smile=":(" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/010.png"/></a>
                                    <a smile=":'(" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/011.gif"/></a>
                                    <a smile=":|" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/012.png"/></a>
                                    <a smile="(6)" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/013.png"/></a>
                                    <a smile="8-|" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/050.png"/></a>
                                    <a smile=":-/" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/083.png"/></a>
									<a smile="^o)" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/smiles/051.png"/></span></a>
								</div>
                                <?php if ($_smarty_tpl->tpl_vars['tsPage']->value != 'posts') {?><a href="#" onclick="moreEmoticons(); return false;" class="floatR" id="moreemofn">M&aacute;s emoticones</a><?php }?>
                                <div class="clearBoth">&nbsp;</div><?php }
}
