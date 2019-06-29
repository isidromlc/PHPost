<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\sections\main_footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc36540b0_89425652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b296e424f17dac8eadbb9b2781a0f9436fd47d1c' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\sections\\main_footer.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc36540b0_89425652 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
		<!--end-cuerpo-->
		</div>
        <div id="pie">
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/ayuda/">Ayuda</a> -
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/chat/">Chat</a> -
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/contacto/">Contacto</a> -  
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/protocolo/">Protocolo</a>
        <br/>
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/terminos-y-condiciones/">T&eacute;rminos y condiciones</a> - 
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/privacidad/">Privacidad de datos</a> -
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/pages/dmca/">Report Abuse - DMCA</a>
        </div>
        </div>
        <!--END CONTAINER-->
    </div>
    <div class="rbott"></div>
                <div id="pp_copyright" style="display: block!important; opacity: 1!important;">
        <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
"><strong><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['titulo'];?>
</strong></a> &copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 - Powered by <a href="http://www.phpost.net/" target="_blank"><strong>PHPost</strong></a>
    </div>
</div>
</body>
</html><?php }
}
