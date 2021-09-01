	                            <h3 onclick="cuenta.chgsec(this)">4. Intereses y preferencias</h3>
                                <fieldset style="display: none">
                                    <div class="alert-cuenta cuenta-5">
                                    </div>
                                    <div class="field">
                                        <label for="mis_intereses">Mis intereses</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="intereses" id="mis_intereses">{$tsPerfil.p_intereses}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="hobbies">Hobbies</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="hobbies" id="hobbies">{$tsPerfil.p_hobbies}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="series_tv_favoritas">Series de TV favoritas:</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="tv" id="series_tv_favoritas">{$tsPerfil.p_tv}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="musica_favorita">M&uacute;sica favorita</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="musica" id="musica_favorita">{$tsPerfil.p_musica}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="deportes_y_equipos_favoritos">Deportes y equipos favoritos</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="deportes" id="deportes_y_equipos_favoritos">{$tsPerfil.p_deportes}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="libros_favoritos">Libros favoritos</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="libros" id="libros_favoritos">{$tsPerfil.p_libros}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="peliculas_favoritas">Pel&iacute;culas favoritas</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="peliculas" id="peliculas_favoritas">{$tsPerfil.p_peliculas}</textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="comida_favorita">Comida favorita</label>
                                        <div class="input-fake">
                                            <textarea class="cuenta-save-5" name="comida" id="comida_favorita">{$tsPerfil.p_comida}</textarea>
                                        </div>
                                    </div> 
                                     <div class="field">
                                         <label for="mis_heroes_son">Mis h&eacute;roes son</label>
                                         <div class="input-fake">
                                             <textarea class="cuenta-save-5" name="heroes" id="mis_heroes_son">{$tsPerfil.p_heroes}</textarea>
                                         </div>
                                     </div>
                                    <div class="buttons">
                                        <input type="button" value="Guardar" onclick="cuenta.save(5)" class="mBtn btnOk">
                                    </div>
                                </fieldset>