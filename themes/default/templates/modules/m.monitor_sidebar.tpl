                <div style="width: 210px; float: right;" id="post-izquierda">
                    <div class="categoriaList">
                        <h6 style="margin:0;">Filtrar Actividad</h6>
                        <ul>
                            <li style="text-align:center;">Elige que notificaciones recibir y cuales no.</li>
                            <li class="divider"></li>
                            <li><strong>Mis Posts</strong></li>
                            <li><label><span class="monac_icons ma_star"></span><input type="checkbox" {if $tsData.filtro.f1 != true}checked="checked"{/if} onclick="notifica.filter('1', this)"/> Favoritos</label></li>
                            <li><label><span class="monac_icons ma_comment_post"></span><input type="checkbox" {if $tsData.filtro.f2 != true}checked="checked"{/if}onclick="notifica.filter('2', this)"/> Comentarios</label></li>
                            <li><label><span class="monac_icons ma_points"></span><input type="checkbox" {if $tsData.filtro.f3 != true}checked="checked"{/if}onclick="notifica.filter('3', this)"/> Puntos Recibidos</label></li>
                            <li><strong>Mis Comentarios</strong></li>
                            <li><label><span class="monac_icons ma_voto"></span><input type="checkbox" {if $tsData.filtro.f8 != true}checked="checked"{/if}onclick="notifica.filter('8', this)"/> Votos</label></li>
                            <li><label><span class="monac_icons ma_comment_resp"></span><input type="checkbox" {if $tsData.filtro.f9 != true}checked="checked"{/if}onclick="notifica.filter('9', this)"/> Respuestas</label></li>
                            <li><strong>Usuarios que sigo</strong></li>
                            <li><label><span class="monac_icons ma_follow"></span><input type="checkbox" {if $tsData.filtro.f4 != true}checked="checked"{/if}onclick="notifica.filter('4', this)"/> Nuevos</label></li>
                            <li><label><span class="monac_icons ma_post"></span><input type="checkbox" {if $tsData.filtro.f5 != true}checked="checked"{/if}onclick="notifica.filter('5', this)"/> Posts</label></li>
                            <li><label><span class="monac_icons ma_photo"></span><input type="checkbox" {if $tsData.filtro.f10 != true}checked="checked"{/if}onclick="notifica.filter('10', this)"/> Fotos</label></li>
                            <li><label><span class="monac_icons ma_share"></span><input type="checkbox" {if $tsData.filtro.f6 != true}checked="checked"{/if}onclick="notifica.filter('6', this)"/> Recomendaciones</label></li>
                            <li><strong>Posts que sigo</strong></li>
                            <li><label><span class="monac_icons ma_blue_ball"></span><input type="checkbox" {if $tsData.filtro.f7 != true}checked="checked"{/if}onclick="notifica.filter('7', this)"/> Comentarios</label></li>
                            <li><strong>Mis Fotos</strong></li>
                            <li><label><span class="monac_icons ma_comment_post"></span><input type="checkbox" {if $tsData.filtro.f11 != true}checked="checked"{/if}onclick="notifica.filter('11', this)"/> Comentarios</label></li>
                            <li><strong>Perfil</strong></li>
                            <li><label><span class="monac_icons ma_status"></span><input type="checkbox" {if $tsData.filtro.f12 != true}checked="checked"{/if}onclick="notifica.filter('12', this)"/> Publicaciones</label></li>
                            <li><label><span class="monac_icons ma_w_comment"></span><input type="checkbox" {if $tsData.filtro.f13 != true}checked="checked"{/if}onclick="notifica.filter('13', this)"/> Comentarios</label></li>
                            <li><label><span class="monac_icons ma_w_like"></span><input type="checkbox" {if $tsData.filtro.f14 != true}checked="checked"{/if}onclick="notifica.filter('14', this)"/> Likes</label></li>

                        </ul>
                    </div>
                    <div class="categoriaList estadisticasList">
                        <h6>Estad&iacute;sticas</h6>
                        <ul>
                            <li class="clearfix"><a href="{$tsConfig.url}/monitor/seguidores"><span class="floatL">Seguidores</span><span class="floatR number">{$tsData.stats.seguidores}</span></a></li>
                            <li class="clearfix"><a href="{$tsConfig.url}/monitor/siguiendo"><span class="floatL">Usuarios Siguiendo</span><span class="floatR number">{$tsData.stats.siguiendo}</span></a></li>
                            <li class="clearfix"><a href="{$tsConfig.url}/monitor/posts"><span class="floatL">Posts</span><span class="floatR number">{$tsData.stats.posts}</span></a></li>
                        </ul>
                    </div>
                    {if $tsConfig.c_allow_live == 1}
                    <div class="categoriaList">
                        <h6>Notificaciones Live</h6>
                        <ul>
                            <li class="clearfix"><label><input type="checkbox" {if $tsStatus.live_nots == 'ON'}checked="checked"{/if} onclick="live.ch_status('nots');"/> <b>Mostrar notificaciones</b></label></li>
                            <li class="clearfix"><label><input type="checkbox" {if $tsStatus.live_mps == 'ON'}checked="checked"{/if} onclick="live.ch_status('mps');"/> <b>Mostrar mensajes nuevos</b></label></li>
                            <li class="clearfix"><label><input type="checkbox" {if $tsStatus.live_sound == 'ON'}checked="checked"{/if} onclick="live.ch_status('sound');"/> <b>Reproducir sonidos</b></label></li>
                        </ul>
                    </div>
                    {/if}
                </div>