<?php
/* Smarty version 3.1.33, created on 2019-06-29 01:07:50
  from 'D:\xampp\htdocs\assets\templates\admin_mods\m.mod_sidemenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d169dc6bd4b03_89399943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b100ea98bc00f28b0208e0f856f17932adf8ce6e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\admin_mods\\m.mod_sidemenu.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d169dc6bd4b03_89399943 (Smarty_Internal_Template $_smarty_tpl) {
?>                                    <?php echo '<script'; ?>
 type="text/javascript">
										var action_menu = '<?php echo $_smarty_tpl->tpl_vars['tsAction']->value;?>
';
										// <-- no borrar
										$(function(){
											if(action_menu != '') $('#a_' + action_menu).addClass('active');
											else $('#a_main').addClass('active');
										});
                                        // 
									<?php echo '</script'; ?>
>
                                    <h4>Principal</h4>
                                    <ul class="cat-list">
                                        <li id="a_main"><span class="cat-title"><a href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/">Centro de Moderaci&oacute;n</a></span></li>
                                    </ul>
                                    <h4>Denuncias</h4>
                                    <ul class="cat-list">
                                        <li id="a_posts"><span class="cat-title"><a onclick="$('#a_posts').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/posts">Post <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repposts'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repposts'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repposts'];?>
</span></a></span></li>
                                        <li id="a_fotos"><span class="cat-title"><a onclick="$('#a_fotos').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/fotos">Fotos <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repfotos'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repfotos'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repfotos'];?>
</span></a></span></li>
										<li id="a_mps"><span class="cat-title"><a onclick="$('#a_mps').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/mps">Mensajes  <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repmps'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repmps'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repmps'];?>
</span></a></span></li>
                                        <li id="a_users"><span class="cat-title"><a onclick="$('#a_users').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/users">Usuarios <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repusers'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repusers'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['repusers'];?>
</span></a></span></li>
                                        </ul>
									<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['movub'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moub']) {?>
									<h4>Gesti&oacute;n</h4>
                                    <ul class="cat-list">
										<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['movub']) {?><li id="a_banusers"><span class="cat-title"><a onclick="$('#a_banusers').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/banusers">Usuarios suspendidos <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['supusers'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['suspusers'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['suspusers'];?>
</span></a></span></li><?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['moub']) {?><li id="a_buscador"><span class="cat-title"><a onclick="$('#a_buscador').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/buscador">Buscador de Contenido</a></span></li><?php }?>
									</ul>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morp'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morf']) {?>
									<h4>Papelera de Reciclaje</h4>
                                    <ul class="cat-list">
                                        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morp']) {?><li id="a_pospelera"><span class="cat-title"><a onclick="$('#a_pospelera').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/pospelera">Post eliminados <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['pospelera'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['pospelera'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['pospelera'];?>
</span></a></span></li><?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['morf']) {?><li id="a_fopelera"><span class="cat-title"><a onclick="$('#a_fopelera').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/fopelera">Fotos eliminadas <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['fospelera'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['fospelera'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['fospelera'];?>
</span></a></span></li><?php }?>
									</ul>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocp'] || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocc']) {?>
									<h4>Contenido desaprobado</h4>
                                    <ul class="cat-list">
                                        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocp']) {?><li id="a_revposts"><span class="cat-title"><a onclick="$('#a_revposts').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/revposts">Posts <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revposts'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revposts'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revposts'];?>
</span></a></span></li><?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['tsUser']->value->is_admod || $_smarty_tpl->tpl_vars['tsUser']->value->permisos['mocc']) {?><li id="a_comentarios"><span class="cat-title"><a onclick="$('#a_comentarios').addClass('active');" href="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/moderacion/comentarios">Comentarios <span class="cadGe cadGe_<?php if ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revcomentarios'] > 15) {?>red<?php } elseif ($_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revcomentarios'] > 5) {?>purple<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['novemods']['revcomentarios'];?>
</span></a></span></li><?php }?>
									</ul>
									<?php }
}
}
