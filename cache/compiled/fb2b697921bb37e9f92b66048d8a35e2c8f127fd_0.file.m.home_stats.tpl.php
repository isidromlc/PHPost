<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_stats.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc30311f9_83334976',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb2b697921bb37e9f92b66048d8a35e2c8f127fd' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_stats.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc30311f9_83334976 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.fecha.php','function'=>'smarty_modifier_fecha',),));
?>
					<div id="webStats">
                        <div class="wMod clearbeta">
                            <div class="wMod-h"><span class="qtip" title="Actualizado: <?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['tsStats']->value['stats_time']);?>
">Estad&iacute;sticas</span></div>
                            <div class="box_cuerpo">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                	<td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/power_on.png);"><a class="usuarios_online" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/usuarios/?online=true"><span class="qtip" title="R&eacute;cord conectados: <?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_max_online'];?>
 <?php echo smarty_modifier_fecha($_smarty_tpl->tpl_vars['tsStats']->value['stats_max_time']);?>
"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_online'];?>
 online</span></a></td>
        	                        <td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/user.png);"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/usuarios/"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_miembros'];?>
 miembros</a></td>
                                </tr>
    	                        <tr>
        	                        <td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/posts.png);"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_posts'];?>
 posts</td>
            	                    <td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/comment.png);"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_comments'];?>
 comentarios</td>
                                </tr>
    	                        <tr>
        	                        <td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/foto.png);"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_fotos'];?>
 fotos</td>
            	                    <td style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['default'];?>
/images/icons/comment.png);"><?php echo $_smarty_tpl->tpl_vars['tsStats']->value['stats_foto_comments'];?>
 comentarios en fotos</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div><?php }
}
