<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:09:46
  from 'D:\xampp\htdocs\assets\templates\t.php_files\p.live.stream.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169e3ae648b0_24251097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '027735f5ea170d94495a822dc3a6d160dec6f2b0' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\t.php_files\\p.live.stream.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169e3ae648b0_24251097 (Smarty_Internal_Template $_smarty_tpl) {
?>    <div id="live-stream" ntotal="<?php if (!$_smarty_tpl->tpl_vars['tsStream']->value['total']) {?>0<?php } else {
echo $_smarty_tpl->tpl_vars['tsStream']->value['total'];
}?>" mtotal="<?php echo $_smarty_tpl->tpl_vars['tsMensajes']->value['total'];?>
">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsStream']->value['data'], 'noti', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['noti']->value) {
?>
    <div class="UIBeeper_Full" id="beep_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
        <div class="Beeps">
            <div class="UIBeep">
                <a href="<?php echo $_smarty_tpl->tpl_vars['noti']->value['link'];?>
" class="UIBeep_NonIntentional">
                    <div class="UIBeep_Icon action">
                        <span class="monac_icons ma_<?php echo $_smarty_tpl->tpl_vars['noti']->value['style'];?>
"></span>
                    </div>
                    <span class="beeper_x" bid="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">&nbsp;</span>
                    <div class="UIBeep_Title">
                        <span class="blueName"><?php if ($_smarty_tpl->tpl_vars['noti']->value['total'] == 1) {
echo $_smarty_tpl->tpl_vars['noti']->value['user'];
}?></span> <?php echo $_smarty_tpl->tpl_vars['noti']->value['text'];?>
 <span class="blueName"><?php echo $_smarty_tpl->tpl_vars['noti']->value['ltext'];?>
</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsMensajes']->value['data'], 'mp', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['mp']->value) {
?>
    <div class="UIBeeper_Full" id="beep_m<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
        <div class="Beeps">
            <div class="UIBeep">
                <a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/mensajes/leer/<?php echo $_smarty_tpl->tpl_vars['mp']->value['mp_id'];?>
" class="UIBeep_NonIntentional">
                    <div class="UIBeep_Icon">
                        <span class="systemicons mps"></span>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['mp']->value['mp_from'];?>
_50.jpg" width="16" height="16"/>
                    </div>
                    <span class="beeper_x" bid="m<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">&nbsp;</span>
                    <div class="UIBeep_Title">
                        <b>Nuevo mensaje</b><br />                    
                        <span class="blueName"><?php echo $_smarty_tpl->tpl_vars['mp']->value['user_name'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['mp']->value['mp_preview'];?>

                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div><?php }
}
