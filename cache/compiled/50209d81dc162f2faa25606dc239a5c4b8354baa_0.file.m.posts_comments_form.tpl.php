<?php
/* Smarty version 3.1.33, created on 2019-06-29 02:45:06
  from 'D:\xampp\htdocs\assets\templates\modules\m.posts_comments_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d16b492a8fb19_48716481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50209d81dc162f2faa25606dc239a5c4b8354baa' => 
    array (
      0 => 'D:\\xampp\\htdocs\\assets\\templates\\modules\\m.posts_comments_form.tpl',
      1 => 1550101317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/m.global_emoticons.tpl' => 1,
  ),
),false)) {
function content_5d16b492a8fb19_48716481 (Smarty_Internal_Template $_smarty_tpl) {
?>                        	<div id="procesando"><div id="post"></div></div>
                            <div class="answerInfo">
								<img width="48" height="48" src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['url'];?>
/files/avatar/<?php echo $_smarty_tpl->tpl_vars['tsUser']->value->uid;?>
_50.jpg" class="avatar-48"/><br />
                                <div id="gif_cargando" style="text-align:center; margin-top:1em; display:none">
                                	<img src="<?php echo $_smarty_tpl->tpl_vars['tsConfig']->value['images'];?>
/tload.gif" style="border:0;" />
                                </div>
							</div>
							<div class="answerTxt">
                            	<div class="Container">
								<div class="error"></div>
                                <textarea id="body_comm" class="onblur_effect autogrow" tabindex="1" title="Escribir un comentario..." style="resize:none;" onfocus="onfocus_input(this)" onblur="onblur_input(this)">Escribir un comentario...</textarea>
                                <div class="buttons" style="text-align:left">
                                    <div class="floatL">
                                    	<input type="hidden" id="auser_post" value="<?php echo $_smarty_tpl->tpl_vars['tsPost']->value['post_user'];?>
" />
                                        <input type="button" onclick="comentario.nuevo('true')" class="mBtn btnOk" value="Enviar Comentario" tabindex="3" id="btnsComment"/>
                                        &nbsp;<input type="button" onclick="comentario.preview('body_comm','new')" class="mBtn btnGreen" value="Vista Previa" tabindex="2" style="width:auto;" />
                                    </div>
                                    <div class="floatR">
                                        <a href="#" onclick="moreEmoticons(true); return false;" class="floatR" id="moreemofn"> M&aacute;s emoticones</a>
                                    </div>
                                    <?php $_smarty_tpl->_subTemplateRender('file:modules/m.global_emoticons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                    <div class="clearfix"></div>
                                </div>
                                </div>
                            </div><?php }
}
