<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_top_posts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc32359d9_51289447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae9550a6e69e3bdc122c06b19a645a34761a211d' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_top_posts.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc32359d9_51289447 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.seo.php','function'=>'smarty_modifier_seo',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
					<div id="topsPostBox">
                        <div class="box_title">
                            <div class="box_txt estadisticas">TOPs posts <a class="size9" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/top/">(Ver m&aacute;s)</a></div>
                            <div class="box_rss">
                            	<a href="/rss/top-post-semana"><span class="systemicons sRss"></span></a>
                            </div>
                        </div>
                        <div class="box_cuerpo" style="padding: 0pt; height: 330px;">
                        	<div class="filterBy">
                            	<a href="javascript:TopsTabs('topsPostBox','Ayer')" id="Ayer">Ayer</a> -
                            	<a href="javascript:TopsTabs('topsPostBox','Semana')" id="Semana"<?php if ($_smarty_tpl->tpl_vars['tsTopPosts']->value['semana']) {?> class="here"<?php }?>>Semana</a> -
                                <a href="javascript:TopsTabs('topsPostBox','Mes')" id="Mes">Mes</a> -
                                <a href="javascript:TopsTabs('topsPostBox','Historico')" id="Historico"<?php if (!$_smarty_tpl->tpl_vars['tsTopPosts']->value['semana']) {?> class="here"<?php }?>>Hist&oacute;rico</a>
                            </div>
                            <ol id="filterByAyer" class="filterBy cleanlist" style="display:none;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopPosts']->value['ayer'], 'p', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['p']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],45);?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['p']->value['post_puntos'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterBySemana" class="filterBy cleanlist" style="display:<?php if ($_smarty_tpl->tpl_vars['tsTopPosts']->value['semana']) {?>block<?php } else { ?>none<?php }?>;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopPosts']->value['semana'], 'p', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['p']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],45);?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['p']->value['post_puntos'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterByMes" class="filterBy cleanlist" style="display:none;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopPosts']->value['mes'], 'p', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['p']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],45);?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['p']->value['post_puntos'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterByHistorico" class="filterBy cleanlist" style="display:<?php if (!$_smarty_tpl->tpl_vars['tsTopPosts']->value['semana']) {?>block<?php } else { ?>none<?php }?>;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopPosts']->value['historico'], 'p', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['p']->value) {
?>
								<li>
	                                <?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['post_id'];?>
/<?php echo smarty_modifier_seo($_smarty_tpl->tpl_vars['p']->value['post_title']);?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['post_title'],45);?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['p']->value['post_puntos'];?>
</span>
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
