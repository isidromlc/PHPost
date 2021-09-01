					<div id="user_box" class="post-autor vcard">
                    	<div class="avatarBox" style="margin-bottom:0">
                            <a href="{$tsConfig.url}/perfil/{$tsUser->nick}">
                                <img title="Ver tu perfil" class="avatar" src="{$tsConfig.url}/files/avatar/{$tsUser->uid}_120.jpg"/>
                            </a>
						</div>
                        <a href="{$tsConfig.url}/perfil/{$tsUser->nick}" style="text-decoration:none">
							<span class="given-name" style="color:#{$tsUser->info.rango.r_color}">{$tsUser->nick}</span>
						</a>
                        <hr class="divider"/>
                        <div class="tools">
                            <a href="{$tsConfig.url}/monitor/" class="systemicons monitor">Notificaciones (<b>{$tsNots}</b>)</a>
                            <a href="{$tsConfig.url}/mensajes/" class="systemicons mps">Mensajes nuevos (<b>{$tsMPs}</b>)</a>
                            <hr class="divider"/>
                            <a href="{$tsConfig.url}/agregar/" style="background:url({$tsConfig.default}/images/icons/posts.png) no-repeat left center;">Agregar post</a>
                            <a href="{$tsConfig.url}/fotos/agregar.php" style="background:url({$tsConfig.default}/images/icons/photo.png) no-repeat left center;">Agregar foto</a>
                            <hr class="divider"/>
                            <a href="{$tsConfig.url}/cuenta/" class="systemicons micuenta">Editar mi cuenta</a>
                            <a href="{$tsConfig.url}/login-salir.php" class="salir">Cerrar sesi&oacute;n</a>
                        </div>
                    </div>