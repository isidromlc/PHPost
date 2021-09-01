                                <div class="boxy-title">
                                    <h3>Centro de Moderaci&oacute;n</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                	<b>Hola {$tsUser->nick}!</b><br />Si est&aacute;s viendo esto significa que tienes el privilegio de ser moderador en <b>{$tsConfig.titulo}</b>, por favor lee el protocolo de moderadores para mantener todo en orden.
                                    <hr class="separator" />
                                    <b>Protocolo :: Un moderador:</b>
                                    <ul id="reglas">
                                        <li>Debe leer y llevar al pie de la letra cada punto que se describe a continuaci&oacute;n, su desconocimiento de este protocolo no ser&aacute; excusa para no cumplir con el mismo.</li>
                                        <li>No pasar&aacute; por arriba de las decisiones de los Administradores.</li>
                                        <li>No deber&aacute; abusar jam&aacute;s de su poder y deber&aacute; ser imparcial y criterioso a la hora de los conflictos.</li>
                                        <li>Todos los moderadores deben estar atentos a cualquier consulta realizada por los miembros.</li>
                                        <li>Podr&aacute; editar o eliminar posts que tengan t&iacute;tulos poco descriptivos.</li>
                                        <li>Borrar&aacute; todo post que haya sido denunciado o que detecte que no cumple con las reglas de <b>{$tsConfig.titulo}</b>.</li>
                                        <li>Deber&aacute; indicar detalladamente la causa por la cual se elimina un post y las faltas cometidas por el usuario para que este pueda rehacer su post correctamente.</li>
                                        <li>Si quiere o tiene ganas, puede modificar un post que errores de cualquier &iacute;ndole relacionada con la ortograf&iacute;a o dise&ntilde;o del post, pero en ning&uacute;n momento esto es algo obligatorio.</li>
                                        <li>En lo posible intentar&aacute; que el usuario edite su post para quedar acorde a las reglas, evitar a toda costa el borrado en masa de posts.</li>
                                        <li>No se encarga de arreglar cada uno de los posts mal hechos o que rompan reglas. Cada usuario debe encargarse de que su post est&eacute; realizado correctamente ya que tiene la posibilidad y responsabilidad de hacerlo.</li>
                                        <li>Eliminar&aacute; autom&aacute;ticamente todo tipo de spam intencional.</li>
                                        <li>Suspender&aacute; directamente en caso de discriminaci&oacute;n, spam masivo, suplantaci&oacute;n de identidad y/o difamaci&oacute;n hacia terceros.</li>
                                        <li>Decidir&aacute; seg&uacute;n su criterio (en caso de suspensi&oacute;n) la cantidad de d&iacute;as asignados teniendo en cuenta la gravedad de la falta.</li>
                                        <li>Deber&aacute; informar al administrador toda acci&oacute;n que influya en la v&iacute;a normal de la comunidad. Ej.: suspensiones,  stickys y cualquier otro motivo importante.</li>
                                        <li>De no cumplirse cualquiera de estos puntos el moderador puede sufrir una pena que va desde tres d&iacute;as de suspensi&oacute;n hasta la p&eacute;rdida del cargo y/o expulsi&oacute;n definitiva de <b>{$tsConfig.titulo}</b>.</li>
                                    </ul>

                                    <b>Tus colegas moderadores:</b><br />
                                    | {foreach from=$tsMods item=admin}
                                    	<a href="{$tsConfig.url}/perfil/{$admin.user_name}" class="hovercard" uid="{$admin.user_id}">{$admin.user_name}</a> |
                                    {/foreach}
                                </div>