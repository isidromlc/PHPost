<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc2f10f47_20481836',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f48c2be068db87fa0643000aecafaf7145f2055' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_search.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc2f10f47_20481836 (Smarty_Internal_Template $_smarty_tpl) {
?>					<div id="search_box" class="new-search posts">
                    	<div class="bar-options">
                        	<ul class="clearfix">
								<li class="web-tab"><a>Google</a></li>
                       			<li class="posts-tab selected"><a>Posts</a></li>
                            </ul>
                        </div>
                        <div class="search-body clearfix">
                            <form action="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/buscador/" name="search" gid="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['ads_search'];?>
">
                                <div class="input-search-left"></div>
                                <input type="text" autocomplete="off" value="Buscar" name="q" class="input-search-middle"/>
                                <input type="hidden" name="e" value="web" />
                                <div class="input-search-right"></div>
                                <a class="btn-search-home" href="javascript:$('form[name=search]').submit()"></a>
                                <label id="search-home-cat-filter" class="more-cats">
                                Categor&iacute;a: <select name="cat">
                                <option value="0">Todas</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsConfig']->value['categorias'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['cid'];?>
" <?php if ($_smarty_tpl->tpl_vars['tsCategoria']->value == '$c.c_seo') {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_nombre'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                     			</label>
                            </form>
                        </div>
                        <a class="options" id="sh_options" onclick="$('#search-home-cat-filter').show(); return false">Opciones</a>
                    </div>
                    <div class="clearBoth"></div><?php }
}
