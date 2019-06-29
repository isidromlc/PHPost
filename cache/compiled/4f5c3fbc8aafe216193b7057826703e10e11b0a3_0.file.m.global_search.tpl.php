<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.global_search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492272fd9_71001001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f5c3fbc8aafe216193b7057826703e10e11b0a3' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.global_search.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d16b492272fd9_71001001 (Smarty_Internal_Template $_smarty_tpl) {
?>                    <form action="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/buscador/" class="buscador-h" name="top_search_box" gid="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['ads_search'];?>
">
                        	<div class="search-in">
                    	    <a onclick="search_set(this, 'google')">Google</a> - <a class="search_active" onclick="search_set(this, 'web')">Posts</a>
                    	</div>
                        <div style="clear:both">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/mini_InputSleft_2.gif" class="mini_leftIbuscador"/>
                            <input type="text" id="ibuscadorq" name="q" onkeypress="ibuscador_intro(event)" onfocus="onfocus_input(this)" onblur="onblur_input(this)" value="Buscar" title="Buscar" class="mini_ibuscador onblur_effect">
                    	    <input vspace="2" hspace="10" type="submit" align="top" value="" alt="Buscar" title="Buscar" class="mini_bbuscador"/>
                        </div>
                        <input type="hidden" name="e" value="web" />
                    </form>
                    <?php }
}
