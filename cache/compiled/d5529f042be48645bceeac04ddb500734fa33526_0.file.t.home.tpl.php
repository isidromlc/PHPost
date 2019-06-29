<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:46
  from 'D:\xampp\htdocs\assets\templates\t.home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc272b9f1_98611548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5529f042be48645bceeac04ddb500734fa33526' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.home.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/main_header.tpl' => 1,
    'file:modules/m.home_last_posts.tpl' => 1,
    'file:modules/m.home_search.tpl' => 1,
    'file:modules/m.home_stats.tpl' => 1,
    'file:modules/m.home_last_comments.tpl' => 1,
    'file:modules/m.home_top_posts.tpl' => 1,
    'file:modules/m.home_top_users.tpl' => 1,
    'file:modules/m.home_fotos.tpl' => 1,
    'file:modules/m.home_afiliados.tpl' => 1,
    'file:modules/m.global_ads_160.tpl' => 1,
    'file:sections/main_footer.tpl' => 1,
  ),
),false)) {
function content_5d169dc272b9f1_98611548 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:sections/main_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo $_smarty_tpl->tpl_vars['tsInstall']->value;?>

                <div id="izquierda">
					<?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_last_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                </div>
                <div id="centro">
                	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_last_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_top_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                	<?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_top_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <!--Poner aqui mas modulos-->
                </div>
                <div id="derecha">
				  <?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['c_fotos_private'] == 1 && !$_smarty_tpl->tpl_vars['tsUser']->value->is_member) {?>
                   <?php } else { ?>
				    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_fotos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				  <?php }?>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.home_afiliados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <br class="spacer"/>
                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.global_ads_160.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                </div>
                <div style="clear:both"></div>

<?php $_smarty_tpl->_subTemplateRender('file:sections/main_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
