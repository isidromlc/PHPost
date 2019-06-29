<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:49
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.admin_welcome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc53712c6_17076018',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1b10ec030558debeee7f034cab1c6e3b7b5f685' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.admin_welcome.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc53712c6_17076018 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.fecha.php','function'=>'smarty_modifier_fecha',),1=>array('file'=>'D:\\xampp\\htdocs\\inc\\smarty\\plugins\\modifier.hace.php','function'=>'smarty_modifier_hace',),));
?>
                                <div class="boxy-title">
                                    <h3>Centro de Administraci&oacute;n</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                	<b>Bienvenido(a), <?php echo $_smarty_tpl->tpl_vars['tsUser']->value->nick;?>
!</b><br />Este es tu &quot;Centro de Administraci&oacute;n de PHPost&quot;. Aqu&iacute; puedes modificar la configuraci&oacute;n de tu web, modificar usuarios, modificar posts, y muchas otras cosas.<br />Si tienes algun problema, por favor revisa la p&aacute;gina de &quot;Soporte y Cr&eacute;ditos&quot;.  Si esa informaci&oacute;n no te sirve, puedes <a href="http://www.phpost.net/" target="_blank">visitarnos para solicitar ayuda</a> acerca de tu problema.
                                    <hr class="separator" />
                                    <div class="phpost">
                                        <h1>PHPost en directo</h1>
                                        <ul id="news_pp" class="pp_list">
                                            <div class="phpostAlfa">Cargando...</div>
                                        </ul>
                                    </div>
                                    <div class="phpost version">
                                        <h1>PHPost Risus</h1>
                                        <ul id="version_pp" class="pp_list">
                                            <li>
                                                <div class="title">Versi&oacute;n instalada</div>
                                                <div class="body"><b><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['version'];?>
</b></div>
                                            </li>
                                        </ul>
                                        <h1>Administradores</h1>
                                        <ul class="pp_list">                                    
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tsAdmins']->value, 'admin');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['admin']->value) {
?>
                                            <li><div class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/perfil/<?php echo $_smarty_tpl->tpl_vars['admin']->value['user_name'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['admin']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['admin']->value['user_name'];?>
</a></div></li>                                    
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                            <div class="categoriaList estadisticasList">
								                <h6>Instalaciones</h6>
                                                    <ul>
											             <li class="clearfix"><span class="floatL">&nbsp; Fundaci&oacute;n</span><span class="floatR number" title="<?php echo smarty_modifier_fecha($_smarty_tpl->tpl_vars['tsInst']->value[0]);?>
"><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['tsInst']->value[0],true);?>
 &nbsp;</span></li>
											             <li class="clearfix"><span class="floatL">&nbsp; Actualizado</span><span class="floatR number" title="<?php echo smarty_modifier_fecha($_smarty_tpl->tpl_vars['tsInst']->value[1]);?>
"><?php echo smarty_modifier_hace($_smarty_tpl->tpl_vars['tsInst']->value[1],true);?>
 &nbsp;</span></li>
									               </ul>
                                            </div>                                    
                                    </div>
                                    <div class="clearBoth"></div>
                                </div>

<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: global_data.url + "/feed-support.php",
        dataType: "json",
        success: function(r) {
            $('#news_pp').html('');
            for(var i = 0; i < r.length; i++){
                //
                var html = '<li>';
                html += '<div class="title"><a href="' + r[i].link + '" target="_blank">' + r[i].title +'</a></div>';
                html += '<div class="body">' + r[i].info +'</div>';
                html += '</li>';
                //
                $('#news_pp').append(html);
            }
    	}
    });
    $.ajax({
        type: "GET",
        url: global_data.url + "/feed-version.php?v=risus",
        dataType: "json",
        success: function(r) {
            for(var i = 0; i < r.length; i++){
                //
                var html = '<li>';
                html += '<div class="title">' + r[i].title +'</div>';
                html += '<div class="body">' + r[i].text +'</div>';
                html += '</li>';
                //
                $('#version_pp').append(html);
            }
    	}
    });
});
<?php echo '</script'; ?>
>
<?php }
}
