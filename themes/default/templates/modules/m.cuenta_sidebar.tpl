					<div class="sidebar-tabs clearbeta">
                    	<h3>Mi Avatar</h3>
                        <div class="avatar-big-cont">
                        	<div style="display: none" class="avatar-loading"></div>
                            <img width="120" height="120" alt="" src="{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}_120{else}avatar{/if}.jpg?t={$smarty.now}" class="avatar-big" id="avatar-img"/>
                        </div>
                        <ul class="change-avatar" style="display: none;">
                        	<li class="local-file">
                            	<span><a onclick="avatar.chgtab(this)" id="avatar-local">Local</a></span>
                                <div class="mini-modal" style="display: none;">
									<div class="dialog-m"></div>
									<span>Subir Archivo</span>
									<input type="file" name="file-avatar" id="file-avatar" size="15" class="browse"/><br/>
                                    <button onclick="avatar.upload(this)" class="avatar-next local">Subir</button>
								</div>
                            </li>
                        	<li class="url-file">
                            	<span><a onclick="avatar.chgtab(this)" id="avatar-url">Url</a></span>
                                <div class="mini-modal" style="display: none;">
                                    <div class="dialog-m"></div>
                                {if $tsConfig.c_allow_upload}
									<span>Direcc&oacute;n de la imagen</span>
									<input type="text" name="url-avatar" id="url-avatar" size="45"/><br/>
                                    <button onclick="avatar.upload(this);" class="avatar-next url">Subir</button>
                                {else}
                                    Lo sentimos por el momento solo puedes subir avatares desde tu PC.
                                {/if}
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <a onclick="avatar.edit(this)" class="edit" id="avatar-edit">Editar</a>
                    </div>
                    <div class="clearfix"></div>
                    <h3 style="margin: 25px 0 0; padding: 0" id="porc-completado-label">Perfil completo al {$tsPerfil.porcentaje}%</h3>
                    <div style="margin-top:5px;text-align:center;font-size:13px;margin-bottom:10px;color:#FFF;text-shadow: 0 1px 0px #000" id="porc-completado">
                        <div style="background: #CCC;padding:2px;line-height:17px">
                            <div style="width: {$tsPerfil.porcentaje}%; height:17px;border-right:1px solid #004b8d; border-left: 1px solid #004b8d;background: url('{$tsConfig.images}/barra.gif') top left repeat-x;" id="porc-completado-barra">
                            </div>
                        </div>
                    </div>
                    <div id="prueba"></div>