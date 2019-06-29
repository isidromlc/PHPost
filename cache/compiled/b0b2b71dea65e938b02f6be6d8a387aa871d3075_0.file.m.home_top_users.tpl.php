<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:47
  from 'D:\xampp\htdocs\assets\templates\modules\m.home_top_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc33cb110_44162701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0b2b71dea65e938b02f6be6d8a387aa871d3075' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.home_top_users.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc33cb110_44162701 (Smarty_Internal_Template $_smarty_tpl) {
?>					<div id="topsUserBox">
                        <div class="box_title">
                            <div class="box_txt ultimos_comentarios">TOPs usuarios  <a class="size9" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/top/usuarios/">(Ver m&aacute;s)</a></div>
                            <div class="box_rss">
                            	<a href="/rss/usuarios-top-mes"><span class="systemicons sRss"></span></a>
                            </div>
                        </div>
                        <div class="box_cuerpo" style="padding: 0pt; height: 330px;">
                        	<div class="filterBy">
                            	<a href="javascript:TopsTabs('topsUserBox','AyerUser')" id="AyerUser">Ayer</a> -
                                <a href="javascript:TopsTabs('topsUserBox','SemanaUser')" id="SemanaUser">Semana</a> -
                                <a href="javascript:TopsTabs('topsUserBox','MesUser')" id="MesUser"<?php if ($_smarty_tpl->tpl_vars['tsTopUsers']->value['mes']) {?> class="here"<?php }?>>Mes</a> -
                                <a href="javascript:TopsTabs('topsUserBox','HistoricoUser')" id="HistoricoUser" <?php if (!$_smarty_tpl->tpl_vars['tsTopUsers']->value['mes']) {?>class="here"<?php }?>>Hist&oacute;rico</a>
                            </div>
                            <ol id="filterByAyerUser" class="filterBy cleanlist" style="display:none;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopUsers']->value['ayer'], 'u', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['u']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['u']->value['total'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterBySemanaUser" class="filterBy cleanlist" style="display:none;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopUsers']->value['semana'], 'u', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['u']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['u']->value['total'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterByMesUser" class="filterBy cleanlist" style="display:<?php if ($_smarty_tpl->tpl_vars['tsTopUsers']->value['mes']) {?>block<?php } else { ?>none<?php }?>;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopUsers']->value['mes'], 'u', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['u']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['u']->value['total'];?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ol>
                            <ol id="filterByHistoricoUser" class="filterBy cleanlist" style="display:<?php if (!$_smarty_tpl->tpl_vars['tsTopUsers']->value['mes']) {?>block<?php } else { ?>none<?php }?>;">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsTopUsers']->value['historico'], 'u', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['u']->value) {
?>
								<li>
                                	<?php if ($_smarty_tpl->tpl_vars['i']->value+1 < 10) {?>0<?php }
echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['user_name'];?>
</a>
                                    <span><?php echo $_smarty_tpl->tpl_vars['u']->value['total'];?>
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
