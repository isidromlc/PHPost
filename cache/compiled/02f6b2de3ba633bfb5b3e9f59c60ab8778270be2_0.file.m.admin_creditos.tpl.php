<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:09:12
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.admin_creditos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169e1893f0d3_74631778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02f6b2de3ba633bfb5b3e9f59c60ab8778270be2' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.admin_creditos.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169e1893f0d3_74631778 (Smarty_Internal_Template $_smarty_tpl) {
?>                                <div class="boxy-title">
                                    <h3>Soporte y Cr&eacute;ditos</h3>
                                </div>
                                <div id="res" class="boxy-content">
                               	  <b>Informaci&oacute;n de versiones:</b><br />
                                	Versi&oacute;n de PHPost: <b>v<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['version'];?>
</b><br />
                                	Versi&oacute;n de PHP: <b><?php echo $_smarty_tpl->tpl_vars['tsVersion']->value['php'];?>
</b><br />
                                	Versi&oacute;n de MySQL: <b><?php echo $_smarty_tpl->tpl_vars['tsVersion']->value['mysql'][0];?>
</b><br />
                                	Versi&oacute;n del Servidor: <b><?php echo $_smarty_tpl->tpl_vars['tsVersion']->value['server'];?>
</b><br />
	                               	Versi&oacute;n de GD: <b><?php echo $_smarty_tpl->tpl_vars['tsVersion']->value['gd'];?>
</b>
                                    <hr class="separator" />
                                    <b>Cr&eacute;ditos:</b><br />
                                    La primera versi&oacute;n del fue desarrollada por <a href="mailto:jneutron@phpost.net">JNeutron</a>. El resto de versiones se mantiene por <a href="mailto:isidro@phpost.net">Isidro</a> y la participaci&oacute;n de los usuarios de la <a href="http://www.phpost.net">comunidad</a>.
                                    <hr class="separator" />
                                    <b>Derechos de autor:</b><br />
                                    Es de vital importancia recordar que el dise&ntilde;o y esquema de <b>PHPost</b> fueron <b>BASADOS</b> en la popular p&aacute;gina <a href="http://www.taringa.net" target="_blank">Taringa!</a>, cuyos cr&eacute;ditos y derechos de autor no pretenden ser adue&ntilde;ados por <a href="http://www.phpost.net">PHPost</a> ni ning&uacute;n desarrollador. Dichos dise&ntilde;os y esquemas han sido adoptados a <b>PHPost</b> con fines meramente <b>EDUCATIVOS</b> y no se pretende <b>LUCRAR</b> con los mismos. Por ello, todas las im&aacute;genes, dise&ntilde;os y logos pertenecen a sus respectivos creadores.<br />
                                </div>
                                    <?php }
}
