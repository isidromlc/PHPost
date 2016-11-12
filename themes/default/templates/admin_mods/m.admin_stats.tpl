                                <div class="boxy-title">
								   <h3>Administrar Estad&iacute;sticas</h3>
								</div>
                        		<div id="res" class="boxy-content clearfix" style="position:relative">
        							<div class="categoriaList estadisticasList" style="float:left; width:250px;">
        								<h6>Posts <span class="floatR number">{$tsAdminStats.posts_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Visibles</span><span class="floatR number">{$tsAdminStats.posts_visibles} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; En revisi&oacute;n</span><span class="floatR number">{$tsAdminStats.posts_revision} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Inactivos</span><span class="floatR number">{$tsAdminStats.posts_ocultos} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Eliminados</span><span class="floatR number">{$tsAdminStats.posts_eliminados} &nbsp;</span></li>
                                                    <li class="clearfix"><span class="floatL">&nbsp; Posts compartidos</span><span class="floatR number">{$tsAdminStats.posts_compartidos} &nbsp;</span></li>	
                                                    <li class="clearfix"><span class="floatL">&nbsp; Posts favoritos</span><span class="floatR number">{$tsAdminStats.posts_favoritos} &nbsp;</span></li>
        									</ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float:right; width:250px;">
        								<h6>Fotos <span class="floatR number">{$tsAdminStats.fotos_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Visibles</span><span class="floatR number">{$tsAdminStats.fotos_visibles} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; En revisi&oacute;n</span><span class="floatR number">{$tsAdminStats.fotos_ocultas} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Eliminadas</span><span class="floatR number">{$tsAdminStats.fotos_eliminadas} &nbsp;</span></li>
        									</ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float:right; width:250px;">
        								<h6>Comentarios en Posts <span class="floatR number">{$tsAdminStats.comentarios_posts_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Visibles</span><span class="floatR number">{$tsAdminStats.comentarios_posts_visibles} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; En revisi&oacute;n</span><span class="floatR number">{$tsAdminStats.comentarios_posts_ocultos} &nbsp;</span></li>
        									</ul>
        							</div>
                                    <div class="categoriaList estadisticasList" style="float:left; width:250px;">
        								<h6>Usuarios <span class="floatR number">{$tsAdminStats.usuarios_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Activos</span><span class="floatR number">{$tsAdminStats.usuarios_activos} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Inactivos</span><span class="floatR number">{$tsAdminStats.usuarios_inactivos} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Suspendidos</span><span class="floatR number">{$tsAdminStats.usuarios_baneados} &nbsp;</span></li>
        									</ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float:right; width:250px;">
        								<h6>Muro <span class="floatR number">{$tsAdminStats.muro_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Estados</span><span class="floatR number">{$tsAdminStats.muro_estados} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Comentarios</span><span class="floatR number">{$tsAdminStats.muro_comentarios} &nbsp;</span></li>
        									</ul>
        							</div>
                                    <div class="categoriaList estadisticasList" style="float:left; width:250px;">
        								<h6>Afiliados <span class="floatR number">{$tsAdminStats.afiliados_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Activos</span><span class="floatR number">{$tsAdminStats.afiliados_activos} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Inactivos</span><span class="floatR number">{$tsAdminStats.afiliados_inactivos} &nbsp;</span></li>
        									</ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float:right; width:250px;">
        								<h6>Medallas <span class="floatR number">{$tsAdminStats.medallas_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Usuarios</span><span class="floatR number">{$tsAdminStats.medallas_usuarios} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Posts</span><span class="floatR number">{$tsAdminStats.medallas_posts} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Fotos</span><span class="floatR number">{$tsAdminStats.medallas_fotos} &nbsp;</span></li>
                                                    <li class="clearfix"><span class="floatL">&nbsp; Asignadas</span><span class="floatR number">{$tsAdminStats.medallas_asignadas} &nbsp;</span></li>								
                                            </ul>
        							</div>
                                    <div class="categoriaList estadisticasList" style="float:left; width:250px;">
        								<h6>Seguimiento <span class="floatR number">{$tsAdminStats.seguidos_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Usuarios</span><span class="floatR number">{$tsAdminStats.usuarios_follows} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Posts</span><span class="floatR number">{$tsAdminStats.posts_follows} &nbsp;</span></li>
        									</ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float:right; width:250px;">
        								<h6>Mensajes <span class="floatR number">{$tsAdminStats.mensajes_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Eliminados por receptor</span><span class="floatR number">{$tsAdminStats.mensajes_para_eliminados} &nbsp;</span></li>
        											<li class="clearfix"><span class="floatL">&nbsp; Eliminados por autor</span><span class="floatR number">{$tsAdminStats.mensajes_de_eliminados} &nbsp;</span></li>							
                                                    <li class="clearfix"><span class="floatL">&nbsp; Respuestas</span><span class="floatR number">{$tsAdminStats.usuarios_respuestas} &nbsp;</span></li>
                                            </ul>
        							</div>
        							<div class="categoriaList estadisticasList" style="float: left; width:250px;">
        								<h6>Comentarios en Fotos <span class="floatR number">{$tsAdminStats.comentarios_fotos_total} &nbsp;</span></h6>
        									<ul>
        											<li class="clearfix"><span class="floatL">&nbsp; Visibles</span><span class="floatR number">{$tsAdminStats.comentarios_fotos_total} &nbsp;</span></li>
        									</ul>
        							</div>	
                        		</div>