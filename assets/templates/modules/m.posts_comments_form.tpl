                        	<div id="procesando"><div id="post"></div></div>
                            <div class="answerInfo">
								<img width="48" height="48" src="{$tsConfig.url}/files/avatar/{$tsUser->uid}_50.webp" class="avatar-48"/><br />
                                <div id="gif_cargando" style="text-align:center; margin-top:1em; display:none">
                                	<img src="{$tsConfig.images}/tload.gif" style="border:0;" />
                                </div>
							</div>
							<div class="answerTxt">
                            	<div class="Container">
								<div class="error"></div>
                                <textarea id="body_comm" class="onblur_effect autogrow" tabindex="1" title="Escribir un comentario..." style="resize:none;" onfocus="onfocus_input(this)" onblur="onblur_input(this)">Escribir un comentario...</textarea>
                                <div class="buttons" style="text-align:left">
                                    <div class="floatL">
                                    	<input type="hidden" id="auser_post" value="{$tsPost.post_user}" />
                                        <input type="button" onclick="comentario.nuevo('true')" class="mBtn btnOk" value="Enviar Comentario" tabindex="3" id="btnsComment"/>
                                        &nbsp;<input type="button" onclick="comentario.preview('body_comm','new')" class="mBtn btnGreen" value="Vista Previa" tabindex="2" style="width:auto;" />
                                    </div>
                                    <div class="floatR">
                                        <a href="#" onclick="moreEmoticons(true); return false;" class="floatR" id="moreemofn"> M&aacute;s emoticones</a>
                                    </div>
                                    {include file='modules/m.global_emoticons.tpl'}
                                    <div class="clearfix"></div>
                                </div>
                                </div>
                            </div>